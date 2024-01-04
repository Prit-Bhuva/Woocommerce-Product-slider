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
if (!function_exists('product_gellery_fuction')) {
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
                // Remove single product images
                remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

                // Remove single product summary
                add_action('astra_woo_single_product_structure', 'astra_custom_code', 10);
                function astra_custom_code()
                {
                    return;
                }

                // Remove single product breadcrumb
                add_filter('woocommerce_get_breadcrumb', '__return_false');
            }
        }
    }
}
/* Add slider on single product page */
add_action('woocommerce_before_single_product_summary', 'product_gellery_fuction');