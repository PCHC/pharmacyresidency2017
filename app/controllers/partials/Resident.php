<?php

namespace App;

trait ResidentPartial
{
  private static function buildField($field = null, $title = null) {
    if( !$field ) return;

    $output = '<div class="resident-info">';
    if( $title ) {
      $output .= "<h4>{$title}</h4>";
    }
    $output .= "<span>{$field}</span>";
    $output .= '</div>';

    return $output;
  }

  public static function residentSuffix() {
    return get_field('suffix');
  }

  public static function nameSuffix() {
    $name = get_the_title();
    if( get_field('suffix') ) {
      $name .= ', ' . get_field('suffix');
    }

    return $name;
  }

  public static function residentHometown() {
    return self::buildField( get_field('hometown'), 'Hometown' );
  }

  public static function residentAlmaMater() {
    return self::buildField( get_field('alma_mater'), 'Alma Mater' );
  }

  public static function residentWhere() {
    return self::buildField( get_field('where_are_they_now'), 'Where Are They Now?' );
  }

  public static function residentClass() {
    $resClass = self::residentClassLinks();

    if( self::residentYearStart() ) {
      $resClass .= ' | ' . self::residentYearStart() . '&ndash;';

      if( !self::residentIsCurrent() ) {
        $resClass .= self::residentYearEnd();
      }
    }

    return $resClass;
  }

  private static function residentClassLinks() {
    $links = '';
    $i = 1;
    $terms = wp_get_post_terms(get_the_ID(), 'class');
    foreach ($terms as $term) {
      $links .= '<a href="' . get_term_link($term) . '">';
      $links .= $term->name;
      $links .= "</a>";

      if( $i < count($terms) ) {
        $links .= ' | ';
      }
      $i++;
    }
    return $links;
  }

  private static function residentIsCurrent() {
    return get_field('current_resident');
  }

  private static function residentYearStart() {
    return get_field('year_start');
  }

  private static function residentYearEnd() {
    return get_field('year_end');
  }
}
