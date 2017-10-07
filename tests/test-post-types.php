<?php
/**
 * Class PostTypestEst
 *
 * @package Wp_Dispensary
 */

/**
 * Test cases for the creation of post-types.
 */
class PostTypesTest extends WP_UnitTestCase {

    /**
     * Check for concentrates
     */
    public function test_it_has_a_concentrates_post_type()
    {
        $this->assertTrue( post_type_exists( 'concentrates' ) );
    }

    /**
     * Check for edibles
     */
    public function test_it_has_an_edibles_post_type()
    {
        $this->assertTrue( post_type_exists( 'edibles' ) );
    }

    /**
     * Checks for flowers
     */
    public function test_it_has_a_flowers_post_type()
    {
        $this->assertTrue( post_type_exists( 'flowers' ) );
    }

    /**
     * Checks for growers
     */
    public function test_it_has_a_growers_post_type()
    {
        $this->assertTrue( post_type_exists( 'growers' ) );
    }

    /**
     * Checks for prerolls
     */
    public function test_it_has_a_prerolls_post_type()
    {
        $this->assertTrue( post_type_exists( 'prerolls' ) );
    }

    /**
     * Checks for topicals
     */
    public function test_it_has_a_topicals_post_type()
    {
        $this->assertTrue( post_type_exists( 'topicals' ) );
    }
}
