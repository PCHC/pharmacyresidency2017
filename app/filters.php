<?php

namespace App;

use Resident;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
});

add_filter('sage/display_sidebar', function ($display) {
  static $display;

  isset($display) || $display = in_array(false, [
    // The sidebar will be displayed if any of the following return true
    is_front_page(),
    is_single(),
    is_archive(),
  ]);

  return $display;
});

add_filter('sober/controller/path', function () {
    return dirname(get_template_directory()) . '/app/controllers';
});

add_filter( 'the_title', function($title, $id = null) {
  if( get_post_type($id) == 'resident' ) {
    $title .= Resident::residentSuffix() ?
      ', ' . Resident::residentSuffix() :
      '';
  }
  return $title;
}, 10, 2);

/**
 *  Alter the post query on certain post types.
 */
add_action('pre_get_posts', function( $query ) {
	// validate
	if( is_admin() ){
		return $query;
	}
	// project example
	if( isset( $query->query_vars['post_type'] ) || isset( $query->query_vars['class'] ) ) {
    if(
      (
        isset( $query->query_vars['post_type'] )
        && $query->query_vars['post_type'] == 'resident'
      ) 
      || isset( $query->query_vars['class'] )
    ) {
      // Order by last name.
      add_filter( 'posts_orderby', __NAMESPACE__ . '\\order_by_lastname', 10, 2 );

      // Order by title
      //$query->set('orderby', 'title');
      $query->set('order', 'ASC');
    }
	}
	// always return
	return $query;
});

function order_by_lastname( $orderby, $query ) {
  // first you should check to make sure sure you're only filtering the particular query
  // you want to hack. return $orderby if its not the correct query;
  global $wpdb;
  // Trim in from right to first space
	$orderby_statement = "SUBSTR( LTRIM({$wpdb->posts}.post_title), LOCATE(' ',RTRIM({$wpdb->posts}.post_title)))";
	return $orderby_statement;
  // return original $orderby if not the correct query.
  return $orderby;
}

add_filter( 'get_the_archive_title', function( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }

  return $title;
} );
