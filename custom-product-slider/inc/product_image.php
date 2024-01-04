<?php

function display_data($data)
{
    echo "<pre>";
    print_r($data);
    exit;
}

/**
 * add product gallary slider
 */
function product_gellery_fuction()
{
    if (is_product()) {

        global $product;
        $attachment_ids = $product->get_gallery_image_ids();

        if (count($attachment_ids) > 3) { ?>
            <div class="wrapper">
                <div class="carousel">
                    <?php foreach ($attachment_ids as $attachment_id) { ?>
                        <div class="card">
                            <div class="card-header product-image">
                                <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="card card-summary">
                <div class="card-body product-summary">
                    <?php
                    /**
                     * Hook: woocommerce_single_product_summary.
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     * @hooked WC_Structured_Data::generate_product_data() - 60
                     */
                    do_action('woocommerce_single_product_summary');
                    ?>

                </div>
            </div>

<?php

        /* 
            // remove title
             remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
            // remove rating stars
             remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
            // remove product meta 
             remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
            // remove description
             remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
            // remove price
             remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10); 
        */

            // remove cart btn
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

            // Remove single product images 
            remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

        /*
            // Remove single product quantity 
             function custom_remove_quantity_fields($return, $product)
            {
                return true;
            }
            add_filter('woocommerce_is_sold_individually', 'custom_remove_quantity_fields', 10, 2);

            // Remove SKU 
            add_filter('wc_product_sku_enabled', '__return_false');

            // Remove add to cart button 
            add_filter('woocommerce_is_purchasable', '__return_false');

            // Remove breadcrumb 
            add_filter('woocommerce_get_breadcrumb', '__return_false');

            // Remove short description 
            add_filter('woocommerce_short_description', '__return_false');

            // Remove price 
            // add_filter('woocommerce_get_price_html', '__return_false');

            // Remove title 
            add_filter('the_title', '__return_false');

            // Remove tags 
            // add_filter('get_the_terms', '__return_false');

            // Remove option label 
            add_filter('woocommerce_attribute_label', '__return_false');

            // Remove choose optio 
            add_filter('woocommerce_dropdown_variation_attribute_options_html', '__return_false');

            // Remove single variation add to cart btn 
            add_action('woocommerce_single_product_summary', 'hide_add_to_cart_button_variable_product', 1, 0);
            function hide_add_to_cart_button_variable_product()
            {
                // Removing add to cart button and quantities only
                remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
            }


            add_filter('woocommerce_variable_price_html', 'remove_variation_title', 10, 2);
            function remove_variation_title()
            {
                global $woocommerce_loop;
                if (is_product() && $woocommerce_loop['name'] == 'related') {
                    add_filter('the_title', '__return_true');
                }
            }

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        */
        
        }
    }
}

// Add slider on single product page 
add_action('woocommerce_before_single_product_summary', 'product_gellery_fuction');

