<?php
/**
 * Adding the Shortcodes for easy output of content
 * within any theme
 *
 * @link       http://www.wpdispensary.com
 * @since      1.2.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Shortcode Image
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'dispensary-image', 360, 250, true );
}

/**
 * Flowers Shortcode Fuction
 */
function wpdispensary_flowers_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'		=> '100',
			'class'		=> '',
			'name'		=> 'show',
			'info'		=> 'show',
			'title'		=> 'Flowers'
		),
		$atts
	) );

	/**
	 * Code to create shortcode for Flowers
	 */

	$wpdquery = new WP_Query(
		array(
			'post_type' 		=> 'flowers',
			'posts_per_page'	=> $posts,
		)
	);

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">'. $title .'</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		$thumbnail_id 			= get_post_thumbnail_id();
		$thumbnail_url_array	= wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image', true );
		$thumbnail_url			= $thumbnail_url_array[0];
		$querytitle 			= get_the_title();

		/** Get the pricing for Flowers and Concentrates */

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$pricinglow = '$' . get_post_meta( get_the_id(), '_halfgram', true );
		} elseif ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$pricinglow = '$' . get_post_meta( get_the_id(), '_gram', true );
		} elseif ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$pricinglow = '$' . get_post_meta( get_the_id(), '_eighth', true );
		} elseif ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$pricinglow = '$' . get_post_meta( get_the_id(), '_quarter', true );
		} elseif ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$pricinglow = '$' . get_post_meta( get_the_id(), '_halfounce', true );
		}
		$pricingsep = ' - ';
		if ( get_post_meta( get_the_ID(), '_ounce', true ) ) {
			$pricinghigh = '$' . get_post_meta( get_the_id(), '_ounce', true );
		} elseif ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$pricinghigh = '$' . get_post_meta( get_the_id(), '_halfounce', true );
		} elseif ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$pricinghigh = '$' . get_post_meta( get_the_id(), '_quarter', true );
		} elseif ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$pricinghigh = '$' . get_post_meta( get_the_id(), '_eighth', true );
		} elseif ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$pricinghigh = '$' . get_post_meta( get_the_id(), '_gram', true );
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( $info == "show" ) {
			$showinfo = '<span class="wpd-productinfo"><strong>Price:</strong> ' . $pricinglow . '' . $pricingsep . '' . $pricinghigh . '</span>';
		} else {
			$showinfo = '';
		}

		/** Shortcode display */

		$wpdposts .= '<div class="wpdshortcode wpd-flowers ' . $class .'"><a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Flower" /></a>'. $showname .''. $showinfo .'</div>';

	endwhile;

	wp_reset_query();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-flowers', 'wpdispensary_flowers_shortcode' );

/**
 * Concentrates Shortcode Function
 */
function wpdispensary_concentrates_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'		=> '100',
			'class'		=> '',
			'name'		=> 'show',
			'info'		=> 'show',
			'title'		=> 'Concentrates'
		),
		$atts
	) );

	/**
	 * Code to create shortcode for Concentrates
	 */

	$wpdquery = new WP_Query(
		array(
			'post_type' 		=> 'concentrates',
			'posts_per_page'	=> $posts,
		)
	);

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">'. $title .'</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		$thumbnail_id			= get_post_thumbnail_id();
		$thumbnail_url_array	= wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image', true );
		$thumbnail_url			= $thumbnail_url_array[0];
		$querytitle				= get_the_title();

		/** Get the pricing for Concentrates */

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$pricinglow		= '$' . get_post_meta( get_the_id(), '_halfgram', true );
			$pricingname	= '<strong>1/2 gram: </strong>';
		} elseif ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$pricinglow		= '$' . get_post_meta( get_the_id(), '_gram', true );
			$pricingname	= '<strong>1 gram: </strong>';
		} elseif ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$pricinglow		= '$' . get_post_meta( get_the_id(), '_eighth', true );
			$pricingname	= '<strong>1/8 ounce: </strong>';
		} elseif ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$pricinglow		= '$' . get_post_meta( get_the_id(), '_quarter', true );
			$pricingname	= '<strong>1/4 ounce: </strong>';
		} elseif ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$pricinglow		= '$' . get_post_meta( get_the_id(), '_halfounce', true );
			$pricingname	= '<strong>1/2 ounce: </strong>';
		} elseif ( get_post_meta( get_the_ID(), '_ounce', true ) ) {
			$pricinglow		= '$' . get_post_meta( get_the_id(), '_founce', true );
			$pricingname	= '<strong>1 ounce: </strong>';
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( $info == "show" ) {
			$showinfo = '<span class="wpd-productinfo">' . $pricingname . '' . $pricinglow . '</span>';
		} else {
			$showinfo = '';
		}

		/** Shortcode display */

		$wpdposts .= '<div class="wpdshortcode wpd-concentrates ' . $class .'"><a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Concentrate" /></a>'. $showname .''. $showinfo .'</div>';

	endwhile;

	wp_reset_query();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-concentrates', 'wpdispensary_concentrates_shortcode' );

/**
 * Edibles Shortcode Function
 */
function wpdispensary_edibles_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'		=> '100',
			'class'		=> '',
			'name'		=> 'show',
			'info'		=> 'show',
			'title'		=> 'Edibles'
		),
		$atts
	) );

	/**
	 * Code to create shortcode for Edibles
	 */

	$wpdquery = new WP_Query(
		array(
			'post_type' 		=> 'edibles',
			'posts_per_page'	=> $posts,
		)
	);

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">'. $title .'</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		$thumbnail_id			= get_post_thumbnail_id();
		$thumbnail_url_array	= wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image', true );
		$thumbnail_url			= $thumbnail_url_array[0];
		$querytitle				= get_the_title();

		/*
		 * Get the pricing for Edibles
		 */

		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			$thcmg = '<strong>THC: </strong>' . get_post_meta( get_the_id(), '_thcmg', true ) . 'mg';
		}
		$thcsep = ' - ';
		if ( get_post_meta( get_the_ID(), '_thcservings', true ) ) {
			$thcservings = '<strong>Servings: </strong>' . get_post_meta( get_the_id(), '_thcservings', true );
		}
		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$priceeach = '<strong>Price:</strong> $' . get_post_meta( get_the_id(), '_priceeach', true );
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( $info == "show" ) {
			$showinfo = '<span class="wpd-productinfo">' . $priceeach . '' . $thcsep . '' . $thcmg . '' . $thcsep . '' . $thcservings . '</span>';
		} else {
			$showinfo = '';
		}

		/** Shortcode display */

		$wpdposts .= '<div class="wpdshortcode wpd-edibles ' . $class .'"><a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Edible" /></a>'. $showname .''. $showinfo .'</div>';

	endwhile;

	wp_reset_query();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-edibles', 'wpdispensary_edibles_shortcode' );

/**
 * Pre-rolls Shortcode Function
 */
function wpdispensary_prerolls_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'		=> '100',
			'class'		=> '',
			'name'		=> 'show',
			'info'		=> 'show',
			'title'		=> 'Pre-rolls'
		),
		$atts
	) );

	/**
	 * Code to create shortcode for Pre-rolls
	 */

	$wpdquery = new WP_Query(
		array(
			'post_type' 		=> 'prerolls',
			'posts_per_page'	=> $posts,
		)
	);

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">'. $title .'</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		$thumbnail_id			= get_post_thumbnail_id();
		$thumbnail_url_array	= wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image', true );
		$thumbnail_url			= $thumbnail_url_array[0];
		$querytitle 			= get_the_title();

		/*
		 * Get the pricing for Pre-rolls
		 */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingeach = '<strong>Price:</strong> $' . get_post_meta( get_the_id(), '_priceeach', true ) . ' per roll';
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( $info == "show" ) {
			$showinfo = '<span class="wpd-productinfo">' . $pricingeach . '</span>';
		} else {
			$showinfo = '';
		}

		/** Shortcode display */

		$wpdposts .= '<div class="wpdshortcode wpd-prerolls ' . $class .'"><a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Pre-roll" /></a>'. $showname .''. $showinfo .'</div>';

	endwhile;

	wp_reset_query();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-prerolls', 'wpdispensary_prerolls_shortcode' );


/**
 * Topicals Shortcode Fuction
 */
function wpdispensary_topicals_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'		=> '100',
			'class'		=> '',
			'name'		=> 'show',
			'info'		=> 'show',
			'title'		=> 'Topicals'
		),
		$atts
	) );

	/**
	 * Code to create shortcode for Topicals
	 */

	$wpdquery = new WP_Query(
		array(
			'post_type' 		=> 'topicals',
			'posts_per_page'	=> $posts,
		)
	);

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">'. $title .'</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		$thumbnail_id			= get_post_thumbnail_id();
		$thumbnail_url_array	= wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image', true );
		$thumbnail_url			= $thumbnail_url_array[0];
		$querytitle				= get_the_title();

		/** Get the pricing for Topicals */

		if ( get_post_meta( get_the_ID(), '_pricetopical', true ) ) {
			$topicalprice = '<strong>Price:</strong> $' . get_post_meta( get_the_id(), '_pricetopical', true ) . '';
		}
		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$topicalsize = ' - <strong>Size:</strong> '. get_post_meta( get_the_id(), '_sizetopical', true ) . 'oz';
		}
		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$topicalthc = ' - <strong>THC:</strong> '. get_post_meta( get_the_id(), '_thctopical', true ) . 'mg';
		}
		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$topicalcbd = ' - <strong>CBD:</strong> '. get_post_meta( get_the_id(), '_cbdtopical', true ) . 'mg';
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( $info == "show" ) {
			$showinfo = '<span class="wpd-productinfo">' . $topicalprice . '' . $topicalsize . '' . $topicalthc . '' . $topicalcbd . '</span>';
		} else {
			$showinfo = '';
		}

		/** Shortcode display */

		$wpdposts .= '<div class="wpdshortcode wpd-topicals ' . $class .'"><a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Flower" /></a>' . $showname . '' . $showinfo . '</div>';

	endwhile;

	wp_reset_query();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-topicals', 'wpdispensary_topicals_shortcode' );


/**
 * Growers Shortcode Function
 */
function wpdispensary_growers_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'		=> '100',
			'class'		=> '',
			'name'		=> 'show',
			'info'		=> 'show',
			'title'		=> 'Growers'
		),
		$atts
	) );

	/**
	 * Code to create shortcode for Growers
	 */

	$wpdquery = new WP_Query(
		array(
			'post_type' 		=> 'growers',
			'posts_per_page'	=> $posts,
		)
	);

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">'. $title .'</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		$thumbnail_id			= get_post_thumbnail_id();
		$thumbnail_url_array	= wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image', true );
		$thumbnail_url			= $thumbnail_url_array[0];
		$querytitle 			= get_the_title();

		/*
		 * Get the pricing for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingperunit = '<strong>Price:</strong> $' . get_post_meta( get_the_id(), '_priceeach', true );
		}

		/*
		 * Get the seed count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = ' - <strong>Seeds:</strong> ' . get_post_meta( get_the_id(), '_seedcount', true );
		} else {
			$wpdseedcount = '';
		}

		/*
		 * Get the clone count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = ' - <strong>Clones:</strong> ' . get_post_meta( get_the_id(), '_clonecount', true );
		} else {
			$wpdclonecount = '';
		}

		/** Check shortcode options input by user */

		if ( $name == "show" ) {
			$showname = '<p><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( $info == "show" ) {
			$showinfo = '<span class="wpd-productinfo">' . $pricingperunit . '' . $wpdseedcount . '' . $wpdclonecount . '</span>';
		} else {
			$showinfo = '';
		}

		/** Shortcode display */

		$wpdposts .= '<div class="wpdshortcode wpd-growers ' . $class .'"><a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Grower" /></a>'. $showname .''. $showinfo .'</div>';

	endwhile;

	wp_reset_query();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-growers', 'wpdispensary_growers_shortcode' );
