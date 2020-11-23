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
 * Add custom image sizes.
 *
 * @since 1.0
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'dispensary-image', 360, 250, true );
	add_image_size( 'wpd-large', 1200, 1200, true );
	add_image_size( 'wpd-medium', 800, 800, true );
	add_image_size( 'wpd-small', 400, 400, true );
	add_image_size( 'wpd-thumbnail', 50, 50, true );
}

/**
 * Carousel Shortcode Fuction
 *
 * @access public
 *
 * @return string HTML markup.
 */
function wpdispensary_carousel_shortcode( $atts ) {
	// Menu types (string).
	$menu_types = implode ( ', ', wpd_menu_types_simple( true ) );

	// Attributes.
	extract( shortcode_atts(
		array(
			'posts'       => '18',
			'class'       => '',
			'id'          => '',
			'title'       => esc_attr__( 'Recent Products', 'wp-dispensary' ),
			'name'        => 'show',
			'info'        => 'show',
			'thc'         => 'show',
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
			'total_thc'   => 'show',
			'seed_count'  => 'show',
			'clone_count' => 'show',
			'size'        => 'show',
			'weight'      => 'show',
			'servings'    => '',
			'orderby'     => '',
			'meta_key'    => '',
			'type'        => $menu_types,
			'image'       => 'show',
			'imgsize'     => 'wpd-small',
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

		// Add gear categories to $cat_tax_query.
		if ( in_array( 'gear', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'gear_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}

		// Add tinctures categories to $cat_tax_query.
		if ( in_array( 'tinctures', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'tinctures_category',
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

	// Title.
	if ( '' === $title ) {
		$showtitle = '';
	} else {
		$showtitle = '<h2 class="wpd-title">' . $title . '</h2>';
	}

	$wpdposts = '<div id="' . $id . '" class="carouselwrap">' . $showtitle . '<div class="wpd-carousel">';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		// Product title.
		$querytitle = get_the_title();

		// Product details.
		$product_details = array(
			'thc'         => $thc,
			'thca'        => $thca,
			'cbd'         => $cbd,
			'cba'         => $cba,
			'cbn'         => $cbn,
			'cbg'         => $cbg,
			'seed_count'  => $seed_count,
			'clone_count' => $clone_count,
			'total_thc'   => $total_thc,
			'size'        => $size,
			'servings'    => $servings,
			'weight'      => $weight
		);

		$show_info = get_wpd_product_details( get_the_ID(), $product_details, 'span' );

		// Product name.
		if ( 'show' === $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . $querytitle . '</a></h2>';
		} else {
			$showname = '';
		}

		// Growers info.
		if ( in_array( get_post_type(), array( 'growers' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_growers_prices_simple( get_the_ID(), NULL ) . '</span>';
			} else {
				$showinfo = '';
			}
		}

		// Topicals info.
		if ( in_array( get_post_type(), array( 'topicals' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_topicals_prices_simple( get_the_ID(), NULL) . '</span>';
			} else {
				$showinfo = '';
			}
		}

		// Pre-rolls.
		if ( in_array( get_post_type(), array( 'prerolls' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_prerolls_prices_simple( get_the_ID(), NULL ) . '</span>';
			} else {
				$showinfo = '';
			}
		}

		// Edibles.
		if ( in_array( get_post_type(), array( 'edibles' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_edibles_prices_simple( get_the_ID(), NULL ) . '</span>';
			} else {
				$showinfo = '';
			}
		}

		// Concentrates.
		if ( in_array( get_post_type(), array( 'concentrates' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_concentrates_prices_simple( get_the_ID(), NULL ) . '</span>';
			} else {
				$showinfo = '';
			}
		}

		// Flowers.
		if ( in_array( get_post_type(), array( 'flowers' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_flowers_prices_simple( get_the_ID(), NULL ) . '</span>';
			} else {
				$showinfo = '';
			}
		}

		// Product info.
		$showinfo = apply_filters( 'wpd_shortcodes_product_price', $showinfo );

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
			do_action( 'wpd_shortcode_top_carousel' );
			$wpd_top_carousel = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="carousel-item ' . $class . '">' . $wpd_top_carousel . $wpd_inside_top . $wpd_image;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_carousel' );
			$wpd_bottom_carousel = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $show_info . $wpd_inside_bottom . $wpd_bottom_carousel . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div></div>';
}
add_shortcode( 'wpd-carousel', 'wpdispensary_carousel_shortcode' );

/**
 * WP Dispensary Menu Shortcode
 *
 * @access public
 *
 * @return string HTML markup.
 *
 * @since 2.6
 */
function wp_dispensary_menu_shortcode( $atts ) {

	// Menu types (string).
	$menu_types = implode ( ', ', wpd_menu_types( true ) );

	// Attributes.
	extract( shortcode_atts(
		array(
			'title'       => 'show',
			'posts'       => '100',
			'id'          => '',
			'class'       => '',
			'name'        => 'show',
			'price'       => 'show',
			'info'        => 'show',
			'thc'         => 'show',
			'thca'        => '',
			'cbd'         => '',
			'cba'         => '',
			'cbn'         => '',
			'cbg'         => '',
			'thcmg'       => '',
			'thc_topical' => '',
			'aroma'       => '',
			'flavor'      => '',
			'effect'      => '',
			'symptom'     => '',
			'condition'   => '',
			'vendor'      => '',
			'category'    => '',
			'shelf_type'  => '',
			'strain_type' => '',
			'total_thc'   => 'show',
			'weight'      => 'show',
			'seed_count'  => 'show',
			'clone_count' => 'show',
			'size'        => 'show',
			'servings'    => '',
			'order'       => 'DESC',
			'orderby'     => '',
			'meta_key'    => '',
			'type'        => $menu_types,
			'image'       => 'show',
			'image_size'  => 'wpd-small',
			'viewall'     => ''
		),
		$atts,
		'wpd_menu'
	) );

	// Default variables.
	$order_new = '';

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

		// Add tinctures categories to $cat_tax_query.
		if ( in_array( 'tinctures', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'wpd_tinctures_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}

		// Add gear categories to $cat_tax_query.
		if ( in_array( 'gear', $array_type ) ) {
			$cat_tax_query[] = array(
				'taxonomy' => 'wpd_gear_category',
				'field'    => 'name',
				'terms'    => $new_category,
			);
		}
	}

	// Create new tax query.
	$new_tax_query = array_merge( $tax_query, $cat_tax_query );

	// Products.
	$wpd_products = '';

	// Menu types.
	$menu_types = apply_filters( 'wpd_shortcode_menu_types', $array_type );

	// Loop through menu types.
	foreach ( $menu_types as $key=>$value ) {

		// Create WP_Query args.
		$args = apply_filters( 'wpd_menu_shortcode_args', array(
			'post_type'      => $value,
			'posts_per_page' => $posts,
			'tax_query'      => $new_tax_query,
			'orderby'        => $orderby,
			'order'          => $order,
			'meta_key'       => $meta_key,
		) );

		// Create new WP_Query.
		$wpd_query = new WP_Query( $args );

		// Get post type name.
		$post_type_data = get_post_type_object( $value );
		$post_type_name = $post_type_data->label;
		$post_type_slug = $post_type_data->rewrite['slug'];

		// Menu type name.
		$menu_type_name = $post_type_name;

		// Image size.
		if ( '' === $image_size ) {
			$img_size = 'dispensary-image';
		} else {
			$img_size = $image_size;
		}

		// Product details.
		$product_details = array(
			'thc'         => $thc,
			'thca'        => $thca,
			'cbd'         => $cbd,
			'cba'         => $cba,
			'cbn'         => $cbn,
			'cbg'         => $cbg,
			'seed_count'  => $seed_count,
			'clone_count' => $clone_count,
			'total_thc'   => $total_thc,
			'size'        => $size,
			'servings'    => $servings,
			'weight'      => $weight
		);

		// Display Title.
		if ( 'show' === $title ) {
			$show_title = '<h2 class="wpd-title">' . $menu_type_name . '</h2>';
		} else {
			$show_title = '';
		}

		// Product wrap start.
		$wpd_products .= '<div id="' . $id . '" class="wp-dispensary">' . $show_title . '<div class="wpd-menu">';

		// Product loop.
		while ( $wpd_query->have_posts() ) :
			$wpd_query->the_post();

			// Show name.
			if ( 'show' === $name ) {
				$show_name = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			} else {
				$show_name = '';
			}

			// Show Price.
			if ( 'show' === $price ) {
				$show_price = '<span class="wpd-productinfo pricing"><strong>' . esc_html( get_wpd_pricing_phrase( $singular = true ) ) . ':</strong> ' . get_wpd_all_prices_simple( get_the_ID() ) . '</span>';

				// Filter price.
				$show_price = apply_filters( 'wpd_shortcodes_product_price', $show_price );
			} else {
				$show_price = '';
			}

			// Set empty variable for info.
			$show_info = '';

			// Show info.
			if ( 'show' === $info ) {
				$show_info = get_wpd_product_details( get_the_ID(), $product_details, 'span' );
			}

			// Set empty variable for image.
			$wpd_image = '';

			// Set image if set to show.
			if ( 'show' === $image ) {
				$wpd_image = get_wpd_product_image( get_the_ID(), $img_size );
			}

			// Shortcode inside top action hook.
			ob_start();
				do_action( 'wpd_shortcode_inside_top' );
				$wpd_inside_top = ob_get_contents();
			ob_end_clean();

			// Shortcode menu top action hook.
			ob_start();
				do_action( 'wpd_shortcode_top_menu' );
				$wpd_menu_top = ob_get_contents();
			ob_end_clean();

			// Shortcode item start.
			$wpd_products .= '<div class="wpd-menu-item ' . $class . '">' . $wpd_menu_top . $wpd_inside_top . $wpd_image;

			// Shortcode inside bottom action hook.
			ob_start();
				do_action( 'wpd_shortcode_inside_bottom' );
				$wpd_inside_bottom = ob_get_contents();
			ob_end_clean();

			// Shortcode menu top action hook.
			ob_start();
				do_action( 'wpd_shortcode_bottom_menu' );
				$wpd_menu_bottom = ob_get_contents();
			ob_end_clean();

			// Shortcode item.
			$wpd_products .= $show_name . $show_price . $show_info . $wpd_inside_bottom . $wpd_menu_bottom;

			// Shortcode item end.
			$wpd_products .= '</div>';

		endwhile;

		wp_reset_postdata();

		// Shortcode inside top action hook.
		$wpd_products .= '</div>';

	}

	// Product wrap end.
	$wpd_products .= '</div>';

	return $wpd_products;
}
add_shortcode( 'wpd_menu', 'wp_dispensary_menu_shortcode' );
