<?php

// namespace App\Helper;
// sidebar active as per route
if (!function_exists('setActive')) {
    function setActive(array $route){
        if(is_array($route)){
            foreach($route as $r){
                if(request()->routeIs($r)){
                    return 'active';
                }
            }
        }
    }

}

// making a slug

if (!function_exists('sanitizeData')) {
    function sanitizeData($title)
    {
        // Remove HTML tags
        $title = strip_tags($title);

        // Remove all types of brackets
        $title = preg_replace('/[()\[\]{}<>]/', '', $title);

        // Remove white spaces
        $title = preg_replace('/\s+/', ' ', $title);

        // Remove Unicode characters using regular expression
        $slug = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title);

        // Convert spaces to hyphens and make lowercase
        $slug = strtolower(str_replace(' ', '-', $slug));

        return $slug;
    }
}




if (!function_exists('preserveBackgroundImageStyles')) {
    function preserveBackgroundImageStyles($htmlContent) {
        // Use a regular expression to remove all inline styles except background-image
        return preg_replace_callback('/style=("|\')(.*?)("|\')/', function ($matches) {
            $styles = explode(';', $matches[2]);
            $preservedStyles = [];

            foreach ($styles as $style) {
                if (strpos($style, 'background-image') !== false) {
                    $preservedStyles[] = $style;
                }
            }

            if (!empty($preservedStyles)) {
                return 'style="' . implode(';', $preservedStyles) . '"';
            } else {
                return ''; // Remove the style attribute entirely if no background-image is found
            }
        }, $htmlContent);
    }
}
if (!function_exists('removeInlineStyles')) {
    function removeInlineStyles($htmlContent) {
        return preg_replace('/style=("|\')(.*?)("|\')/', '', $htmlContent);
    }
}

function generateCanonicalUrl() {
    $currentUrl = url()->current();
    
    $canonicalUrl = str_replace('/public', '', $currentUrl);

    return $canonicalUrl;
}

if (!function_exists('html_word_truncate')) {
    function html_word_truncate($html, $limit = 50, $allowedTags = '<br><ul><li><ol><p><b><strong><i><em><u>') {
        $textOnly = strip_tags($html);
        $words = str_word_count($textOnly);

        if ($words <= $limit) {
            return $html;
        }
        
        $html = strip_tags($html, $allowedTags);

        preg_match_all('/(<[^>]+>)|([^<>\s]+[\s]*)/', $html, $parts);
        $wordCount = 0;
        $result = '';

        foreach ($parts[0] as $part) {
            if (trim($part) == '') continue;
            if ($part[0] === '<') {
                $result .= $part;
            } else {
                if ($wordCount < $limit) {
                    $result .= $part;
                    $wordCount++;
                } else {
                    break;
                }
            }
        }
        return $result . '...';
    }
}




