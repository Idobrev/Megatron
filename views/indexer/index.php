<?php var_dump($content); //var_dump($content); ?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	
	<meta charset="UTF-8">
	<meta name="robots" content="<?php echo htmlentities($content->robots) ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title><?php echo htmlentities($content->title) ?></title>
	
	<style type="text/css">
		
		* {
			margin: 0;
			padding: 0;
			border: none;
		}
		
		body {
			text-align: center;
			font-family: sans-serif;
			font-size: 13px;
			color: #000000;
		}
		
		#wrapper {
			max-width: 600px;
			*width: 600px;
			margin: 0 auto;
			text-align: left;
		}
		
		body#left {
			text-align: left;
		}
		
		body#left #wrapper {
			margin: 0 20px;
		}
		
		h1 {
			font-size: 21px;
			padding: 0 10px;
			margin: 20px 0 0;
			font-weight: bold;
		}
		
		h2 {
			font-size: 14px;
			padding: 0 10px;
			margin: 10px 0 0;
			color: #999999;
			font-weight: normal;
		}
		
		a {
			text-decoration: none;
		}
		
		ul#header {	
			margin-top: 20px;
		}
		
		ul li {
			display: block;
			list-style-type: none;
			overflow: hidden;
			padding: 10px;
		}
		
		ul li:hover {
			background-color: #f3f3f3;
		}
		
		ul li .date {
			text-align: center;
			width: 120px;
		}
		
		ul li .size {
			text-align: right;
			width: 90px;
		}
		
		ul li .date, ul li .size {
			float: right;
			font-size: 12px;
			display: block;
			color: #666666;
		}
		
		ul#header li {
			font-size: 11px;
			font-weight: bold;
			border-bottom: 1px solid #cccccc;
		}
		
		ul#header li:hover {
			background-color: transparent;
		}
		
		ul#header li * {
			color: #000000;
			font-size: 11px;
		}
		
		ul#header li a:hover {
			color: #666666;
		}
		
		ul#header li .asc span, ul#header li .desc span {
			padding-right: 15px;
			background-position: right center;
			background-repeat: no-repeat;
		}
		
		ul#header li .asc span {
			background-image: url('<?php echo $content->self ?>?i=asc');
		}
		
		ul#header li .desc span {
			background-image: url('<?php echo $content->self ?>?i=desc');
		}
		
		ul li.item {
			border-top: 1px solid #f3f3f3;
		}
		
		ul li.item:first-child {
			border-top: none;
		}
		
		ul li.item .name {
			color: #003399;
			font-weight: bold;
		}
		
		ul li.item .name:hover {
			color: #0066cc;
		}
		
		ul li.item a:hover {
			text-decoration: underline;
		}
		
		ul li.item .directory, ul li.item .file {
			padding-left: 20px;
			background-position: left center;
			background-repeat: no-repeat;
		}
		
		ul li.item .directory {
			background-image: url('<?php echo $content->self ?>?i=directory');
		}
		
		ul li.item .file {
			background-image: url('<?php echo $content->self ?>?i=file');
		}
		
		#footer {
			color: #cccccc;
			font-size: 11px;
			margin-top: 40px;
			margin-bottom: 20px;
			padding: 0 10px;
			text-align: left;
		}
		
		#footer a {
			color: #cccccc;
			font-weight: bold;
		}
		
		#footer a:hover {
			color: #999999;
		}
		
	</style>
	
</head>
<body <?php if ($content->alignment == 'left') echo 'id="left"' ?>>

	<div id="wrapper">
		
		<h1><?php echo htmlentities($content->title) ?></h1>
		<h2><?php echo htmlentities($content->subtitle) ?></h2>
		
		<ul id="header">
			
			<li>
				<a href="<?php echo $content->headerLinkName ?>" class="size <?php if ($_sort == 'size') echo $_sort_reverse ? 'desc' : 'asc' ?>"><span>Size</span></a>
				<a href="<?php echo $content->headerLinkSize ?>" class="date <?php if ($_sort == 'time') echo $_sort_reverse ? 'desc' : 'asc' ?>"><span>Last modified</span></a>
				<a href="<?php echo $content->headerLinkTime ?>" class="name <?php if ($_sort == 'name') echo $_sort_reverse ? 'desc' : 'asc' ?>"><span>Name</span></a>
			</li>
			
		</ul>
		
		<ul>
			
			<?php foreach ($content->items as $item): ?>
				
				<li class="item">
				
					<span class="size"><?php echo $item['isdir'] ? '-' : humanizeFilesize($item['size'], $sizeDecimals) ?></span>
					
					<span class="date"><?php echo (@$item['isparent']) ? '-' : date($dateFormat, $item['time']) ?></span>
					<?php if ($item['isdir']):
						$currentDir = $dirTolist != '' ? $dirTolist . '/' : '';
						$currentDir = $item['name'] == '..' ? str_replace('.', '', dirname($dirTolist)) : $currentDir . htmlentities($item['name']);
						$link = $activateDirLinks ? $_SERVER['PHP_SELF'] . '?d=' . $currentDir : '#';
					?>
						<a href="<?php echo $link ?>" class="name <?php if ($showIcons) echo $item['isdir'] ? 'directory' : 'file' ?>"><?php echo htmlentities($item['name']) . ($item['isdir'] ? ' /' : '') ?></a>
					<?php else: ?>
						<span class="name" ><?php echo htmlentities($item['name']) . ($item['isdir'] ? ' /' : '') ?></span>
					<?php endif; ?>
					
				</li>
				
			<?php endforeach; ?>
			
		</ul>
		
		<?php if ($showFooter): ?>
			
			<p id="footer">
				Powered by <a href="https://github.com/lorenzos/Minixed" target="_blank">Minixed</a>, a PHP directory indexer
			</p>
			
		<?php endif; ?>
		
	</div>
	
</body>
</html>
