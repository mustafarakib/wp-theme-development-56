<?php

// WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
    // Handle cart in header fragment for ajax add to cart
    add_filter('add_to_cart_fragments', 'header_add_to_cart_fragment');

    function stock_mr_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        stock_mr_woocommerce_cart_link();
        $fragments['a.stock-cart'] = ob_get_clean();
        return $fragments;
    }

    function stock_mr_woocommerce_cart_link() {
        global $woocommerce;
        ?>

        <a title="<?php echo sprintf(_n('%d item', '%d items',
            $woocommerce->cart->cart_contents_count, 'woothemes'),
            $woocommerce->cart->cart_contents_count);?> <?php _e('in your shopping cart', 'woothemes'); ?>"

           href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="stock-cart"><i class="fa fa-shopping-cart"></i>
            <span class="stock-cart-count">
                <?php echo sprintf(_n('%d', '%d',
                    $woocommerce->cart->cart_contents_count, 'woothemes'),
                    $woocommerce->cart->cart_contents_count); ?>
            </span>
        </a>
        <?php
    }
}

// Import Demo Data
function stock_mr_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'Demo Import 1', 'stock-mr' ),

            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-data/stock-mr-file.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-data/stock-mr-widget-file.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo-data/stock-mr-customizer-file.dat',

            'import_notice'                => esc_html__( 'After importing this demo, just set static homepage from settings > reading,
                                                            check widgets and menus. You will be done! :-)', 'stock-mr' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'stock_mr_import_files' );
