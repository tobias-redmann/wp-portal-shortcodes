<?php
/**
 * Plugin Name: WP Portal Shortcodes
 * Plugin URI: https://www.tricd.de/portal-shortcodes/
 * Description: Provides some basic shortcodes for portal navigation
 * Version: 0.1
 * Author: Tobias Redmann
 * Author URI: https://www.tricd.de
 * License: MIT
 */


add_shortcode('category_sitemap',  'wp_portal_category_sitemap');


#add_shortcode('tag_index',         'wp_portal_tag_index');



function wp_portal_category_sitemap($attr, $content)
{

    // parse the attributes
    $attr = shortcode_atts(
        array(
            'limit'         => -1,
            'header'        => 'h3',
            'header_class'  => '',
            'list'          => 'ul',
            'list_class'    => '',
            'item'          => 'li',
            'item_class'    => '',
            'exclude'       => '',
            'hide_empty'    => 1,
            'orderby'       => 'name',
            'order'         => 'asc'
        ),
        $attr,
        'category_sitemap'
    );


    // build category query
    $category_params = array(
        'exclude'       => $attr['exclude'],
        'hide_empty'    => $attr['hide_empty'],
        'orderby'       => $attr['orderby'],
        'order'         => $attr['order']
    );


    // query categories
    $categories =  get_categories($category_params);


    if (0 == count($categories)) return '';

    // build style predefs

    $header_class   = '';
    $list_class     = '';
    $item_class     = '';

    if ('' != trim($attr['header_class']))  $header_class   = ' class="'.$attr['header_class'].'" ';

    if ('' != trim($attr['list_class']))    $list_class     = ' class="'.$attr['list_class'].'" ';

    if ('' != trim($attr['item_class']))    $item_class     = ' class="'.$attr['item_class'].'" ';


    $o = '';

    foreach ($categories as $cat) {

        $cat_link = get_category_link( $cat->cat_ID );

        $o .=  sprintf('<%s %s><a href="'.$cat_link.'">'. $cat->name .'</a></%s>', $attr['header'], $header_class, $attr['header']);

        $posts = array();

        $posts = query_posts("cat=". $cat->cat_ID ."&posts_per_page=". $attr['limit']);

        if (count($posts) > 0) $o = $o. sprintf('<%s %s>',$attr['list'], $list_class);

        foreach($posts as $p) {

            $post_link = get_permalink( $p->ID );

            $o = $o . sprintf('<%s %s><a href="'.$post_link.'">'.$p->post_title.'</a></%s>', $attr['item'], $item_class, $attr['item']);

        }
        if (count($posts) > 0) $o = $o. sprintf('</%s>', $attr['list']);

        wp_reset_query();

    }

    return $o;
}

/*
function wp_portal_tag_index($attr, $content) {


    $o = '';

    $tags = get_terms("post_tag");

    foreach($tags as $tag) {

        $tag_link = get_tag_link($tag->term_id);

        $o = $o. '<h3><a href="'.$tag_link.'">'. $tag->name .'</a></h3>';

        $ps = array();

        $ps = query_posts("tag=". $tag->slug);

        if (count($ps) > 0) $o = $o.'<ul>';

        foreach($ps as $p) {

            $post_link = get_permalink( $p->ID );

            $o = $o . '<li><a href="'.$post_link.'">'.$p->post_title.'</a></li>';

        }

        if (count($ps) > 0) $o = $o.'</ul>';

        wp_reset_query();

    }

    return $o;
}
*/
