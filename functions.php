<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

/**
 * Remove 'use_box' field from front page hero admin
 */
add_filter( 'tms/acf/layout/fg_front_page_components_hero/fields', function ( $fields ) {
    return array_filter( $fields, fn( $field ) => 'use_box' !== $field->get_name() );
} );

/**
 * Force hero box to be used
 */
add_filter( 'tms/acf/layout/hero/data', function ( $layout ) {
    $layout['use_box'] = true;

    return $layout;
}, 0, 1 );
