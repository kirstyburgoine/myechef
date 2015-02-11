<?php // functions/template.php

function slug_to_title($title) {
	return ucwords(str_replace('_', ' ', $title));
}

function is_ajax() {
	return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' );
}

function alpha_numeric($string) {
	return preg_replace("/[^A-Za-z0-9]/", '', $string);
}

function get_ID_by_slug($page_slug) {
    
    $page = get_page_by_path($page_slug);

    if ( $page ) {
        return $page->ID;
    } else {
        return null;
    }
    
}