<?php

class Indexer {
	private $alignment = 'left'; // You can use 'left' or 'center'
	private $activateDirLinks = true; // whether the user can click on the directories and list them or not.
	private $dateFormat = 'd/m/y H:i'; // Used in date() function
	private $dirTolist;
	//private $path; #legacy. Unused
	private $subtitle = '{{files}} objects in this folder, {{size}} total'; // Empty to disable
	private $showParent = true; // Display a (parent directory) link
	private $showDirectories = true;
	private $showHiddenFiles = false; // Display files starting with "." too
	private $sizeDecimals = 1;
	private $showFooter = false; // Display the "Powered by" footer
	private $sortReverce = 0;
	private $sort = 'name';
	private $showIcons = true;
	private $self;
	private $title = 'Index of Test/{{path}}'; //add the root dir title here before the {{path}} to show the root index
	private $total = 0;
	private $total_size = 0;
	private $robots = 'noindex, nofollow'; // Avoid robots by default
	private $rootListingDirFolder = './';   //----- ./ here is the default directory in which the script resides (its root). Be careful here, if you put / this will list root on the machine, use ./ as root and go from there. A directory up is ../  Ex: if you want to start listing from the parent dir of the script use './../'
	
	function __construct($options) {
		
		foreach ($options as $field => $value) {
			$this->$field = $value;
		}
		
		// Who am I?
		$this->self = basename($_SERVER['PHP_SELF']);
		//$this->path = str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])); unused
		
		// Encoded images generator. TODO Not working atm. I broke it. Gotta fix! 
		if (!empty($_GET['i'])) {
			header('Content-type: image/png');
			switch ($_GET['i']) {
				case       'asc': exit(base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAcAAAAHCAYAAADEUlfTAAAAFUlEQVQImWNgoBT8x4JxKsBpAhUAAPUACPhuMItPAAAAAElFTkSuQmCC'));
				case      'desc': exit(base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAcAAAAHCAYAAADEUlfTAAAAF0lEQVQImWNgoBb4j0/iPzYF/7FgCgAADegI+OMeBfsAAAAASUVORK5CYII='));
				case 'directory': exit(base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAASklEQVQYlYWPwQ3AMAgDb3Tv5AHdR5OqTaBB8gM4bAGApACPRr/XuujA+vqVcAI3swDYjqRSH7B9oHI8grbTgWN+g3+xq0k6TegCNtdPnJDsj8sAAAAASUVORK5CYII='));
				case      'file': exit(base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAPklEQVQYlcXQsQ0AIAhE0b//GgzDWGdjDCJoKck13CsIALi7gJxyVmFmyrsXLHEHD7zBmBbezvoJm4cL0OwYouM4O3J+UDYAAAAASUVORK5CYII='));
			}
		}

		// Reverse?
		$this->sortReverce = (@$_GET['r'] == '1');
		
		//todo. Absorb out config
	}
	
	/**
	 * only public method
	 */
	public function listDir($dir) {
		$this->dirTolist = @$_GET['d'];
		// Get the directory to list. Tons of checks to prevent users from listing dirs outside root of the website
		if ( !isset($this->dirTolist) || substr_count($this->dirTolist, '..') > 0 || strpos($this->dirTolist, '/') === 0 || strpos($this->dirTolist, '\\') === 0 || strpos($this->dirTolist, ':\\') || strpos($this->dirTolist, ':/') || !is_dir( $this->rootListingDirFolder . $this->dirTolist) || !$activateDirLinks )
			$this->dirTolist = '';
		
		$currentList = $this->rootListingDirFolder . $this->dirTolist;
		$items = $this->ls($currentList);
		
		if (isset($_GET['s'])) {
			switch ($_GET['s']) {
				case 'size': $this->sort = 'size'; usort($items, array ('Indexer', 'sortBySize') ); break;
				case 'time': $this->sort = 'time'; usort($items, array ('Indexer', 'sortByTime') ); break;
				case 'name': $this->sort = 'name'; usort($items, array ('Indexer', 'sortByName') ); break;
				default    : $this->sort = 'name'; usort($items, array ('Indexer', 'sortByName') ); break;
			}
		}
		
		if ($this->sortReverce) $items = array_reverse($items);
		
		// Add parent
		if ($this->showParent && $this->dirTolist != $this->rootListingDirFolder && $this->dirTolist != '') array_unshift($items, array(
			'name' => '..',
			'isparent' => true,
			'isdir' => true,
			'size' => 0,
			'time' => 0
		));
		
		return $items;
	}
	
	// default list function
	private function ls($path) {
		$ls = array();
		$ls_d = array();
		if (($dh = @opendir($path)) === false) return $ls;
		if (substr($path, -1) != '/') $path .= '/';
		while (($file = readdir($dh)) !== false) {
			if ($file == $this->self) continue;
			if ($file == '.' || $file == '..') continue;
			if (!$this->showHiddenFiles) if (substr($file, 0, 1) == '.') continue;
			$isdir = is_dir($path . $file);
			if (!$this->showDirectories && $isdir) continue;
			$item = array('name' => $file, 'isdir' => $isdir, 'size' => $isdir ? 0 : filesize($path . $file), 'time' => filemtime($path . $file));
			if ($isdir) {
				//uncomment for recursive search. Not finished. Can be full recursive. Maybe a future expansion with drop downs?
				//$innerDirs = ls($item['name'], $show_folders, $show_hidden);
				//$item['innerDirs'] = $innerDirs;
				$ls_d[] = $item;
			} else {
				$ls[] = $item;
			}
			$this->total++;
			$this->total_size += $item['size'];
		}
		return array_merge($ls_d, $ls);
	}
	
	// Sort it
	public static function sortByName($a, $b) { return ($a['isdir'] == $b['isdir'] ? strtolower($a['name']) > strtolower($b['name']) : $a['isdir'] < $b['isdir']); }
	public static function sortBySize($a, $b) { return ($a['isdir'] == $b['isdir'] ? $a['size'] > $b['size'] : $a['isdir'] < $b['isdir']); }
	public static function sortByTime($a, $b) { return ($a['time'] > $b['time']); }
	
	
	// 37.6 MB is better than 39487001
	public function humanizeFilesize($val, $round = 0) {
		$unit = array('','K','M','G','T','P','E','Z','Y');
		do { $val /= 1024; array_shift($unit); } while ($val >= 1000);
		return sprintf('%.'.intval($round).'f', $val) . ' ' . array_shift($unit) . 'B';
	}
	
	// Titles parser
	public function getTitle() {
		return str_replace('{{path}}', $this->dirTolist, $this->title);
	}
	
	//self getter
	public function getSelf() {
		return $this->self;
	}
	
	//sort type
	public function getSortType() {
		return $this->sort;
	}
	
	//sort reverce
	public function getSortReverce() {
		return $this->sortReverce;
	}
	
	//get Alignment
	public function getAlignment(){
		return $this->alignment;
	}
	
	//get Subtitle
	public function getSubtitle() {
		return str_replace(array('{{files}}', '{{size}}'), array( $this->total, $this->humanizeFilesize($this->total_size, $this->sizeDecimals)), $this->subtitle);
	}
	
	// Link builder
	public function buildLink($changes) {
		$params = $_GET;
		foreach ($changes as $k => $v) if (is_null($v)) unset($params[$k]); else $params[$k] = $v;
		foreach ($params as $k => $v) $params[$k] = $k . '=' . $v;
		return empty($params) ? $this->self : $this->self . '?' . implode($params, '&');
	}
}
?>
