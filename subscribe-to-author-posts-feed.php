<?php
/*
Plugin Name: Subscribe To Author Posts Feed
Plugin URI: http://rubensargsyan.com/wordpress-plugin-subscribe-to-author-posts-feed/
Description: This plugin adds links after the posts for subscribing to the post author's posts feed via RSS.
Version: 1.0
Author: Ruben Sargsyan
Author URI: http://rubensargsyan.com/
*/

/*  Copyright 2009 Ruben Sargsyan (email: info@rubensargsyan.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, see <http://www.gnu.org/licenses/>.
*/

$subscribe_to_author_posts_feed_url = WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__));

function subscribe_to_author_posts_feed_headers(){
  global $subscribe_to_author_posts_feed_url;
  ?>
  <link rel="stylesheet" href="<?php echo($subscribe_to_author_posts_feed_url); ?>css/subscribe_to_author_posts_feed.css" type="text/css" />
  <?php
}

function add_author_posts_feed_link($content){
    $post_id = get_the_ID();

    if(!is_page($post_id) && is_single($post_id)){
        $post = get_post($post_id);
        $author_id = $post->post_author;
        $author_posts_rss_link = get_author_feed_link($author_id);
        return $content.'<div id="subscribe_to_author_posts_feed"><a href="'.$author_posts_rss_link.'">Subscribe to this author\'s posts feed via RSS</a></div>';
    }

    return $content;
}

add_action('wp_head', 'subscribe_to_author_posts_feed_headers');
add_action('the_content', 'add_author_posts_feed_link');
?>