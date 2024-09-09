<?php
/**
 * WP Dispensary Widgets - Product Search
 *
 * This file is used to define the product search widget of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/widgets
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 */


/**
 * WP Dispensary Product Search Widget
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/widgets
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 */
class WP_Dispensary_Product_Search_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @access public
     * @since  4.0.0
     * @return void
     */
    public function __construct() {

        parent::__construct(
            'wp_dispensary_product_search_widget',
            esc_html__( 'Product Search', 'wp-dispensary' ),
            array(
                'description' => esc_html__( 'Add a search box', 'wp-dispensary' ),
                'classname'   => 'wp-dispensary-widget',
            )
        );

    }

    /**
     * Widget definition
     *
     * @param array $args     - Arguments to pass to the widget. 
     * @param array $instance - A given widget instance. 
     * 
     * @access public
     * @since  4.0.0
     * @see    WP_Widget::widget
     * @return void
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['id'] ) ) {
            $args['id'] = 'wp_dispensary_product_search_widget';
        }

        echo $args['before_widget'];

        do_action( 'wpd_product_search_widget_before' );

        echo '<div class="wp-dispensary-product-search">' . 
    
            do_action( 'wpd_product_search_widget_before_form' ) . 

                '<form role="search" action="' . site_url( '/' ) . '" method="get" id="searchform">
                    <input type="text" name="s" placeholder="' . esc_html__( 'Search Products', 'wp-dispensary' ) . '" />
                    <input type="hidden" name="post_type" value="products" />
                    <input type="submit" alt="Search" value="' . esc_html__( 'Search', 'wp-dispensary' ) . '" />
                </form>' . 

            do_action( 'wpd_product_search_widget_after_form' ) . 

        '</div>';

        do_action( 'wpd_product_search_widget_after' );

        echo $args['after_widget'];
    }


    /**
     * Update widget options
     *
     * @param array $new_instance - The updated options. 
     * @param array $old_instance - The old options. 
     * 
     * @access public
     * @since  4.0.0
     * @see    WP_Widget::update
     * @return array $instance The updated instance options
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        return $instance;
    }


    /**
     * Display widget form on dashboard
     *
     * @param array $instance - A given widget instance.
     * 
     * @access public
     * @since  4.0.0
     * @see    WP_Widget::form
     * @return void
     */
    public function form( $instance ) {
        // Do nothing.
    }
}

/**
 * Register the new widget
 *
 * @since  4.0.0
 * @return void
 */
function wp_dispensary_product_search_register_widget() {
    register_widget( 'WP_Dispensary_Product_Search_Widget' );
}
add_action( 'widgets_init', 'wp_dispensary_product_search_register_widget' );
