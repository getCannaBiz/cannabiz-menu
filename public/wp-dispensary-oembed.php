<?php
/**
 * Adding oEmbed specific codes
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/public
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @link       https://www.wpdispensary.com
 * @since      4.0
 */

/**
 * Returns the custom excerpt for oEmbeds.
 *
 * @param string $output Default embed output.
 * 
 * @since  2.0
 * @return string 
 */
function wpd_excerpt_embed( $output ) {
    return the_content();
    // NOTE: the code below can never execute???
    return $output;
}
add_filter( 'the_excerpt_embed', 'wpd_excerpt_embed' );

/**
 * Filter to add a wrapper to embeds.
 *
 * @param string $html    string of html of the embed.
 * @param string $url     url that the embed is generated from.
 * @param string $attr    attributes to apply to the embed markup.
 * @param int    $post_id id of the attached post.
 * 
 * @return string string with updated markup with a wrapper added.
 */
function wpd_embed_oembed_html( $html, $url, $attr, $post_id ) {
    return '<div id="wpd-oembed-wrap">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'wpd_embed_oembed_html', 99, 4 );
