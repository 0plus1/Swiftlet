<?php

namespace RedditPics\Models;

use \Swiftlet\Abstracts\Model as ModelAbstract;

/**
 * Class RedditPics
 * @package RedditPics\Models
 */
class RedditPics extends ModelAbstract
{

	const REMOTE_FEED_SOURCE = 'https://www.reddit.com/r/pics.xml';

	/**
	 * Read the last entry in the XML feed
	 *
	 * @return \SimpleXMLElement
	 */
	public function readLastEntry()
	{
		// Parse the remote XML
		$xml = self::parseXMLFromFeed( self::REMOTE_FEED_SOURCE );

		// We are interested exclusively in entries
		$entries = $xml->entry;

		// Specifically the last of the entries
		$last_entry = $entries[ (count($entries)-1) ];

		return $last_entry;
	}

	/**
	 * Parse the provided URL to return an XML object
	 * TODO cache the file to avoid unnecessary subsequent requests
	 *
	 * @param $feed
	 * @return \SimpleXMLElement
	 */
	private static function parseXMLFromFeed( $feed )
	{
		return new \SimpleXMLElement( self::REMOTE_FEED_SOURCE, LIBXML_NOCDATA, true );
	}

}
