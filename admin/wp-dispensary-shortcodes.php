<?php
/**
 * Adding the Shortcodes for easy output of content
 * within any theme
 *
 * @link       https://www.wpdispensary.com
 * @since      1.2.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Shortcode images
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'dispensary-image', 360, 250, true );
	add_image_size( 'wpd-large', 1200, 1200, true );
	add_image_size( 'wpd-medium', 800, 800, true );
	add_image_size( 'wpd-small', 400, 400, true );
}

/**
 * Flowers Shortcode Fuction
 *
 * @access public
 *
 * @return string HTML markup.
 */
function wpdispensary_flowers_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'title'       => 'Flowers',
			'class'       => '',
			'id'          => '',
			'posts'       => '100',
			'name'        => 'show',
			'info'        => 'show',
			'thc'         => '',
			'thca'        => '',
			'cbd'         => '',
			'cba'         => '',
			'cbn'         => '',
			'cbg'         => '',
			'category'    => '',
			'aroma'       => '',
			'flavor'      => '',
			'effect'      => '',
			'symptom'     => '',
			'condition'   => '',
			'vendor'      => '',
			'shelf_type'  => '',
			'strain_type' => '',
			'orderby'     => '',
			'meta_key'    => '',
			'image'       => 'show',
			'imgsize'     => 'dispensary-image',
			'viewall'     => '',
		),
		$atts,
		'wpd_flowers'
	) );

	/**
	 * Defining variables
	 */
	$order    = '';
	$ordernew = '';
	$cba      = '';
	$showcba  = '';

	/**
	 * Code to create shortcode for Flowers
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $aroma ) {
			$tax_query[] = array(
				'taxonomy' => 'aroma',
				'field'    => 'slug',
				'terms'    => $aroma,
			);
	}
	if ( '' !== $flavor ) {
			$tax_query[] = array(
				'taxonomy' => 'flavor',
				'field'    => 'slug',
				'terms'    => $flavor,
			);
	}
	if ( '' !== $effect ) {
			$tax_query[] = array(
				'taxonomy' => 'effect',
				'field'    => 'slug',
				'terms'    => $effect,
			);
	}
	if ( '' !== $symptom ) {
			$tax_query[] = array(
				'taxonomy' => 'symptom',
				'field'    => 'slug',
				'terms'    => $symptom,
			);
	}
	if ( '' !== $condition ) {
			$tax_query[] = array(
				'taxonomy' => 'condition',
				'field'    => 'slug',
				'terms'    => $condition,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $shelf_type ) {
		$tax_query[] = array(
			'taxonomy' => 'shelf_type',
			'field'    => 'slug',
			'terms'    => $shelf_type,
		);
	}
	if ( '' !== $strain_type ) {
		$tax_query[] = array(
			'taxonomy' => 'strain_type',
			'field'    => 'slug',
			'terms'    => $strain_type,
		);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_flowers_shortcode_args', array(
		'post_type'        => 'flowers',
		'posts_per_page'   => $posts,
		'flowers_category' => $category,
		'tax_query'        => $tax_query,
		'orderby'          => $order,
		'order'            => $ordernew,
		'meta_key'         => $meta_key,
	) );

	$wpdquery = new WP_Query( $args );

	if ( 'show' === $viewall ) {
		$flowerslink = get_bloginfo( 'url' ) . '/flowers/';
		$viewflowers = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_flowers_shortcode_view_all', $flowerslink ) . '">' . __( '(view all)', 'wp-dispensary' ) . '</a></span>';
	} else {
		$viewflowers = '';
	}
  
	$wpdposts = '<div id="' . $id . '" class="wpdispensary"><h2 class="wpd-title">' . $title . $viewflowers . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		/** Check shortcode options input by user */

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Flower', 'wp-dispensary' ) . '" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu - Flower', 'wp-dispensary' ) . '" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Flower', 'wp-dispensary' ) . '" /></a>';
			}
		} else {
			$showimage = '';
		}

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = get_wpd_flowers_prices_simple( NULL, TRUE );
		} else {
			$showinfo = '';
		}

		/**
		 * Add compounds to array, if shortcode option is set to "show".
		 */
		if ( 'show' === $thc ) {
			$compounds_new[] = 'thc';
		}

		if ( 'show' === $cbd ) {
			$compounds_new[] = 'cbd';
		}

		if ( 'show' === $thca ) {
			$compounds_new[] = 'thca';
		}

		if ( 'show' === $cba ) {
			$compounds_new[] = 'cba';
		}

		if ( 'show' === $cbn ) {
			$compounds_new[] = 'cbn';
		}

		if ( 'show' === $cbg ) {
			$compounds_new[] = 'cbg';
		}

		// Get compounds.
		$compounds = get_wpd_compounds_simple( NULL, $compounds_new );

		/*
		echo "<pre>";
		print_r( $compounds );
		echo "</pre>";
		*/
		
		// Create empty variable.
		$showcompounds = '';

		/*
		// Loop through each compound, and append it to variable.
		foreach ( $compounds as $compound ) {
			$showcompounds .= '<span class="wpd-productinfo ' . $compound . '"><strong>' . __( $compound, 'wp-dispensary' ) . ':</strong> ' . $compound . '</span>';
		}
		*/

		// Combine compounds into one variable.
		$showcompounds = $compounds;

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_flowers' );
			$wpd_shortcode_top_flowers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-flowers ' . $class . '">' . $wpd_shortcode_top_flowers .$wpd_shortcode_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_flowers' );
			$wpd_shortcode_bottom_flowers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $showcompounds . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_flowers . '</div>';

	endwhile;

	wp_reset_postdata();

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
			'posts'       => '100',
			'class'       => '',
			'id'          => '',
			'name'        => 'show',
			'info'        => 'show',
			'thc'         => '',
			'thca'        => '',
			'cbd'         => '',
			'cba'         => '',
			'cbn'         => '',
			'cbg'         => '',
			'title'       => 'Concentrates',
			'category'    => '',
			'aroma'       => '',
			'flavor'      => '',
			'effect'      => '',
			'symptom'     => '',
			'condition'   => '',
			'vendor'      => '',
			'shelf_type'  => '',
			'strain_type' => '',
			'orderby'     => '',
			'meta_key'    => '',
			'image'       => 'show',
			'imgsize'     => 'dispensary-image',
			'viewall'     => '',
		),
		$atts,
		'wpd_concentrates'
	) );

	/**
	 * Defining variables
	 */
	$order    = '';
	$ordernew = '';
	$cba      = '';
	$showcba  = '';

	/**
	 * Code to create shortcode for Concentrates
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $aroma ) {
			$tax_query[] = array(
				'taxonomy' => 'aroma',
				'field'    => 'slug',
				'terms'    => $aroma,
			);
	}
	if ( '' !== $flavor ) {
			$tax_query[] = array(
				'taxonomy' => 'flavor',
				'field'    => 'slug',
				'terms'    => $flavor,
			);
	}
	if ( '' !== $effect ) {
			$tax_query[] = array(
				'taxonomy' => 'effect',
				'field'    => 'slug',
				'terms'    => $effect,
			);
	}
	if ( '' !== $symptom ) {
			$tax_query[] = array(
				'taxonomy' => 'symptom',
				'field'    => 'slug',
				'terms'    => $symptom,
			);
	}
	if ( '' !== $condition ) {
			$tax_query[] = array(
				'taxonomy' => 'condition',
				'field'    => 'slug',
				'terms'    => $condition,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $shelf_type ) {
		$tax_query[] = array(
			'taxonomy' => 'shelf_type',
			'field'    => 'slug',
			'terms'    => $shelf_type,
		);
	}
	if ( '' !== $strain_type ) {
		$tax_query[] = array(
			'taxonomy' => 'strain_type',
			'field'    => 'slug',
			'terms'    => $strain_type,
		);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}

	$args = apply_filters( 'wpd_concentrates_shortcode_args', array(
		'post_type'             => 'concentrates',
		'posts_per_page'        => $posts,
		'concentrates_category' => $category,
		'tax_query'             => $tax_query,
		'orderby'               => $order,
		'order'                 => $ordernew,
		'meta_key'              => $meta_key,
	) );

	$wpdquery = new WP_Query( $args );

	if ( 'show' === $viewall ) {
		$concentrateslink = get_bloginfo( 'url' ) . '/concentrates/';
		$viewconcentrates = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_concentrates_shortcode_view_all', $concentrateslink ) . '">' . __( '(view all)', 'wp-dispensary' ) . '</a></span>';
	} else {
		$viewconcentrates = '';
	}

	$wpdposts = '<div id="' . $id . '" class="wpdispensary"><h2 class="wpd-title">' . $title . $viewconcentrates . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = get_wpd_concentrates_prices_simple( NULL, TRUE );
		} else {
			$showinfo = '';
		}

		/**
		 * Add compounds to array, if shortcode option is set to "show".
		 */
		if ( 'show' === $thc ) {
			$compounds_new[] = 'thc';
		}

		if ( 'show' === $cbd ) {
			$compounds_new[] = 'cbd';
		}

		if ( 'show' === $thca ) {
			$compounds_new[] = 'thca';
		}

		if ( 'show' === $cba ) {
			$compounds_new[] = 'cba';
		}

		if ( 'show' === $cbn ) {
			$compounds_new[] = 'cbn';
		}

		if ( 'show' === $cbg ) {
			$compounds_new[] = 'cbg';
		}

		// Get compounds.
		$compounds = get_wpd_compounds_simple( NULL, $compounds_new );

		// Combine compounds into one variable.
		$showcompounds = $compounds;

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Concentrate', 'wp-dispensary' ) . '" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu - Concentrate', 'wp-dispensary' ) . '" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Concentrate', 'wp-dispensary' ) . '" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_concentrates' );
			$wpd_shortcode_top_concentrates = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-concentrates ' . $class . '">' . $wpd_shortcode_top_concentrates . $wpd_shortcode_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_concentrates' );
			$wpd_shortcode_bottom_concentrates = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $showcompounds . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_concentrates . '</div>';

	endwhile;

	wp_reset_postdata();

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
			'posts'      => '100',
			'class'      => '',
			'id'         => '',
			'name'       => 'show',
			'info'       => 'show',
			'title'      => 'Edibles',
			'category'   => '',
			'ingredient' => '',
			'vendor'     => '',
			'totalthc'   => 'show',
			'thcmg'      => '',
			'servings'   => '',
			'orderby'    => '',
			'meta_key'   => '',
			'image'      => 'show',
			'imgsize'    => 'dispensary-image',
			'viewall'    => '',
		),
		$atts,
		'wpd_edibles'
	) );

	/**
	 * Defining variables
	 */
	$order    = '';
	$ordernew = '';

	/**
	 * Code to create shortcode for Edibles
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $ingredient ) {
			$tax_query[] = array(
				'taxonomy' => 'ingredients',
				'field'    => 'slug',
				'terms'    => $ingredient,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_edibles_shortcode_args', array(
		'post_type'        => 'edibles',
		'posts_per_page'   => $posts,
		'edibles_category' => $category,
		'tax_query'        => $tax_query,
		'orderby'          => $order,
		'order'            => $ordernew,
		'meta_key'         => $meta_key,
	) );

	$wpdquery = new WP_Query( $args );

	if ( 'show' === $viewall ) {
		$edibleslink = get_bloginfo( 'url' ) . '/edibles/';
		$viewedibles = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_edibles_shortcode_view_all', $edibleslink ) . '">' . __( '(view all)', 'wp-dispensary' ) . '</a></span>';
	} else {
		$viewedibles = '';
	}

	$wpdposts = '<div id="' . $id . '" class="wpdispensary"><h2 class="wpd-title">' . $title . $viewedibles . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		// Serving Count.
		if ( get_post_meta( get_the_ID(), '_thccbdservings', true ) ) {
			if ( 'show' === $servings ) {
				$servingcount = '<span class="wpd-productinfo servings"><strong>' . __( 'Servings: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thccbdservings', true ). '</span>';
			} else {
				$servingcount = '';
			}
		} else {
			$servingcount = '';
		}

		// THC mg.
		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			if ( 'show' === $thcmg ) {
				$thc = '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thcmg', true ) . 'mg</span>';
			} else {
				$thc = '';
			}
		} else {
			$thc = '';
		}

		// Total THC (Servings X THC).
		if ( 'show' === $totalthc ) {
			$totalthc = '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thcmg', true ) * get_post_meta( get_the_id(), '_thccbdservings', true ) . 'mg</span>';
		} else {
			$totalthc = '';
		}

		// Price.
		$ediblepricing = get_wpd_edibles_prices_simple( NULL, TRUE );

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = $ediblepricing . $thc . $servingcount . $totalthc;
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Edible', 'wp-dispensary' ) . '" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu - Edible', 'wp-dispensary' ) . '" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Edible', 'wp-dispensary' ) . '" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_edibles' );
			$wpd_shortcode_top_edibles = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-edibles ' . $class . '">' . $wpd_shortcode_top_edibles . $wpd_shortcode_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_edibles' );
			$wpd_shortcode_bottom_edibles = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_edibles . '</div>';

	endwhile;

	wp_reset_postdata();

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
			'posts'       => '100',
			'class'       => '',
			'id'          => '',
			'name'        => 'show',
			'info'        => 'show',
			'title'       => 'Pre-rolls',
			'vendor'      => '',
			'shelf_type'  => '',
			'strain_type' => '',
			'orderby'     => '',
			'meta_key'    => '',
			'weight'      => 'show',
			'image'       => 'show',
			'imgsize'     => 'dispensary-image',
			'viewall'     => '',
		),
		$atts,
		'wpd_prerolls'
	) );

	/**
	 * Defining variables
	 */
	$order    = '';
	$ordernew = '';

	/**
	 * Code to create shortcode for Pre-rolls
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $shelf_type ) {
		$tax_query[] = array(
			'taxonomy' => 'shelf_type',
			'field'    => 'slug',
			'terms'    => $shelf_type,
		);
	}
	if ( '' !== $strain_type ) {
		$tax_query[] = array(
			'taxonomy' => 'strain_type',
			'field'    => 'slug',
			'terms'    => $strain_type,
		);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_prerolls_shortcode_args', array(
		'post_type'      => 'prerolls',
		'posts_per_page' => $posts,
		'tax_query'      => $tax_query,
		'orderby'        => $order,
		'order'          => $ordernew,
		'meta_key'       => $meta_key,
	) );

	$wpdquery = new WP_Query( $args );

	if ( 'show' === $viewall ) {
		$prerollslink = get_bloginfo( 'url' ) . '/prerolls/';
		$viewprerolls = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_prerolls_shortcode_view_all', $prerollslink ) . '">' . __( '(view all)', 'wp-dispensary' ) . '</a></span>';
	} else {
		$viewprerolls = '';
	}

	$wpdposts = '<div id="' . $id . '" class="wpdispensary"><h2 class="wpd-title">' . $title . $viewprerolls . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		/*
		 * Get the pricing for Pre-rolls
		 */
		$prerollpricing = get_wpd_prerolls_prices_simple( NULL, TRUE );

		/*
		 * Get the weight for Pre-rolls
		 */
		if ( get_post_meta( get_the_ID(), '_preroll_weight', true ) ) {
			$prerollweight = '<span class="wpd-productinfo weight"><strong>' . __( 'Weight:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_preroll_weight', true ) . 'g</span>';
		} else {
			$prerollweight = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = $prerollpricing . $prerollweight;
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Pre-roll', 'wp-dispensary' ) . '" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu - Pre-roll', 'wp-dispensary' ) . '" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Pre-roll', 'wp-dispensary' ) . '" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_prerolls' );
			$wpd_shortcode_top_prerolls = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-prerolls ' . $class . '">' . $wpd_shortcode_top_prerolls . $wpd_shortcode_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_prerolls' );
			$wpd_shortcode_bottom_prerolls = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_prerolls . '</div>';

	endwhile;

	wp_reset_postdata();

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
			'posts'      => '100',
			'class'      => '',
			'id'         => '',
			'name'       => 'show',
			'info'       => 'show',
			'title'      => 'Topicals',
			'category'   => '',
			'ingredient' => '',
			'vendor'     => '',
			'orderby'    => '',
			'meta_key'   => '',
			'image'      => 'show',
			'imgsize'    => 'dispensary-image',
			'viewall'    => '',
		),
		$atts,
		'wpd_topicals'
	) );

	/**
	 * Defining variables
	 */
	$order    = '';
	$ordernew = '';

	/**
	 * Code to create shortcode for Topicals
	 */

	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $ingredient ) {
			$tax_query[] = array(
				'taxonomy' => 'ingredients',
				'field'    => 'slug',
				'terms'    => $ingredient,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_topicals_shortcode_args', array(
		'post_type'         => 'topicals',
		'posts_per_page'    => $posts,
		'topicals_category' => $category,
		'tax_query'         => $tax_query,
		'orderby'           => $order,
		'order'             => $ordernew,
		'meta_key'          => $meta_key,
	) );

	$wpdquery = new WP_Query( $args );

	if ( 'show' === $viewall ) {
		$topicalslink = get_bloginfo( 'url' ) . '/topicals/';
		$viewtopicals = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_topicals_shortcode_view_all', $topicalslink ) . '">' . __( '(view all)', 'wp-dispensary' ) . '</a></span>';
	} else {
		$viewtopicals = '';
	}

	$wpdposts = '<div id="' . $id . '" class="wpdispensary"><h2 class="wpd-title">' . $title . $viewtopicals . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		// Price.
		$topicalpricing = get_wpd_topicals_prices_simple( NULL, TRUE );

		// Size.
		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$topicalsize = '<span class="wpd-productinfo size"><strong>' . __( 'Size:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_sizetopical', true ) . 'oz</span>';
			$topicalsize = '';
		}

		// THC.
		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$topicalthc = '<span class="wpd-productinfo thc"><strong>' . __( 'THC:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_thctopical', true ) . 'mg</span>';
		} else {
			$topicalthc = '';
		}

		// CBD.
		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$topicalcbd = '<span class="wpd-productinfo cbd"><strong>' . __( 'CBD:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_cbdtopical', true ) . 'mg</span>';
		} else {
			$topicalcbd = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = $topicalpricing . $topicalsize . $topicalthc . $topicalcbd;
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Topical', 'wp-dispensary' ) . '" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu - Topical', 'wp-dispensary' ) . '" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Topical', 'wp-dispensary' ) . '" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_topicals' );
			$wpd_shortcode_top_topicals = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-topicals ' . $class . '">' . $wpd_shortcode_top_topicals . $wpd_shortcode_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_topicals' );
			$wpd_shortcode_bottom_topicals = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_topicals . '</div>';

	endwhile;

	wp_reset_postdata();

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
			'posts'    => '100',
			'class'    => '',
			'id'       => '',
			'name'     => 'show',
			'info'     => 'show',
			'title'    => 'Growers',
			'category' => '',
			'vendor'   => '',
			'orderby'  => '',
			'meta_key' => '',
			'image'    => 'show',
			'imgsize'  => 'dispensary-image',
			'viewall'  => '',
		),
		$atts,
		'wpd_growers'
	) );

	/**
	 * Defining variables
	 */
	$order    = '';
	$ordernew = '';

	/**
	 * Code to create shortcode for Growers
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
		$order    = $orderby;
		$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_growers_shortcode_args', array(
		'post_type'        => 'growers',
		'tax_query'        => $tax_query,
		'posts_per_page'   => $posts,
		'growers_category' => $category,
		'orderby'          => $order,
		'order'            => $ordernew,
		'meta_key'         => $meta_key
	) );

	$wpdquery = new WP_Query( $args );

	if ( 'show' === $viewall ) {
		$growerslink = get_bloginfo( 'url' ) . '/growers/';
		$viewgrowers = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_growers_shortcode_view_all', $growerslink ) . '">' . __( '(view all)', 'wp-dispensary' ) . '</a></span>';
	} else {
		$viewgrowers = '';
	}

	$wpdposts = '<div id="' . $id . '" class="wpdispensary"><h2 class="wpd-title">' . $title . $viewgrowers . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		/*
		 * Get the pricing for Growers
		 */

		$growerspricing = get_wpd_growers_prices_simple( NULL, TRUE );

		/*
		 * Get the seed count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = '<span class="wpd-productinfo seeds"><strong>' . __( 'Seeds:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_seedcount', true ) . '</span>';
		} else {
			$wpdseedcount = '';
		}

		/*
		 * Get the clone count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = '<span class="wpd-productinfo clones"><strong>' . __( 'Clones:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_clonecount', true ) . '</span>';
		} else {
			$wpdclonecount = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = $growerspricing . $wpdseedcount . $wpdclonecount;
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null === $thumbnail_url && 'full' === $imagesize ) {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Grower', 'wp-dispensary' ) . '" /></a>';
			} elseif ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu - Grower', 'wp-dispensary' ) . '" /></a>';
			} else {
				$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
				$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu - Grower', 'wp-dispensary' ) . '" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_growers' );
			$wpd_shortcode_top_growers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-growers ' . $class . '">' . $wpd_shortcode_top_growers . $wpd_shortcode_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_growers' );
			$wpd_shortcode_bottom_growers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_growers . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-growers', 'wpdispensary_growers_shortcode' );


/**
 * Carousel Shortcode Fuction
 *
 * @access public
 *
 * @return string HTML markup.
 */
function wpdispensary_carousel_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'       => '100',
			'class'       => '',
			'id'          => '',
			'name'        => 'show',
			'info'        => 'show',
			'thc'         => '',
			'thca'        => '',
			'cbd'         => '',
			'cba'         => '',
			'cbn'         => '',
			'cbg'         => '',
			'totalthc'    => 'show',
			'title'       => 'Dispensary Menu',
			'category'    => '',
			'aroma'       => '',
			'flavor'      => '',
			'effect'      => '',
			'symptom'     => '',
			'condition'   => '',
			'vendor'      => '',
			'shelf_type'  => '',
			'strain_type' => '',
			'weight'      => 'show',
			'orderby'     => '',
			'meta_key'    => '',
			'type'        => "flowers, concentrates, edibles, prerolls, topicals, growers",
			'imgsize'     => 'dispensary-image',
		),
		$atts,
		'wpd_carousel'
	) );

	/**
	 * Defining variables
	 */
	$order    = '';
	$ordernew = '';

	/**
	 * Code to create shortcode
	 */

	// Create $tax_query variable.
	$tax_query = array(
		'relation' => 'AND',
	);

	// Add aromas to $tax_query.
	if ( '' !== $aroma ) {
			$tax_query[] = array(
				'taxonomy' => 'aroma',
				'field'    => 'slug',
				'terms'    => $aroma,
			);
	}

	// Add flavors to $tax_query.
	if ( '' !== $flavor ) {
			$tax_query[] = array(
				'taxonomy' => 'flavor',
				'field'    => 'slug',
				'terms'    => $flavor,
			);
	}

	// Add effects to $tax_query.
	if ( '' !== $effect ) {
			$tax_query[] = array(
				'taxonomy' => 'effect',
				'field'    => 'slug',
				'terms'    => $effect,
			);
	}

	// Add symptoms to $tax_query.
	if ( '' !== $symptom ) {
			$tax_query[] = array(
				'taxonomy' => 'symptom',
				'field'    => 'slug',
				'terms'    => $symptom,
			);
	}

	// Add conditions to $tax_query.
	if ( '' !== $condition ) {
			$tax_query[] = array(
				'taxonomy' => 'condition',
				'field'    => 'slug',
				'terms'    => $condition,
			);
	}

	// Add vendors to $tax_query.
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}

	// Add shelf types to $tax_query.
	if ( '' !== $shelf_type ) {
		$tax_query[] = array(
			'taxonomy' => 'shelf_type',
			'field'    => 'slug',
			'terms'    => $shelf_type,
		);
	}

	// Add strain types to $tax_query.
	if ( '' !== $strain_type ) {
		$tax_query[] = array(
			'taxonomy' => 'strain_type',
			'field'    => 'slug',
			'terms'    => $strain_type,
		);
	}

	// Order by.
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}

	// Create $cat_tax_query variable.
	$cat_tax_query = array(
		'relation' => 'OR',
	);

	// Turn shortcode type="" input into an array.
	$array_type = explode( ', ', $type );

	// Turn shortcode category="" input into an array.
	$new_category = explode( ', ', $category );

	// If category="" isn't empty, add to $cat_tax_query.
	if ( ! empty( $category ) ) {

		// Add flowers categories to $cat_tax_query.
		if ( in_array( 'flowers', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'flowers_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}
		
		// Add concentrates categories to $cat_tax_query.
		if ( in_array( 'concentrates', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'concentrates_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}
		
		// Add edibles categories to $cat_tax_query.
		if ( in_array( 'edibles', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'edibles_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}
		
		// Add flowers categories to $cat_tax_query.
		if ( in_array( 'prerolls', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'flowers_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}
		
		// Add topicals categories to $cat_tax_query.
		if ( in_array( 'topicals', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'topicals_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}

		// Add growers categories to $cat_tax_query.
		if ( in_array( 'growers', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'growers_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}
	}

	// Create new tax query.
	$new_tax_query = array_merge( $tax_query, $cat_tax_query );

	// Create WP_Query args.
	$args = apply_filters( 'wpd_carousel_shortcode_args', array(
		'post_type'      => explode( ', ', $type ),
		'posts_per_page' => $posts,
		'tax_query'      => $new_tax_query,
		'orderby'        => $order,
		'order'          => $ordernew,
		'meta_key'       => $meta_key,
	) );

	// Create new WP_Query.
	$wpdquery = new WP_Query( $args );

	if ( '' === $title ) {
		$showtitle = '';
	} else {
		$showtitle = '<h2 class="wpd-title">' . $title . '</h2>';
	}

	$wpdposts = '<div id="' . $id . '" class="wpdispensary">' . $showtitle . '<div class="wpd-carousel">';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		if ( 'show' === $thc ) {
			if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
				$thcinfo = '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thc', true ) . '%</span>';
			}
		} else {
			$thcinfo = '';
		}

		if ( 'show' === $thca ) {
			if ( get_post_meta( get_the_ID(), '_thca', true ) ) {
				$thcainfo = '<span class="wpd-productinfo thca"><strong>' . __( 'THCA: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thca', true ) . '%</span>';
			}
		} else {
			$thcainfo = '';
		}

		if ( 'show' === $cbd ) {
			if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
				$cbdinfo = '<span class="wpd-productinfo cbd"><strong>' . __( 'CBD: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_cbd', true ) . '%</span>';
			}
		} else {
			$cbdinfo = '';
		}

		if ( 'show' === $cba ) {
			if ( get_post_meta( get_the_ID(), '_cba', true ) ) {
				$cbainfo = '<span class="wpd-productinfo cba"><strong>' . __( 'CBA: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_cba', true ) . '%</span>';
			}
		} else {
			$cbainfo = '';
		}

		if ( 'show' === $cbn ) {
			if ( get_post_meta( get_the_ID(), '_cbn', true ) ) {
				$cbninfo = '<span class="wpd-productinfo cbn"><strong>' . __( 'CBN: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_cbn', true ) . '%</span>';
			}
		} else {
			$cbninfo = '';
		}

		if ( 'show' === $cbg ) {
			if ( get_post_meta( get_the_ID(), '_cbg', true ) ) {
				$cbginfo = '<span class="wpd-productinfo cbg"><strong>' . __( 'CBG: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_cbg', true ) . '%</span>';
			}
		} else {
			$cbginfo = '';
		}

		// Total THC (Servings X THC).
		if ( 'show' === $totalthc ) {
			if ( '' != get_post_meta( get_the_id(), '_thcmg', true ) && '' != get_post_meta( get_the_id(), '_thccbdservings', true ) ) {
				$total_thc = '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thcmg', true ) * get_post_meta( get_the_id(), '_thccbdservings', true ) . 'mg</span>';
			} else {
				$total_thc = '';
			}
		} else {
			$total_thc = '';
		}

		/*
		 * Get the seed count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = '<span class="wpd-productinfo seeds"><strong>' . __( 'Seeds:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_seedcount', true );
		} else {
			$wpdseedcount = '';
		}

		/*
		 * Get the clone count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = '<span class="wpd-productinfo clones"><strong>' . __( 'Clones:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_clonecount', true );
		} else {
			$wpdclonecount = '';
		}

		/** Get the details for Topicals */

		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$topicalsize = '<span class="wpd-productinfo size"><strong>' . __( 'Size:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_sizetopical', true ) . 'oz</span>';
		} else {
			$topicalsize = '';
		}

		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$topicalthc = '<span class="wpd-productinfo thc"><strong>' . __( 'THC:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_thctopical', true ) . 'mg</span>';
		} else {
			$topicalthc = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$topicalcbd = '<span class="wpd-productinfo cbd"><strong>' . __( 'CBD:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_cbdtopical', true ) . 'mg</span>';
		} else {
			$topicalcbd = '';
		}

		/*
		 * Get the weight for Pre-rolls
		 */
		if ( 'show' === $weight ) {
			if ( get_post_meta( get_the_ID(), '_preroll_weight', true ) ) {
				$prerollweight = '<span class="wpd-productinfo weight"><strong>' . __( 'Weight:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_preroll_weight', true ) . 'g</span>';
			} else {
				$prerollweight = '';
			}
		} else {
			$prerollweight = '';
		}

		/*
		 * Get the details for Edibles
		 */

		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			$thcmg = '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thcmg', true ) . 'mg</span>';
		} else {
			$thcmg = '';
		}

		$thcsep = ' - ';

		if ( get_post_meta( get_the_ID(), '_thccbdservings', true ) ) {
			$servingcount = '<span class="wpd-productinfo servings"><strong>' . __( 'Servings: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thccbdservings', true ) . '</span>';
		} else {
			$servingcount = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		/** Growers */
		if ( in_array( get_post_type(), array( 'growers' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_growers_prices_simple() . '</span>' . $wpdseedcount . $wpdclonecount;
			} else {
				$showinfo = '';
			}
		}

		/** Topicals */
		if ( in_array( get_post_type(), array( 'topicals' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_topicals_prices_simple() . '</span>';
			} else {
				$showinfo = '';
			}
		}

		/** Pre-rolls */
		if ( in_array( get_post_type(), array( 'prerolls' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_prerolls_prices_simple() . '</span>' . $prerollweight;
			} else {
				$showinfo = '';
			}
		}

		/** Edibles */
		if ( in_array( get_post_type(), array( 'edibles' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_edibles_prices_simple() . '</span>' . $total_thc;
			} else {
				$showinfo = '';
			}
		}

		/** Concentrates */
		if ( in_array( get_post_type(), array( 'concentrates' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_concentrates_prices_simple() . '</span>';
			} else {
				$showinfo = '';
			}
		}

		/** Flowers */
		if ( in_array( get_post_type(), array( 'flowers' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_flowers_prices_simple() . '</span>';
			} else {
				$showinfo = '';
			}
		}

		if ( null === $thumbnail_url && 'full' === $imagesize ) {
			$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
			$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
			$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu item', 'wp-dispensary' ) . '" /></a>';
		} elseif ( null !== $thumbnail_url ) {
			$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="' . __( 'Menu item', 'wp-dispensary' ) . '" /></a>';
		} else {
			$wpd_shortcodes_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
			$defaultimg                   = apply_filters( 'wpd_shortcodes_default_image', $wpd_shortcodes_default_image );
			$showimage                    = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="' . __( 'Menu item', 'wp-dispensary' ) . '" /></a>';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_carousel' );
			$wpd_shortcode_top_carousel = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="carousel-item ' . $class . '">' . $wpd_shortcode_top_carousel . $wpd_shortcode_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_carousel' );
			$wpd_shortcode_bottom_carousel = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_shortcode_inside_bottom . $wpd_shortcode_bottom_carousel . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div></div>';

}
add_shortcode( 'wpd-carousel', 'wpdispensary_carousel_shortcode' );
