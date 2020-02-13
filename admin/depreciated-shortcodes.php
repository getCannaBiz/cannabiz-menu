<?php
/**
 * Depreciated shortcodes that are still able to be used, but will no longer be
 * updated with new features. Please use the [wpd_menu] shortcode.
 *
 * @link       https://www.wpdispensary.com
 * @since      3.3.3
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Flowers Shortcode Fuction
 *
 * @access public
 *
 * @return string HTML markup.
 */
function wpdispensary_flowers_shortcode( $atts ) {
	// Attributes.
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

		// The title.
		$querytitle = get_the_title();

		// Product name.
		if ( 'show' === $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . $querytitle . '</a></h2>';
		} else {
			$showname = '';
		}

		// Product info.
		if ( 'show' === $info ) {
			$showinfo = get_wpd_flowers_prices_simple( get_the_ID(), TRUE );

			// Filtered price.
			$showinfo = apply_filters( 'wpd_shortcodes_product_price', $showinfo );
		} else {
			$showinfo = '';
		}

		// Compounds.
		$compounds_new = array();

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
		$compounds = get_wpd_compounds_simple( get_the_ID(), NULL, $compounds_new );

		// Create empty variable.
		$show_compounds = '';

		// Combine compounds into one variable.
		$show_compounds = $compounds;

		// Set empty variable for image.
		$wpd_image = '';

		// Set image if set to show.
		if ( 'show' === $image ) {
			$wpd_image = get_wpd_product_image( get_the_ID(), $imgsize );
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_flowers' );
			$wpd_top_flowers = ob_get_contents();
		ob_end_clean();

		// Product wrapper.
		$wpdposts .= '<div class="wpdshortcode wpd-flowers ' . $class . '">' . $wpd_top_flowers . $wpd_inside_top . $wpd_image;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_flowers' );
			$wpd_bottom_flowers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $show_compounds . $wpd_inside_bottom . $wpd_bottom_flowers . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-flowers', 'wpdispensary_flowers_shortcode' );

/**
 * Concentrates Shortcode Function
 */
function wpdispensary_concentrates_shortcode( $atts ) {
	// Attributes.
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

		// Product title.
		$querytitle = get_the_title();

		// Product name.
		if ( 'show' === $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . $querytitle . '</a></h2>';
		} else {
			$showname = '';
		}

		// Product info.
		if ( 'show' === $info ) {
			// Set price.
			$showinfo = get_wpd_concentrates_prices_simple( get_the_ID(), TRUE );

			// Filtered price.
			$showinfo = apply_filters( 'wpd_shortcodes_product_price', $showinfo );
		} else {
			$showinfo = '';
		}

		$compounds_new = array();

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
		$compounds = get_wpd_compounds_simple( get_the_ID(), NULL, $compounds_new );

		// Combine compounds into one variable.
		$show_compounds = $compounds;

		// Set empty variable for image.
		$wpd_image = '';

		// Set image if set to show.
		if ( 'show' === $image ) {
			$wpd_image = get_wpd_product_image( get_the_ID(), $imgsize );
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_concentrates' );
			$wpd_top_concentrates = ob_get_contents();
		ob_end_clean();

		// Product wrapper.
		$wpdposts .= '<div class="wpdshortcode wpd-concentrates ' . $class . '">' . $wpd_top_concentrates . $wpd_inside_top . $wpd_image;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_concentrates' );
			$wpd_bottom_concentrates = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $show_compounds . $wpd_inside_bottom . $wpd_bottom_concentrates . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-concentrates', 'wpdispensary_concentrates_shortcode' );

/**
 * Edibles Shortcode Function
 */
function wpdispensary_edibles_shortcode( $atts ) {
	// Attributes.
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

	// Product args.
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

		// Product title.
		$querytitle = get_the_title();

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
			if ( '' != get_post_meta( get_the_id(), '_thcmg', true ) && '' != get_post_meta( get_the_id(), '_thccbdservings', true ) ) {
				$total_thc = '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( get_the_id(), '_thcmg', true ) * get_post_meta( get_the_id(), '_thccbdservings', true ) . 'mg</span>';
			} else {
				$total_thc = '';
			}
		} else {
			$total_thc = '';
		}

		// Price.
		$ediblepricing = get_wpd_edibles_prices_simple( get_the_ID(), TRUE );

		// Filtered price.
		$ediblepricing = apply_filters( 'wpd_shortcodes_product_price', $ediblepricing );

		// Product name.
		if ( 'show' === $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . $querytitle . '</a></h2>';
		} else {
			$showname = '';
		}

		// Product info.
		if ( 'show' === $info ) {
			$showinfo = $ediblepricing . $thc . $servingcount . $total_thc;
		} else {
			$showinfo = '';
		}

		// Set empty variable for image.
		$wpd_image = '';

		// Set image if set to show.
		if ( 'show' === $image ) {
			$wpd_image = get_wpd_product_image( get_the_ID(), $imgsize );
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_edibles' );
			$wpd_top_edibles = ob_get_contents();
		ob_end_clean();

		// Product wrapper.
		$wpdposts .= '<div class="wpdshortcode wpd-edibles ' . $class . '">' . $wpd_top_edibles . $wpd_inside_top . $wpd_image;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_edibles' );
			$wpd_bottom_edibles = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_inside_bottom . $wpd_bottom_edibles . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-edibles', 'wpdispensary_edibles_shortcode' );

/**
 * Pre-rolls Shortcode Function
 */
function wpdispensary_prerolls_shortcode( $atts ) {
	// Attributes.
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

	// Product args.
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

		// Product title.
		$querytitle = get_the_title();

		// Product prices.
		$prerollpricing = get_wpd_prerolls_prices_simple( get_the_ID(), TRUE );

		// Filtered prices.
		$prerollpricing = apply_filters( 'wpd_shortcodes_product_price', $prerollpricing );

		// Product weight.
		if ( get_post_meta( get_the_ID(), '_preroll_weight', true ) ) {
			$prerollweight = '<span class="wpd-productinfo weight"><strong>' . __( 'Weight:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_preroll_weight', true ) . 'g</span>';
		} else {
			$prerollweight = '';
		}

		// Product name.
		if ( 'show' === $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . $querytitle . '</a></h2>';
		} else {
			$showname = '';
		}

		// Product info.
		if ( 'show' === $info ) {
			$showinfo = $prerollpricing . $prerollweight;
		} else {
			$showinfo = '';
		}

		// Set empty variable for image.
		$wpd_image = '';

		// Set image if set to show.
		if ( 'show' === $image ) {
			$wpd_image = get_wpd_product_image( get_the_ID(), $imgsize );
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_prerolls' );
			$wpd_top_prerolls = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-prerolls ' . $class . '">' . $wpd_top_prerolls . $wpd_inside_top . $wpd_image;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_prerolls' );
			$wpd_bottom_prerolls = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_inside_bottom . $wpd_bottom_prerolls . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-prerolls', 'wpdispensary_prerolls_shortcode' );


/**
 * Topicals Shortcode Fuction
 */
function wpdispensary_topicals_shortcode( $atts ) {
	// Attributes.
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

	// Product args.
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

		// Product title.
		$querytitle = get_the_title();

		// Price.
		$topicalpricing = get_wpd_topicals_prices_simple( get_the_ID(), TRUE );

		// Filtered price.
		$topicalpricing = apply_filters( 'wpd_shortcodes_product_price', $topicalpricing );

		// Size.
		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$topicalsize = '<span class="wpd-productinfo size"><strong>' . __( 'Size:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_sizetopical', true ) . 'oz</span>';
		} else {
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

		// Product name.
		if ( 'show' === $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . $querytitle . '</a></h2>';
		} else {
			$showname = '';
		}

		// Product info.
		if ( 'show' === $info ) {
			$showinfo = $topicalpricing . $topicalsize . $topicalthc . $topicalcbd;
		} else {
			$showinfo = '';
		}

		// Set empty variable for image.
		$wpd_image = '';

		// Set image if set to show.
		if ( 'show' === $image ) {
			$wpd_image = get_wpd_product_image( get_the_ID(), $imgsize );
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_topicals' );
			$wpd_top_topicals = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-topicals ' . $class . '">' . $wpd_top_topicals . $wpd_inside_top . $wpd_image;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_topicals' );
			$wpd_bottom_topicals = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_inside_bottom . $wpd_bottom_topicals . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-topicals', 'wpdispensary_topicals_shortcode' );


/**
 * Growers Shortcode Function
 */
function wpdispensary_growers_shortcode( $atts ) {
	// Attributes.
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

	// Product args.
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

		// Product title.
		$querytitle = get_the_title();

		// Price.
		$growerspricing = get_wpd_growers_prices_simple( get_the_ID(), TRUE );

		// Filtered price.
		$growerspricing = apply_filters( 'wpd_shortcodes_product_price', $growerspricing );

		// Seed count.
		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = '<span class="wpd-productinfo seeds"><strong>' . __( 'Seeds:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_seedcount', true ) . '</span>';
		} else {
			$wpdseedcount = '';
		}

		// Clone count.
		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = '<span class="wpd-productinfo clones"><strong>' . __( 'Clones:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( get_the_id(), '_clonecount', true ) . '</span>';
		} else {
			$wpdclonecount = '';
		}

		// Product name.
		if ( 'show' === $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . $querytitle . '</a></h2>';
		} else {
			$showname = '';
		}

		// Product info.
		if ( 'show' === $info ) {
			$showinfo = $growerspricing . $wpdseedcount . $wpdclonecount;
		} else {
			$showinfo = '';
		}

		// Set empty variable for image.
		$wpd_image = '';

		// Set image if set to show.
		if ( 'show' === $image ) {
			$wpd_image = get_wpd_product_image( get_the_ID(), $imgsize );
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_growers' );
			$wpd_top_growers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-growers ' . $class . '">' . $wpd_top_growers . $wpd_inside_top . $wpd_image;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_growers' );
			$wpd_bottom_growers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_inside_bottom . $wpd_bottom_growers . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-growers', 'wpdispensary_growers_shortcode' );
