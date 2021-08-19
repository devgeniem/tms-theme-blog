<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\Blog;

/**
 * Remove 'use_box' field from front page hero admin
 */
add_filter( 'tms/acf/layout/fg_front_page_components_hero/fields', function ( $fields ) {
    return array_filter( $fields, fn( $f) => ! in_array( $f->get_name(), [ 'use_box', 'video' ], true ) );
} );

/**
 * Force hero box to be used
 */
add_filter( 'tms/acf/layout/hero/data', function ( $layout ) {
    $layout['use_box'] = true;

    return $layout;
}, 0, 1 );

/**
 * Remove social media layout from components
 */
add_filter( 'tms/acf/field/fg_onepager_components_components/layouts', __NAMESPACE__ . '\remove_social_media_layout' );
add_filter( 'tms/acf/field/fg_page_components_components/layouts', __NAMESPACE__ . '\remove_social_media_layout' );
add_filter( 'tms/acf/field/fg_front_page_components_components/layouts', __NAMESPACE__ . '\remove_social_media_layout' ); // phpcs:ignore
add_filter( 'tms/acf/field/fg_post_fields_components/layouts', __NAMESPACE__ . '\remove_social_media_layout' );
add_filter( 'tms/acf/field/fg_dynamic_event_fields_components/layouts', __NAMESPACE__ . '\remove_social_media_layout' );

/**
 * Remove social media layout from components
 *
 * @param array $layouts ACF Layouts.
 *
 * @return array
 */
function remove_social_media_layout( array $layouts ) : array {
    foreach ( $layouts as $key => $layout ) {
        if ( false !== strpos( $layout, 'SocialMediaLayout' ) ) {
            unset( $layouts[ $key ] );
        }
    }

    return $layouts;
}

/**
 * Remove share links from posts
 */
add_filter( 'tms/theme/share_links', fn() => false );

/**
 * Remove share links ACF block
 */
add_filter( 'tms/gutenberg/blocks', function ( $allowed_blocks ) {
    unset( $allowed_blocks['acf/share-links'] );

    return $allowed_blocks;
} );
