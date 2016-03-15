<?php

namespace RedditPics\Controllers;

use \RedditPics\Models\RedditPics as RedditPicsModel;
use \RedditPics\Libraries\HTMLParser as HTMLParser;
use \Swiftlet\Abstracts\Controller as ControllerAbstract;

/**
 * Index controller
 */
class Index extends ControllerAbstract
{
	/**
	 * Page title
	 * @var string
	 */
	protected $title = '/r/pics - Last';

	/**
	 * Default action
	 * @param $args array
	 */
	public function index(array $args = array())
	{
		// Create a model instance, see /src/RedditPics/Models/Reddit.php
		$redditPics = new RedditPicsModel;

		// Get the latest entry from the model
		$lastEntry = $redditPics->readLastEntry();

		// Apparently reddit doesn't return the actual thumbnail, we need some magic
		$HTMLParser = new HTMLParser();

		// Get thumbnail from the reddit content in the node and assign to view
		// TODO handle self posts?
		$this->view->lastImage = $HTMLParser->getThumbnailFromRedditContent( $lastEntry->content->__toString() );

		// Get links and title
		$this->view->link = $lastEntry->link->attributes()->href->__toString();
		$this->view->title = $lastEntry->title;

	}
}
