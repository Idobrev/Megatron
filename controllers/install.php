<?php 
/**
 * Absorb controller.
 * Default controller when Megatron is in absorb mode.
 */
class Install extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Main function that is called whenever Megatron is in absorb mode
	 */
	public function index($absorbedUrl) {
		
		//Call indexer and set vars for his view
		$options = new stdClass(); //make an option class for the indexer him
		$options->title = 'Index of Test/{{path}}';
		$options->robots = 'noindex, nofollow'; // Avoid robots by default
		$options->alignment = 'left';
		$options->rootListingDirFolder = './../';
		
		$indexer = new Indexer($options);
		$items = $indexer->listDir('dir');
		$sortReverce = $indexer->getSortReverce(); //1 or 0 
		$sortType = $indexer->getSortType();
		
		//define our variables for the view 
		$content = new stdClass();
		//$content->items = $items;
		$content->robots = $options->robots;
		$content->title = $indexer->getTitle();
		$content->subtitle = $indexer->getSubtitle();
		$content->alignment = $indexer->getAlignment(); // can be hardcoded here i guess
		$content->headerLinkName = $indexer->buildLink(array('s' => 'name', 'r' => (!$sortReverce && $sortType == 'name') ? '1' : null));
		$content->headerLinkSize = $indexer->buildLink(array('s' => 'size', 'r' => (!$sortReverce && $sortType == 'size') ? '1' : null));
		$content->headerLinkTime = $indexer->buildLink(array('s' => 'time', 'r' => (!$sortReverce && $sortType == 'time') ? '1' : null));
		$content->self = $indexer->getSelf();
		
		//call our view now?
		$this->view->render('indexer/index.php', false, $content);
		//var_dump($items);
		
		echo 'install controller';exit;
	}
}


?>