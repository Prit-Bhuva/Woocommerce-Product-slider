<?php

/**
 * Plugin Name: Custom Product Slider
 * Author: Prit Bhuva
 * Version: 1.0.0
 * Description:This is a custom plugin for woocommerce product to convert product gallery images into slider.
 */

defined('ABSPATH') || die("Invalid Request");

//define plugin path/url/file
define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_FILE', __FILE__);

//include path
include PLUGIN_PATH . "inc/product_image.php";

if (!class_exists('display_slider')) :

    class display_slider
    {

        public function __construct()
        {
            add_action('wp_enqueue_scripts', array(__CLASS__, 'add_enqueue_scripts'));
        }

        //function for enqueue script and style
        public static function add_enqueue_scripts()
        {
            wp_enqueue_style('display-slidercss', PLUGIN_URL . "assets/css/slider.css");
            wp_enqueue_style('bootstrap-cdn', "https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css");
            wp_enqueue_style('slick-theme-cdn', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css");
            wp_enqueue_style('slick-cdn', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css");
            wp_enqueue_script('jquery-cdn', "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js");
            wp_enqueue_script('slider-cdn', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js");
            wp_enqueue_script('display-sliderjs', PLUGIN_URL . "assets/js/slider.js", array(), '1.0.0', false);
        }
    }
endif;
new display_slider;
