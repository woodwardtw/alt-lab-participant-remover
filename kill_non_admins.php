<?php
/*
Plugin Name: ALT Lab Remove Other Blogs
Plugin URI: http://
Description: Removes all the blogs where you aren't an ADMIN
Author: Tom Woodward
Version: 1
Author URI: http://bionicteaching.com/
*/

function remove_non_admin_blogs($blogs) {
 				global $current_user; 
    			$user_id = $current_user->ID; 
    			$role = 'administrator';

                foreach ( $blogs as $blog_id => $blog ) {

                    // Get the user object for the user for this blog.
                    $user = new WP_User( $user_id, '', $blog_id );

                    // Remove this blog from the list if the user doesn't have the role for it.
                    if ( ! in_array( $role, $user->roles ) ) {
                        unset( $blogs[ $blog_id ] );
                    }
                }

                return $blogs;
            }    
add_filter( 'get_blogs_of_user', 'remove_non_admin_blogs' );
?>