<?php

namespace App\Http\Controllers;

 class Controller
{
    public $ImgUrl = "http://localhost:9000";

    protected function extractFirstTwoPTags($htmlContent)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);

        // Load HTML content with UTF-8 encoding
        $dom->loadHTML('<?xml encoding="UTF-8">' . $htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Get all <p> tags
        $pTags = $dom->getElementsByTagName('p');

        // Extract the first two <p> tags
        $output = '';
        for ($i = 0; $i < min(2, $pTags->length); $i++) {
            $output .= $dom->saveHTML($pTags->item($i));
        }

        return $output;
    }
}
