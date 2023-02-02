<?php
/**
 * WP Dispensary Widgets - Products
 *
 * This file is used to define the product widget of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/widgets
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */


/**
 * WP Dispensary Products Widget
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/widgets
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      3.0.0
 */
class WP_Dispensary_Products_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @access public
     * @since  1.0.0
     * @return void
     */
    public function __construct() {

        parent::__construct(
            'wp_dispensary_widget',
            esc_html__( 'Dispensary Products', 'wp-dispensary' ),
            array(
                'description' => esc_html__( 'Your WP Dispensary products', 'wp-dispensary' ),
                'classname'   => 'wp-dispensary-widget',
            )
        );

    }

    /**
     * Widget definition
     *
     * @param array $args     - Arguments to pass to the widget 
     * @param array $instance - A given widget instance 
     * 
     * @access public
     * @since  1.0.0
     * @see    WP_Widget::widget
     * @return void
     */
    public function widget( $args, $instance ) {

        global $post;

        if ( ! isset( $args['id'] ) ) {
            $args['id'] = 'wp_dispensary_widget';
        }

        $title = apply_filters( 'widget_title', $instance['title'], $instance, $args['id'] );

        echo $args['before_widget'];

        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $widget_style = $instance['widgetstyle'];

        do_action( 'wp_dispensary_before_widget' );

        if ( 'basic-list' == $instance['widgetstyle'] ) {
            echo '<ul class="wp-dispensary-list">';
        } else {
            if ( 'on' == $instance['carousel'] ) {
                echo '<div class="wpd-carousel-widget">';
            }
        }

        // Random order.
        $rand_order = '';

        // Set random order if selected by user.
        if ( 'on' == $instance['order'] ) {
            $rand_order = 'rand';
        }

        // Get the product type selected by user.
        $product_type = $instance['type'];

        // Set the product type selected by user.
        if ( 'all' == $product_type ) {
            $product_types = wpd_product_types_simple( true );

            /**
             * @todo update this to work in replace of the $meta_query relation below
             */
            $type_array = array(
                array(
                    'relation' => 'OR',
                )
            );

            foreach ( $product_types as $type ) {
                $type_array[] = array(
                    'key'   => 'product_type',
                    'value' => $type
                );
            }

            $meta_query = array(
                array(
                    'relation' => 'OR',
                    array(
                        'key'   => 'product_type',
                        'value' => 'flowers'
                    ),
                    array(
                        'key'   => 'product_type',
                        'value' => 'concentrates'
                    ),
                    array(
                        'key'   => 'product_type',
                        'value' => 'edibles'
                    ),
                    array(
                        'key'   => 'product_type',
                        'value' => 'prerolls'
                    ),
                    array(
                        'key'   => 'product_type',
                        'value' => 'topicals'
                    ),
                    array(
                        'key'   => 'product_type',
                        'value' => 'growers'
                    ),
                    array(
                        'key'   => 'product_type',
                        'value' => 'tinctures'
                    ),
                    array(
                        'key'   => 'product_type',
                        'value' => 'gear'
                    ),
                )
            );
        } else {
            $meta_query = array(
                array(
                    'key'     => 'product_type',
                    'value'   => $product_type,
                    'compare' => '=',
                )
            );
        }

        $wp_dispensary_widget = new WP_Query(
            array(
                'post_type'  => 'products',
                'showposts'  => $instance['limit'],
                'orderby'    => $rand_order,
                'meta_query' => $meta_query
            )
        );

        while ( $wp_dispensary_widget->have_posts() ) : $wp_dispensary_widget->the_post();

            $do_not_duplicate = $post->ID;

            if ( 'basic-list' == $instance['widgetstyle'] ) {

                echo '<li class="wp-dispensary-widget-product">';
                echo '<span class="wp-dispensary-widget-product-image">' . get_wpd_product_image( $post->ID, $instance['imagesize'] ) . '</span>';
                echo '<span class="wp-dispensary-widget-product-name">';
                if ( 'on' == $instance['itemname'] ) {
                    echo '<a href="' . get_permalink( $post->ID ) . '" class="wp-dispensary-widget-link">' . get_the_title( $post->ID ) . '</a>';
                }
                if ( 'on' == $instance['itemprice'] ) {
                    echo wpd_all_prices_simple( $post->ID, true );
                }
                echo '</span>';
                echo '</li>';

            } else {

                do_action( 'wp_dispensary_widget_product_before' );

                echo '<div class="wp-dispensary-widget-product ' . $widget_style . '">';

                do_action( 'wp_dispensary_widget_product_inside_top' );

                echo '<div class="wp-dispensary-widget-product-image">';
                wpd_product_image( $post->ID, $instance['imagesize'] );
                echo '</div>';

                echo '<div class="wp-dispensary-widget-product-content">';
                echo '<span class="wp-dispensary-widget-product-ratings">' . get_wpd_product_ratings_stars( $post->ID ) . '</span>';

                if ( 'on' == $instance['itemname'] ) {
                    echo '<span class="wp-dispensary-widget-title"><a href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a></span>';
                }

                if ( 'on' == $instance['itemprice'] ) {
                    echo wpd_all_prices_simple( $post->ID, true );
                }

                do_action( 'wp_dispensary_widget_product_inside_bottom' );

                echo '</div>';
                echo '</div>';

                do_action( 'wp_dispensary_widget_product_after' );

            }

        endwhile; // end loop

        if ( 'basic-list' == $instance['widgetstyle'] ) {
            echo '</ul>';
        } else {
            if ( 'on' == $instance['carousel'] ) {
                echo '</div>';
            }
        }

        do_action( 'wp_dispensary_after_widget' );

        echo $args['after_widget'];
    }


    /**
     * Update widget options
     *
     * @param array $new_instance - The updated options 
     * @param array $old_instance - The old options 
     * 
     * @access public
     * @since  1.0.0
     * @see    WP_Widget::update
     * @return array $instance - The updated instance options
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['type']        = strip_tags( $new_instance['type'] );
        $instance['title']       = strip_tags( $new_instance['title'] );
        $instance['limit']       = strip_tags( $new_instance['limit'] );
        $instance['order']       = $new_instance['order'];
        $instance['itemname']    = $new_instance['itemname'];
        $instance['itemprice']   = $new_instance['itemprice'];
        $instance['carousel']    = $new_instance['carousel'];
        $instance['imagesize']   = $new_instance['imagesize'];
        $instance['widgetstyle'] = $new_instance['widgetstyle'];

        return $instance;
    }


    /**
     * Display widget form on dashboard
     *
     * @param array $instance A given widget instance 
     * 
     * @access public
     * @since  1.0.0
     * @see    WP_Widget::form
     * @return void
     */
    public function form( $instance ) {
        $defaults = array(
            'title'       => esc_html__( 'Products', 'wp-dispensary' ),
            'limit'       => '5',
            'type'        => '',
            'order'       => '',
            'itemname'    => 'on',
            'itemprice'   => 'on',
            'carousel'    => '',
            'imagesize'   => 'wpd-thumbnail',
            'widgetstyle' => 'basic-list'
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php esc_attr_e( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'wp-dispensary' ); ?></label>
            <input class="widefat" id="<?php esc_attr_e( $this->get_field_id( 'title' ) ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php esc_attr_e( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Menu item type:', 'wp-dispensary' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat" style="width:100%;">
                <option <?php if ( 'all' == $instance['type'] ) esc_attr_e( 'selected="selected"' ); ?> value="all"><?php esc_html_e( 'All types', 'wp-dispensary' ); ?></option>
                <?php
                foreach ( wpd_product_types() as $value ) { ?>
                <option <?php if ( wpd_product_type_display_name_to_slug( $value ) == $instance['type'] ) esc_attr_e( 'selected="selected"' ); ?> value="<?php echo wpd_product_type_display_name_to_slug( $value ); ?>"><?php echo $value; ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php esc_attr_e( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Amount of items to show:', 'wp-dispensary' ); ?></label>
            <input class="widefat" id="<?php esc_attr_e( $this->get_field_id( 'limit' ) ); ?>" type="number" name="<?php esc_attr_e( $this->get_field_name( 'limit' ) ); ?>" min="1" max="999" value="<?php esc_attr_e( $instance['limit'] ); ?>" />
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['order'], 'on' ); ?> id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'order' ) ); ?>" />
            <label for="<?php esc_attr_e( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Randomize output?', 'wp-dispensary' ); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['itemname'], 'on' ); ?> id="<?php echo $this->get_field_id( 'itemname' ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'itemname' ) ); ?>" />
            <label for="<?php esc_attr_e( $this->get_field_id( 'itemname' ) ); ?>"><?php esc_html_e( 'Display item name?', 'wp-dispensary' ); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['itemprice'], 'on' ); ?> id="<?php echo $this->get_field_id( 'itemprice' ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'itemprice' ) ); ?>" />
            <label for="<?php esc_attr_e( $this->get_field_id( 'itemprice' ) ); ?>"><?php esc_html_e( 'Display item price?', 'wp-dispensary' ); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['carousel'], 'on' ); ?> id="<?php echo $this->get_field_id( 'carousel' ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'carousel' ) ); ?>" />
            <label for="<?php esc_attr_e( $this->get_field_id( 'carousel' ) ); ?>"><?php esc_html_e( 'Display products in carousel?', 'wp-dispensary' ); ?></label>
        </p>

        <p>
            <label for="<?php esc_attr_e( $this->get_field_id( 'widgetstyle' ) ); ?>"><?php esc_html_e( 'Widget style:', 'wp-dispensary' ); ?></label>
            <?php
            // Set widget styles.
            $widget_styles = apply_filters( 'wpd_widgets_widget_styles', array( 'basic-list' => 'Basic list', 'basic-block' => esc_html__( 'Basic block', 'wp-dispensary' ), 'advanced-block' => esc_html__( 'Advanced block', 'wp-dispensary' ) ) );
            if ( $widget_styles ) {
                printf( '<select name="%s" id="' . esc_html( $this->get_field_id( 'widgetstyle' ) ) . '" name="' . esc_html( $this->get_field_name( 'widgetstyle' ) ) . '" class="widefat">', esc_attr( $this->get_field_name( 'widgetstyle' ) ) );
                // Loop through each widget style.
                foreach ( $widget_styles as $key=>$value ) {
                    if ( esc_html( $key ) != $instance['widgetstyle'] ) {
                        $image_selected = '';
                    } else {
                        $image_selected = 'selected="selected"';
                    }
                    printf( '<option value="%s" ' . esc_html( $image_selected ) . '>%s</option>', esc_html( $key ), esc_html( $value ) );
                }
                print( '</select>' );
            }
          ?>
        </p>

        <p>
            <label for="<?php esc_attr_e( $this->get_field_id( 'imagesize' ) ); ?>"><?php esc_html_e( 'Image size:', 'wp-dispensary' ); ?></label>
            <?php
            // Set featured image sizes.
            $image_sizes = apply_filters( 'wpd_widgets_featured_image_sizes', wpd_featured_image_sizes() );
            if ( $image_sizes ) {
                printf( '<select name="%s" id="' . esc_html( $this->get_field_id( 'imagesize' ) ) . '" name="' . esc_html( $this->get_field_name( 'imagesize' ) ) . '" class="widefat">', esc_attr( $this->get_field_name( 'imagesize' ) ) );
                // Loop through each image size.
                foreach ( $image_sizes as $image ) {
                    if ( esc_html( $image ) != $instance['imagesize'] ) {
                        $image_selected = '';
                    } else {
                        $image_selected = 'selected="selected"';
                    }
                    printf( '<option value="%s" ' . esc_html( $image_selected ) . '>%s</option>', esc_html( $image ), esc_html( $image ) );
                }
                print( '</select>' );
            }
          ?>
        </p>
        <?php
    }
}

/**
 * Register the new widget
 *
 * @since  1.0.0
 * @return void
 */
function wp_dispensary_products_widget_register() {
    register_widget( 'WP_Dispensary_Products_Widget' );
}
add_action( 'widgets_init', 'wp_dispensary_products_widget_register' );

