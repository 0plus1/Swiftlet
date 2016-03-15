<?php

namespace RedditPics\Libraries;

use \Swiftlet\Abstracts\Library as LibraryAbstract;

/**
 * Example library
 */
class HTMLParser extends LibraryAbstract
{

    /**
     * Parse reddit content parameter and return thumbnail link
     *
     * TODO: Sanity check on the HTML
     * TODO: Error handling when an image has not been found
     * TODO: Go deeper. Retrieve the first image of the gallery with the imgur API. The API is needed since it's not possible to infer the image name in case the link is a gallery as opposed to a single image
     *
     * @param $html
     * @return string|null
     */
    public function getThumbnailFromRedditContent($html)
    {
        // Instantiate DOMDocument
        $dom = new \DOMDocument();

        // Load HTML
        $dom->loadHTML($html);

        // Get all urls in the tree
        $imgs = $dom->getElementsByTagName('img');
        foreach ($imgs as $img)
        {
            // Return the first image src
            return $img->getAttribute('src');
        }

        //Return null if nothing was found
        return null;
    }

}
