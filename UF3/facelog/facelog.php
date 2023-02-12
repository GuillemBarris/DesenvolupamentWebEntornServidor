<?php
require "includes\custom-pages.php";
/**
 * Plugin Name: FaceLog Plugin
 * Plugin URI: http://boscdelacoma.cat
 * Description: Pràctica MP07.
 * Version: 0.1
 * Author: ELTEUNOM
 * Author URI:  http://boscdelacoma.cat
 **/

 const FACELOG_DB_VERSION = '1.0';
 const FACELOG_VERSION= '1.0';
 
 // Allow subscribers to see Private posts and pages
 $subRole = get_role( 'subscriber' );
 $subRole->add_cap( 'read_private_posts' );
 $subRole->add_cap( 'read_private_pages' );
 

 function facelog_example(){
    return "Hola a tothom!";
 }

 add_shortcode('facelog', 'facelog_example');
 function add_my_custom_page() {
   // Create post object
   $my_post = array(
     'post_title'    => wp_strip_all_tags( "log"),
     'post_content'  => "";
     'post_status'   => 'publish',
     'post_author'   => 1,
     'post_type'     => 'page',
    
   );
   $my_post1 = array(
      'post_title'    => wp_strip_all_tags( 'add-log' ),
     'post_content'  => facelog_addlog(),
     'post_status'   => 'private',
     'post_author'   => 1,
     'post_type'     => 'page',
   );
   
   // Insert the post into the database
   wp_insert_post( $my_post );
   wp_insert_post( $my_post1 );
}

register_activation_hook(__FILE__, 'add_my_custom_page');

