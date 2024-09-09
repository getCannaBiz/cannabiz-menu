<?php
/**
 * The file that defines the product helper functions.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes/fuctions
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      2.5.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

if ( ! function_exists( 'is_product' ) ) {
    /**
     * Is_product - Returns true when viewing a single product.
     *
     * @return bool
     */
    function is_product() {
        return is_singular( 'products' );
    }
}

/**
 * Update messages for product types.
 *
 * @param object $messages 
 * 
 * @since  2.5
 * @return object
 */
function wpd_product_updated_messages( $messages ) {
    global $post;

    // Product ID.
    $product_id = $post->ID;

    if ( 'products' === get_post_meta( $product_id, 'product_type', true ) ) {
        $messages['post'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( esc_html__( 'Product updated. <a href="%s">View product</a>' ), esc_url( get_permalink( $product_id ) ) ),
            2 => esc_html__( 'Product updated.', 'wp-dispensary' ),
            3 => esc_html__( 'Product deleted.', 'wp-dispensary' ),
            4 => esc_html__( 'Product updated.', 'wp-dispensary' ),
            5 => null == filter_input( INPUT_GET, 'revision' ) ? sprintf( esc_html__( 'Product restored to revision from %s' ), wp_post_revision_title( (int) filter_input( INPUT_GET, 'revision' ), false ) ) : false,
            6 => sprintf( esc_html__( 'Product published. <a href="%s">View product</a>' ), esc_url( get_permalink( $product_id ) ) ),
            7 => esc_html__( 'Product saved.', 'wp-dispensary' ),
            8 => sprintf( esc_html__( 'Product submitted. <a target="_blank" href="%s">Preview product</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
            9 => sprintf( esc_html__( 'Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>' ),
            date_i18n( esc_html__( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $product_id ) ) ),
            10 => sprintf( esc_html__( 'Product draft updated. <a target="_blank" href="%s">Preview product</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
        );
    } else {
        // Do nothing.
    }
    return $messages;
}
add_filter( 'post_updated_messages', 'wpd_product_updated_messages' );

/**
 * Product Details
 *
 * Get the details of products based on specific paramaters
 *
 * @param string $product_id 
 * @param array  $product_details 
 * @param string $wrapper 
 * 
 * @return void
 */
function get_wpd_product_details( $product_id, $product_details, $wrapper = 'span' ) {

    $str = '';

    // Create variable.
    $compounds_new = array();

    // Wrapper type.
    if ( isset( $wrapper ) ) {
        $wrapper = $wrapper;
    } else {
        $wrapper = 'span';
    }

    // Loop through required product details.
    foreach ( $product_details as $product=>$value ) {

        if ( 'show' === $value && 'thc' === $product ) {
            $compounds_new[] = 'thc';
        }

        if ( 'show' === $value && 'cbd' === $product ) {
            $compounds_new[] = 'cbd';
        }

        if ( 'show' === $value && 'thca' === $product ) {
            $compounds_new[] = 'thca';
        }

        if ( 'show' === $value && 'cba' === $product ) {
            $compounds_new[] = 'cba';
        }

        if ( 'show' === $value && 'cbn' === $product ) {
            $compounds_new[] = 'cbn';
        }

        if ( 'show' === $value && 'cbg' === $product ) {
            $compounds_new[] = 'cbg';
        }

    }

    // Get compounds.
    $compounds = get_wpd_compounds_simple( $product_id, null, $compounds_new );

    // Add compounds.
    $str .= $compounds;

    // Loop through required product details.
    foreach ( $product_details as $product=>$value ) {

        // Seed count.
        if ( 'show' === $value && 'seed_count' === $product ) {
            if ( get_post_meta( $product_id, 'seed_count', true ) ) {
                    $str .= '<'  . $wrapper . ' class="wpd-productinfo seeds"><strong>' . esc_attr__( 'Seeds', 'wp-dispensary' ) . ':</strong> ' . get_post_meta( $product_id, 'seed_count', true ) . '</'  . $wrapper . '>';
            } else {
                // Do nothing.
            }
        } else {
            // Do nothing.
        }

        // Clone count.
        if ( 'show' === $value && 'clone_count' === $product ) {
            if ( get_post_meta( $product_id, 'clone_count', true ) ) {
                $str .= '<'  . $wrapper . ' class="wpd-productinfo clones"><strong>' . esc_attr__( 'Clones', 'wp-dispensary' ) . ':</strong> ' . get_post_meta( $product_id, 'clone_count', true ) . '</'  . $wrapper . '>';
            } else {
                // Do nothing.
            }
        } else {
            // Do nothing.
        }

        // Size oz (Topicals).
        if ( 'show' === $value && 'size' === $product ) {
            if ( get_post_meta( $product_id, '_sizetopical', true ) ) {
                $str .= '<'  . $wrapper . ' class="wpd-productinfo size"><strong>' . esc_attr__( 'Size', 'wp-dispensary' ) . ':</strong> ' . get_post_meta( $product_id, '_sizetopical', true ) . 'oz</'  . $wrapper . '>';
            } else {
                // Do nothing.
            }
        } else {
            // Do nothing.
        }

        // THC mg (Topicals).
        if ( 'show' === $value && 'thc_topical' === $product ) {
            if ( get_post_meta( $product_id, '_thctopical', true ) ) {
                $str .= '<'  . $wrapper . ' class="wpd-productinfo thc"><strong>' . esc_attr__( 'THC', 'wp-dispensary' ) . ':</strong> ' . get_post_meta( $product_id, '_thctopical', true ) . 'mg</'  . $wrapper . '>';
            } else {
                // Do nothing.
            }
        } else {
            // Do nothing.
        }

        // CBD mg (Topicals).
        if ( 'show' === $value && 'cbd' === $product ) {
            if ( get_post_meta( $product_id, '_cbdtopical', true ) ) {
                $str .= '<'  . $wrapper . ' class="wpd-productinfo cbd"><strong>' . esc_attr__( 'CBD', 'wp-dispensary' ) . ':</strong> ' . get_post_meta( $product_id, '_cbdtopical', true ) . 'mg</'  . $wrapper . '>';
            } else {
                // Do nothing.
            }
        } else {
            // Do nothing.
        }

        // Pre-roll weight.
        if ( 'show' === $value && 'weight' === $product ) {
            if ( get_post_meta( $product_id, '_preroll_weight', true ) ) {
                $str .= '<'  . $wrapper . ' class="wpd-productinfo weight"><strong>' . esc_attr__( 'Weight', 'wp-dispensary' ) . ':</strong> ' . get_post_meta( $product_id, '_preroll_weight', true ) . 'g</'  . $wrapper . '>';
            } else {
                // Do nothing.
            }
        } else {
            // Do nothing.
        }

        // Servings (Edibles).
        if ( 'show' === $value && 'servings' === $product ) {
            if ( get_post_meta( $product_id, 'product_servings', true ) ) {
                $str .= '<'  . $wrapper . ' class="wpd-productinfo servings"><strong>' . esc_attr__( 'Servings', 'wp-dispensary' ) . ':</strong> ' . get_post_meta( $product_id, 'product_servings', true ) . '</'  . $wrapper . '>';
            } else {
                // Do nothing.
            }
        } else {
            // Do nothing.
        }

    }

    return $str;
}

/**
 * Product Details
 *
 * Get the details of products based on specific paramaters
 *
 * @param string $product_id 
 * @param array  $product_details 
 * @param string $wrapper 
 * 
 * @return void
 */
function wpd_product_details( $product_id, $product_details, $wrapper ) {
    echo apply_filters( 'wpd_product_details', get_wpd_product_details( $product_id, $product_details, $wrapper ) );
}

/**
 * Product Image
 *
 * Get the featured image of the product
 *
 * @param bool|string $product_id 
 * @param string      $image_size 
 * @param bool        $link 
 * 
 * @return void
 */
function get_wpd_product_image( $product_id = null, $image_size = null, $link = true ) {

    // Set product ID.
    if ( null === $product_id ) {
        $prod_id = get_the_ID();
    } else {
        $prod_id = $product_id;
    }

    // Set image size.
    if ( null === $image_size ) {
        $img_size = 'dispensary-image';
    } else {
        $img_size = $image_size;
    }

    $size = '';

    // Get all registered images sizes.
    $sizes = get_wpd_all_image_sizes();

    // Loop through image sizes.
    foreach ( $sizes as $key=>$val ) {
        // Update size if image matches.
        if ( $img_size === $key  ) {
            // Set the image size that's used in the HTML.
            $size = ' width="' . $val['width']. '" height="' . $val['height'] . '"';
            break;
        }
    }

    $thumbnail_id        = get_post_thumbnail_id( $prod_id );
    $thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $img_size, false );
    $thumbnail_url       = null;

    if ( $thumbnail_url_array ) {
        $thumbnail_url = $thumbnail_url_array[0];
    }

    // Show image.
    if ( null === $thumbnail_url && 'full' === $image_size ) {
        $default_url = site_url() . '/wp-content/plugins/wp-dispensary/public/assets/images/wpd-large.jpg';
        $default_img = apply_filters( 'wpd_shortcodes_default_image', $default_url );
        $show_image  = '<img src="' . $default_img . '" alt="' . get_the_title() . '" ' . $size . ' />';
        if ( true == $link ) {
            $show_image = '<a href="' . get_permalink( $product_id ) . '">' . $show_image . '</a>';
        }
    } elseif ( null !== $thumbnail_url ) {
        $show_image  = '<img src="' . $thumbnail_url . '" alt="' . get_the_title() . '" ' . $size . ' />';
        if ( true == $link ) {
            $show_image = '<a href="' . get_permalink( $product_id ) . '">' . $show_image . '</a>';
        }
    } else {
        $default_url = site_url() . '/wp-content/plugins/wp-dispensary/public/assets/images/' . $image_size . '.jpg';
        $default_img = apply_filters( 'wpd_shortcodes_default_image', $default_url );
        $show_image  = '<img src="' . $default_img . '" alt="' . get_the_title() . '" ' . $size . ' />';
        if ( true == $link ) {
            $show_image = '<a href="' . get_permalink( $product_id ) . '">' . $show_image . '</a>';
        }
    }

    return $show_image;
}

/**
 * Product image
 *
 * @param int    $product_id 
 * @param string $image_size 
 * @param bool   $link
 * 
 * @since  2.6
 * @return string
 */
function wpd_product_image( $product_id, $image_size, $link = true ) {
    echo apply_filters( 'wpd_product_image', get_wpd_product_image( $product_id, $image_size, $link ) );
}

/**
 * Get all featured image sizes
 *
 * @since  3.0
 * @return array
 */
function wpd_featured_image_sizes() {
    $image_sizes = array(
        'wpdispensary-widget',
        'dispensary-image',
        'wpd-thumbnail',
        'wpd-small',
        'wpd-medium',
        'wpd-large',
    );
    return apply_filters( 'wpd_featured_image_sizes', $image_sizes );
}

/**
 * Product Compound type
 * 
 * @param string $product_id 
 * 
 * @since  4.0
 * @return void|string
 */
function wpd_compound_type( $product_id ) {
    // Bail early?
    if ( ! $product_id ) {
        return;
    }
    // Get post type.
    $product_type = get_post_meta( $product_id, 'product_type', true );
    // Set % compound type.
    if ( 'flowers' == $product_type || 'concentrates' == $product_type || 'prerolls' == $product_type || 'tinctures' == $product_type ) {
        $type = '%';
    }
    // Set mg compound type.
    if ( 'edibles' == $product_type || 'topicals' == $product_type ) {
        $type = 'mg';
    }
    // Default return.
    if ( ! isset( $type ) ) {
        return '';
    }
    // Return type.
    return $type;
}

/**
 * Compounds details - Simple
 *
 * @param int    $product_id 
 * @param string $type 
 * @param array  $compound_array 
 * 
 * @see    get_wpd_compounds_simple()
 * @since  2.5
 * @return string
 */
function wpd_compounds_simple( $product_id, $type = null, $compound_array = null ) {
    // Filters the displayed compound details.
    echo esc_html( apply_filters( 'wpd_compounds_simple', get_wpd_compounds_simple( $product_id, $type, $compound_array ) ) );
}

/**
 * Compounds details - Get Simple
 *
 * @param int    $product_id 
 * @param string $type 
 * @param array  $compound_array 
 * 
 * @since  2.5
 * @return string
 */
function get_wpd_compounds_simple( $product_id, $type = null, $compound_array = null ) {
    // Set compound type.
    if ( $type ) {
        $type = $type;
    } else {
        $type = null;
    }

    // Get post type.
    $product_type = get_post_meta( $product_id, 'product_type', true );

    if ( 'flowers' == $product_type || 'concentrates' == $product_type || 'prerolls' == $product_type || 'tinctures' == $product_type ) {
        $type = '%';
    }

    if ( 'edibles' == $product_type || 'topicals' == $product_type ) {
        $type = 'mg';
    }

    // Set compounds.
    $compounds = array();

    // THC.
    if ( null != $compound_array && in_array( 'thc', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_thc', true ) ) {
            if ( get_post_meta( $product_id, 'compounds_thc', true ) && get_post_meta( $product_id, 'product_servings', true ) ) {
                $compounds['THC'] = get_post_meta( $product_id, 'compounds_thc', true ) * get_post_meta( $product_id, 'product_servings', true ) . $type;
            } else {
                $compounds['THC'] = get_post_meta( $product_id, 'compounds_thc', true ) . $type;
            }
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }
    // THCA.
    if ( null != $compound_array && in_array( 'thca', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_thca', true ) ) {
            $compounds['THCA'] = get_post_meta( $product_id, 'compounds_thca', true ) . $type;
        }
    } else {
        // Do nothing.
    }
    // CBD.
    if ( null != $compound_array && in_array( 'cbd', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cbd', true ) ) {
            $compounds['CBD'] = get_post_meta( $product_id, 'compounds_cbd', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }
    // CBA.
    if ( null != $compound_array && in_array( 'cba', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cba', true ) ) {
            $compounds['CBA'] = get_post_meta( $product_id, 'compounds_cba', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }
    // CBN.
    if ( null != $compound_array && in_array( 'cbn', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cbn', true ) ) {
            $compounds['CBN'] = get_post_meta( $product_id, 'compounds_cbn', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }
    // CBG.
    if ( null != $compound_array && in_array( 'cbg', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cbg', true ) ) {
            $compounds['CBG'] = get_post_meta( $product_id, 'compounds_cbg', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }
    // Create empty variable.
    $str = '';

    // Add each compound to variable.
    foreach ( $compounds as $compound=>$value ) {
        $str .= '<span class="wpd-productinfo ' . $compound . '"><strong>' . $compound . ':</strong> ' . $value . '</span>';
    }

    return $str;
}

/**
 * Compounds details - Array
 *
 * @param int    $product_id 
 * @param string $type 
 * @param array  $compound_array 
 * 
 * @see    get_wpd_compounds_array()
 * @since  2.5
 * @return string
 */
function wpd_compounds_array( $product_id, $type = null, $compound_array = null ) {
    // Filters the displayed compounds.
    echo esc_html( apply_filters( 'wpd_compounds_array', get_wpd_compounds_array( $product_id, $type, $compound_array ) ) );
}


/**
 * Compounds details - Get Array
 *
 * @param int    $product_id 
 * @param string $type 
 * @param array  $compound_array 
 * 
 * @since  2.5
 * @return string
 */
function get_wpd_compounds_array( $product_id, $type = null, $compound_array = null ) {
    // Set compound type.
    if ( $type ) {
        $type = $type;
    } else {
        $type = null;
    }

    // Get post type.
    $product_type = get_post_meta( $product_id, 'product_type', true );

    if ( 'flowers' == $product_type || 'concentrates' == $product_type || 'prerolls' == $product_type || 'tinctures' == $product_type ) {
        $type = '%';
    }

    if ( 'edibles' == $product_type || 'topicals' == $product_type ) {
        $type = 'mg';
    }

    // Set compounds.
    $compounds = array();

    // THC.
    if ( in_array( 'thc', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_thc', true ) ) {
            $compounds['THC'] = get_post_meta( $product_id, 'compounds_thc', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }

    // THCA.
    if ( in_array( 'thca', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_thca', true ) ) {
            $compounds['THCA'] = get_post_meta( $product_id, 'compounds_thca', true ) . $type;
        }
    } else {
        // Do nothing.
    }

    // CBD.
    if ( in_array( 'cbd', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cbd', true ) ) {
            $compounds['CBD'] = get_post_meta( $product_id, 'compounds_cbd', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }

    // CBA.
    if ( in_array( 'cba', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cba', true ) ) {
            $compounds['CBA'] = get_post_meta( $product_id, 'compounds_cba', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }

    // CBN.
    if ( in_array( 'cbn', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cbn', true ) ) {
            $compounds['CBN'] = get_post_meta( $product_id, 'compounds_cbn', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }

    // CBG.
    if ( in_array( 'cbg', $compound_array ) ) {
        if ( get_post_meta( $product_id, 'compounds_cbg', true ) ) {
            $compounds['CBG'] = get_post_meta( $product_id, 'compounds_cbg', true ) . $type;
        } else {
            // Do nothing.
        }
    } else {
        // Do nothing.
    }

    return $compounds;
}

/**
 * Get all flower weights.
 *
 * @since  2.5.2
 * @return array
 */
function wpd_flowers_weights_array() {
    $flowers_weights = array(
        '1 g'    => 'price_gram',
        '2 g'    => 'price_two_grams',
        '1/8 oz' => 'price_eighth',
        '5 g'    => 'price_five_grams',
        '1/4 oz' => 'price_quarter_ounce',
        '1/2 oz' => 'price_half_ounce',
        '1 oz'   => 'price_ounce',
    );
    return apply_filters( 'wpd_flowers_weights_array', $flowers_weights );
}

/**
 * Get all concentrate weights.
 *
 * @since  2.5.2
 * @return array
 */
function wpd_concentrates_weights_array() {
    $concentrates_weights = array(
        '1/2 g' => 'price_half_gram',
        '1 g'   => 'price_gram',
        '2 g'   => 'price_two_grams',
    );
    return apply_filters( 'wpd_concentrates_weights_array', $concentrates_weights );
}

/**
 * Compounds list
 * 
 * @since  4.0
 * @return array
 */
function wpd_compound_list() {
    $compounds = array(
        'compounds_thc', 
        'compounds_thca', 
        'compounds_cbd', 
        'compounds_cba', 
        'compounds_cbn', 
        'compounds_cbg'
    );
    return apply_filters( 'wpd_compound_list', $compounds );
}

/**
 * Product Schema
 * 
 * @param int $product_id 
 * 
 * @todo create filter for availability so it can be set to in stock or out of stock by the eCommerce add-on
 * 
 * @since  4.0
 * @return string
 */
function wpd_product_schema( $product_id ) {
    
    $wpd_settings = get_option( 'wpdas_general' );
    $vendors      = wp_get_object_terms( $product_id, 'vendors' );

    if ( ! isset ( $wpd_settings['wpd_pricing_currency_code'] ) ) {
        $wpd_currency = 'USD';
    } else {
        $wpd_currency = $wpd_settings['wpd_pricing_currency_code'];
    }
    ?>
    <!-- BEGIN Schema.org Product Rich Snippet Markup -->
    <div itemscope="" itemtype="http://schema.org/Product">
        <meta itemprop="category" content="<?php get_the_term_list( $product_id, 'wpd_categories', '', '' ); ?>">
        <meta itemprop="name" content="<?php echo get_the_title( $product_id ); ?>">
        <meta itemprop="image" content="<?php echo get_the_post_thumbnail_url( $product_id, 'full' ); ?>">

        <?php if ( get_wpd_product_price_high( $product_id ) == get_wpd_product_price_low( $product_id ) ) { ?>
        <!-- offers -->
        <div id="dvProductPricing" class="ProductDetailsPricing" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
            <meta itemprop="seller" content="<?php echo get_bloginfo( 'name' ); ?>">
            <meta itemprop="url" content="<?php the_permalink( $product_id ); ?>">
            <meta itemprop="itemCondition" itemtype="http://schema.org/OfferItemCondition" content="http://schema.org/NewCondition">
            <link itemprop="availability" href="http://schema.org/InStock">
            <meta itemprop="priceCurrency" content="<?php echo $wpd_currency; ?>">
            <meta itemprop="price" content="<?php echo get_wpd_product_price_high( $product_id ); ?>">
        </div>
        <?php } else { ?>
        <!-- offers -->
        <div id="dvProductPricing" class="ProductDetailsPricing" itemprop="offers" itemscope="" itemtype="http://schema.org/AggregateOffer">
            <meta itemprop="seller" content="<?php echo get_bloginfo( 'name' ); ?>">
            <meta itemprop="url" content="<?php the_permalink( $product_id ); ?>">
            <meta itemprop="itemCondition" itemtype="http://schema.org/OfferItemCondition" content="http://schema.org/NewCondition">
            <link itemprop="availability" href="http://schema.org/InStock">
            <meta itemprop="priceCurrency" content="<?php echo $wpd_currency; ?>">
            <meta itemprop="lowPrice" content="<?php echo get_wpd_product_price_low( $product_id ); ?>">
            <meta itemprop="highPrice" content="<?php echo get_wpd_product_price_high( $product_id ); ?>">
            <?php if ( get_post_meta( $product_id, 'inventory_grams', true ) ) { ?>
                <meta itemprop="offerCount" content="<?php echo get_post_meta( $product_id, 'inventory_grams', true ); ?>">
            <?php } else { ?>
            <?php } ?>
            <?php if ( get_post_meta( $product_id, 'inventory_units', true ) ) { ?>
                <meta itemprop="offerCount" content="<?php echo get_post_meta( $product_id, 'inventory_units', true ); ?>">
            <?php } else { ?>
            <?php } ?>
            <?php if ( ! get_post_meta( $product_id, 'inventory_units', true ) && ! get_post_meta( $product_id, 'inventory_grams', true ) ) { ?>
                <meta itemprop="offerCount" content="">
            <?php } ?>
        </div>
        <?php } ?>

        <?php
        // Get product rating details.
        $ratings_details = wpd_product_ratings_details( $product_id );

        // Check if there's a product rating saved.
        if ( $ratings_details['ratings_average'] && ! is_nan( $ratings_details['ratings_average'] ) ) { ?>
        <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
            <meta itemprop="ratingValue" content="<?php echo $ratings_details['ratings_average']; ?>">
            <meta itemprop="ratingCount" content="<?php echo $ratings_details['ratings_count']; ?>">
        </div>
        <?php } ?>

        <?php if ( get_post_meta( $product_id, 'product_sku', true ) ) { ?>
        <meta itemprop="sku" content="<?php esc_attr_e( get_post_meta( $product_id, 'product_sku', true ) ); ?>" />
        <?php } ?>

        <?php 
        if ( has_excerpt( $product_id ) ) { ?>
            <meta itemprop="description" content="<?php echo get_the_excerpt( $product_id ); ?>" />
        <?php } else { ?>
            <meta itemprop="description" content="" />
        <?php } ?>

        <?php if ( $vendors ) { ?>
        <div itemprop="brand" itemtype="https://schema.org/Brand" itemscope>
            <meta itemprop="name" content="<?php echo $vendors[0]->name; ?> " />
        </div>
        <?php } ?>

    </div>
    <!-- END Schema.org Product Structured Data Markup -->
<?php }

/**
 * Get ratings details by product ID
 * 
 * @param int $product_id 
 * 
 * @return int
 */
function wpd_product_ratings_details( $product_id = null ) {
    // Bail early?
    if ( ! $product_id ) {
        return;
    }

    // Rating array.
    $ratings_array = array();

    // Get comments.
    $comments = get_comments(
        array(
            'post_id' => $product_id,
        )
    );

    // Loop through comments
    foreach ( $comments as $comment ) {
        // Get Rating.
        $rating = get_comment_meta( $comment->comment_ID, 'product_rating', true );
        // Add rating to array.
        if ( $rating ) {
            $ratings_array[] = $rating;
        }
    }

    // Set ratings details.
    $ratings_count   = count( $ratings_array );
    $ratings_total   = array_sum( $ratings_array );
    $ratings_average = '';

    // Only run this if the count and total are both integers and greater than zero.
    if ( is_int( $ratings_count ) && is_int( $ratings_total ) && $ratings_count > 0 && $ratings_total > 0 ) {
        $ratings_average = $ratings_total/$ratings_count;
    }

    // Set the product ratings array.
    $product_ratings = array(
        'ratings_count'   => $ratings_count,
        'ratings_total'   => $ratings_total,
        'ratings_average' => $ratings_average,
    );

    // Filter the product ratings array.
    $product_ratings = apply_filters( 'wpd_product_ratings_details', $product_ratings, $product_id );

    return $product_ratings;
}

/**
 * Get ratings stars by product ID
 * 
 * @param int $product_id 
 * 
 * @since  4.2.0
 * @return string|void
 */
function get_wpd_product_ratings_stars( $product_id = null ) {
    // Bail early?
    if ( ! $product_id ) {
        return;
    }

    // Get ratings details.
    $ratings_details = wpd_product_ratings_details( $product_id );

    // Check if there's a product rating saved.
    if ( $ratings_details['ratings_average'] && ! is_nan( $ratings_details['ratings_average'] ) ) {
        $str = '';
        // Loop through 5 times.
        for ( $i = 1; $i <= 5; $i++ ) {
            if ( $ratings_details['ratings_average'] < $i ) {
                if ( is_float( $ratings_details['ratings_average'] ) && ( round( $ratings_details['ratings_average'] ) == $i ) ) {
                    $str .= '<i class="fas fa-star-half-alt"></i> ';
                } else {
                    $str .= '<i class="far fa-star"></i> ';
                }
            } else {
                $str .= '<i class="fas fa-star"></i> ';
            }
        }

        // Get the ratings stars HTML.
        $ratings_stars = '<p class="comment-rating">' . $str . '</p>';
        // Filter the ratings stars HTML.
        $ratings_stars = apply_filters( 'wpd_product_ratings_stars', $ratings_stars );

        return $ratings_stars;
    }

    return;
}

/**
 * Single product - Strain types
 * 
 * This function returns a set of ahref links for each strain type
 * that is associated with the given product ID.
 * 
 * @param int $product_id - The product ID
 * 
 * @return string|void
 */
function wpd_product_strain_types( $product_id = null ) {
    // Bail early?
    if ( ! $product_id || ! is_int( $product_id ) ) {
        return;
    }

    // Strain types.
    $strain_types      = get_the_terms( $product_id, 'strain_types' );
    $strain_type_links = '';
    if ( ! empty( $strain_types ) ) {
        foreach ( $strain_types as $term ) {
            $term_id   = $term->term_id;
            $color     = get_term_meta( $term_id, 'strain_type_color', true );
            if ( ! $color ) {
                $color = '#454545';
            }
            $term_name = $term->name;
            $term_link = get_term_link( $term );
    
            // Output the link with background color and term name
            $strain_type_links .= '<a href="' . esc_url( $term_link ) . '" style="background-color: ' . $color . ';color:#FFF;">' . esc_html( $term_name ) . '</a>';
        }
    }

    return apply_filters( 'wpd_product_strain_types', $strain_type_links );
}