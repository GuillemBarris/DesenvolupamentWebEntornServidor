<?php // exit if uninstall constant is not defined
if (!defined('WP_UNINSTALL_PLUGIN')) exit;


// remove plugin options

// remove plugin transients

// remove plugin cron events

// ..etc., based on what needs to be removed


// get the page titles of the pages to delete
$page_titles = array(
    'log',
    'Page ',
);

// loop through the page titles and delete the pages
foreach ($page_titles as $page_title) {
    $page = get_page_by_title( $page_title );
    if ( $page ) {
        wp_delete_post( $page->ID, true );
    }
}



// Més info: https://digwp.com/2019/11/wordpress-uninstall-php/