<?php
/*
Plugin Name: ALT Lab Remove Ugly Blogs
Plugin URI: https://github.com/woodwardtw/alt-lab-participant-remover
Description: Removes all the blogs where you are just a participant
Author: Tom Woodward
Version: 1.5
Author URI: http://bionicteaching.com/
*/

<?php
/*
Plugin Name: ALT Lab Remove Ugly Blogs
Plugin URI: https://github.com/woodwardtw/alt-lab-participant-remover
Description: Removes all the blogs where you are just a participant
Author: Tom Woodward
Version: 1.5
Author URI: http://bionicteaching.com/
*/

function remove_junk_blogs($blogs) {
 				global $current_user; 
              if ( is_super_admin() ) {
                       return $blogs;//don't apply filter w superadmins
			}
                   else{

    			$user_id = $current_user->ID; 
                $allowed_roles = array( 'administrator', 'editor', 'author', 'contributor','subscriber'); 

                foreach ( $blogs as $blog_id => $blog ) {

                    // Get the user object for the user for this blog.
                    $user = new WP_User( $user_id, '', $blog_id );

                    if (array_intersect($allowed_roles, $user->roles) ) {
                    }
                    else
                      unset($blogs[$blog_id]);
            }

                return $blogs;
            } 
  }
add_filter( 'get_blogs_of_user', 'remove_junk_blogs' );
?>
