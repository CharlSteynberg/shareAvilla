<?php
if ( class_exists( 'WooCommerce' ) ) {
    /*================================================
    FILTER HOOK
    ================================================== */
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
    add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',2);


    /*================================================
    RESET LOOP
    ================================================== */
    if (!function_exists('g5plus_woocommerce_reset_loop')) {
        function g5plus_woocommerce_reset_loop() {
            global $g5plus_woocommerce_loop;
            $g5plus_woocommerce_loop['layout'] = '';
            $g5plus_woocommerce_loop['single_columns'] = '';
	        $g5plus_woocommerce_loop['style'] = 'classic-1';
            $g5plus_woocommerce_loop['columns'] = '';
	        $g5plus_woocommerce_loop['rating'] = '';
        }
    }

    /*================================================
    LOOP CATEGORY TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocommerce_template_loop_category')) {
        function g5plus_woocommerce_template_loop_category() {
            wc_get_template( 'loop/category.php' );
        }
        //add_action('woocommerce_after_shop_loop_item_title','g5plus_woocommerce_template_loop_category',1);
    }

    /*================================================
    LOOP NAME TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocommerce_template_loop_name')) {
        function g5plus_woocommerce_template_loop_name() {
            wc_get_template( 'loop/name.php' );
        }
        add_action('woocommerce_after_shop_loop_item_title','g5plus_woocommerce_template_loop_name',1);
    }

    /*================================================
    LOOP LINK TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_link')) {
        function g5plus_woocomerce_template_loop_link() {
            wc_get_template( 'loop/link.php' );
        }
        add_action('woocommerce_before_shop_loop_item_title','g5plus_woocomerce_template_loop_link',20);
    }

	/*================================================
    QUICK VIEW TEMPLATE
    ================================================== */
	if (!function_exists('g5plus_woocomerce_template_loop_quick_view')) {
		function g5plus_woocomerce_template_loop_quick_view() {
			wc_get_template( 'loop/quick-view.php' );
		}
		add_action('g5plus_woocommerce_product_actions','g5plus_woocomerce_template_loop_quick_view',15);
	}

	add_action('g5plus_woocommerce_product_actions','woocommerce_template_loop_add_to_cart',20);





    /*================================================
    FILTER PRODUCTS PER PAGE
    ================================================== */
    if (!function_exists('g5plus_show_products_per_page')) {
        function g5plus_show_products_per_page() {
            $product_per_page = g5plus_get_option('product_per_page',12);
            if (empty($product_per_page)) {
                $product_per_page = 12;
            }
            $page_size = isset($_GET['page_size']) ? wc_clean($_GET['page_size']) : $product_per_page;
            return $page_size;
        }
        add_filter('loop_shop_per_page', 'g5plus_show_products_per_page');
    }


    /*================================================
    OVERWRITE LOOP PRODUCT THUMBNAIL
    ================================================== */
    if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
        /**
         * Get the product thumbnail for the loop.
         *
         * @access public
         * @subpackage    Loop
         * @return void
         */
        function woocommerce_template_loop_product_thumbnail() {
            global $product,$g5plus_woocommerce_loop;
            $attachment_ids  = $product->get_gallery_image_ids();
            $secondary_image = '';
            $class           = 'product-thumb-one';
	        $archive_product_style = isset($g5plus_woocommerce_loop['style']) ?  $g5plus_woocommerce_loop['style'] : 'classic-1';

	        $secondary_image_id = '';
	        if ( $archive_product_style == 'creative' || $archive_product_style == 'creative-2' ) {
		        $prefix = 'g5plus_';
		        $secondary_image_id = g5plus_get_post_meta(get_the_ID(),$prefix.'product_secondary_image',true);
	        } else if ($attachment_ids) {
		        $secondary_image_id = $attachment_ids['0'];
	        }

	        if (!empty($secondary_image_id)) {
		        $secondary_image    = wp_get_attachment_image( $secondary_image_id, apply_filters( 'shop_catalog', 'shop_catalog' ) );
		        if ( ! empty( $secondary_image ) ) {
			        $class = 'product-thumb-primary';
		        }
	        }
            ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="<?php echo esc_attr( $class ); ?>">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                </div>
                <?php if ( ! empty( $secondary_image ) ) : ?>
                    <div class="product-thumb-secondary">
                        <?php echo wp_kses_post( $secondary_image ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php
        }
    }

    /*================================================
    SINGLE PRODUCT
    ================================================== */
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
    add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',15);

    if (!function_exists('g5plus_product_description_heading')) {
        function g5plus_product_description_heading() {
            return '';
        }
    }
    add_filter('woocommerce_product_description_heading','g5plus_product_description_heading');
    add_filter('woocommerce_product_additional_information_heading','g5plus_product_description_heading');


    if (!function_exists('g5plus_related_products_args')) {
        function g5plus_related_products_args() {
	        $args['posts_per_page'] = g5plus_get_option('related_product_count',6);
	        return $args;
        }
        add_filter('woocommerce_output_related_products_args', 'g5plus_related_products_args');
    }

	if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_category')) {
		function g5plus_woocommerce_product_related_posts_relate_by_category() {
			$related_product_condition = g5plus_get_option('related_product_condition',array(
				'category'      => '1',
				'tag'      => '1',
			));
			return isset($related_product_condition['category']) && ($related_product_condition['category'] == 1)  ? true : false;
		}
		add_filter('woocommerce_product_related_posts_relate_by_category','g5plus_woocommerce_product_related_posts_relate_by_category');
	}

	if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_tag')) {
		function g5plus_woocommerce_product_related_posts_relate_by_tag() {
			$related_product_condition = g5plus_get_option('related_product_condition',array(
				'category'      => '1',
				'tag'      => '1',
			));
			return isset($related_product_condition['tag']) && ($related_product_condition['tag'] == 1)  ? true : false;
		}
		add_filter('woocommerce_product_related_posts_relate_by_tag','g5plus_woocommerce_product_related_posts_relate_by_tag');
	}


    /*================================================
    SHOPPING CART
    ================================================== */
    remove_action('woocommerce_cart_collaterals','woocommerce_cross_sell_display');
    add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display',15 );
    add_action('woocommerce_before_cart_totals','woocommerce_shipping_calculator',5);

    if (!function_exists('g5plus_button_continue_shopping')) {
        function g5plus_button_continue_shopping () {
            $continue_shopping =  get_permalink( wc_get_page_id( 'shop' ) );
            ?>
            <a href="<?php echo esc_url($continue_shopping); ?>" class="continue-shopping button"><?php _e( 'Continue shopping', 'wolverine' ); ?></a>
            <?php
        }
    }

    /*================================================
	SALE FLASH MODE
	================================================== */
    if (!function_exists('g5plus_woocommerce_sale_flash')) {
        function g5plus_woocommerce_sale_flash($sale_flash,$post,$product) {
            $product_sale_flash_mode = g5plus_get_option('product_sale_flash_mode','percent');
            if ($product_sale_flash_mode == 'percent') {
                $sale_percent = 0;
                if ($product->is_on_sale() && $product->get_type() != 'grouped') {
                    if ($product->get_type() == 'variable') {
                        $available_variations =  $product->get_available_variations();
                        for ($i = 0; $i < count($available_variations); ++$i) {
                            $variation_id = $available_variations[$i]['variation_id'];
                            $variable_product1 = new WC_Product_Variation( $variation_id );
                            $regular_price = $variable_product1->get_regular_price();
                            $sales_price = $variable_product1->get_sale_price();
                            $price = $variable_product1->get_price();
                            if ( $sales_price != $regular_price && $sales_price == $price ) {
                                $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
                                if ($percentage > $sale_percent) {
                                    $sale_percent = $percentage;
                                }
                            }
                        }
                    } else {
                        $sale_percent = round((( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100),1) ;
                    }
                }
                if ($sale_percent > 0) {
                    return '<span class="on-sale">' . $sale_percent . '%</span>';
                } else {
                    return "";
                }

            }
            return $sale_flash;
        }
        add_filter('woocommerce_sale_flash','g5plus_woocommerce_sale_flash',10,3);
    }

	/*================================================
	QUICK VIEW
	================================================== */
	add_action('g5plus_before_quick_view_product_summary','woocommerce_show_product_sale_flash',10);

	if (!function_exists('g5plus_quick_view_product_images')) {
		function g5plus_quick_view_product_images() {
			wc_get_template('quick-view/product-image.php');
		}
		add_action('g5plus_before_quick_view_product_summary','g5plus_quick_view_product_images',20);
	}

    if (!function_exists('g5plus_template_quick_view_product_title')) {
        function g5plus_template_quick_view_product_title() {
            wc_get_template( 'quick-view/title.php' );
        }
        add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_title',5);
    }

    if (!function_exists('g5plus_template_quick_view_product_rating')) {
        function g5plus_template_quick_view_product_rating() {
            wc_get_template( 'quick-view/rating.php' );
        }
        add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_rating',15);
    }

    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_price',10);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_excerpt',20);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_add_to_cart',30);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_meta',40);
    add_action('g5plus_quick_view_product_summary','woocommerce_template_single_sharing',50);


    /*================================================
	CUSTOM WOOCOMERCE CATALOG ORDERING
	================================================== */
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

    add_action( 'g5plus_before_shop_loop', 'woocommerce_result_count', 20 );
    add_action( 'g5plus_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


    /*================================================
	SHOP PAGE CONTENT
	================================================== */
    if (!function_exists('g5plus_shop_page_content')) {
        function g5plus_shop_page_content() {
            $show_page_shop_content = g5plus_get_option('show_page_shop_content','0');
            if ($show_page_shop_content == '0') return;
            $page_shop_id =  wc_get_page_id('shop');
            if ($page_shop_id == -1) return;
            $myClass = array('shop-page-content-wrapper');
            $myClass[] = 'shop-page-content-'.$show_page_shop_content;
            $query = new WP_Query('page_id='.$page_shop_id);
            if ($query->have_posts()) {
                ?>
                    <div class="<?php echo join(' ',$myClass) ?>">
                        <?php while ($query->have_posts()) : $query->the_post() ; ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div>
                <?php
            }
            wp_reset_postdata();
        }

        $show_page_shop_content = g5plus_get_option('show_page_shop_content','0');
        if ($show_page_shop_content == 'before') {
            add_action('g5plus_before_archive_product_listing','g5plus_shop_page_content',5);
        }

        if ($show_page_shop_content == 'after') {
            add_action('g5plus_after_archive_product_listing','g5plus_shop_page_content',5);
        }

    }


    if ( ! function_exists( 'woocommerce_single_variation_add_to_cart_button' ) ) {

        /**
         * Output the add to cart button for variations.
         */
        function woocommerce_single_variation_add_to_cart_button() {
            global $product;
            ?>
            <div class="variations_button">
                <div class="single_add_to_cart_button_wrap">
                    <?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
                    <button type="submit" class="single_add_to_cart_button button alt"><i class="wicon icon-svg-icon-16"></i> <?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
                </div>

                <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
                <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
                <input type="hidden" name="variation_id" class="variation_id" value="" />
            </div>
            <?php
        }
    }

    /*================================================
	CHANGE THE ADD TO CART TEXT ON SINGLE PRODUCT PAGES
	================================================== */
    if (!function_exists('g5plus_custom_cart_button_text')) {
        function g5plus_custom_cart_button_text() {
            return __( 'Add to cart', 'wolverine' );
        }
        //add_filter( 'woocommerce_product_single_add_to_cart_text', 'g5plus_custom_cart_button_text' );    // 2.1 +
    }

    /*================================================
	CHANGE THE ADD TO CART TEXT ON PRODUCT ARCHIVES
	================================================== */
    if (!function_exists('g5plus_woocommerce_product_add_to_cart_text')) {
        function g5plus_woocommerce_product_add_to_cart_text() {
            global $product;
            $product_type = $product->get_type();
            switch ( $product_type ) {
                case 'external':
                    return __( 'Buy product', 'wolverine' );
                    break;
                case 'grouped':
                    return __( 'View products', 'wolverine' );
                    break;
                case 'simple':
                    return __( 'Add to cart', 'wolverine' );
                    break;
                case 'variable':
                    return __( 'Select options', 'wolverine' );
                    break;
                default:
                    return __( 'Read more', 'wolverine' );
            }
        }
        add_filter( 'woocommerce_product_add_to_cart_text' , 'g5plus_woocommerce_product_add_to_cart_text' );
    }


	/*================================================
	THEME ACTION
	================================================== */
	if (!function_exists('g5plus_woocommerce_single_product_other_link')) {
		function g5plus_woocommerce_single_product_other_link() {
			wc_get_template( 'single-product/other-link.php' );
		}
		add_action('woocommerce_after_single_product_summary','g5plus_woocommerce_single_product_other_link',11);
	}

    /*================================================
    FIX 2.5.0
    ================================================== */

    if (defined('WOOCOMMERCE_VERSION') && version_compare(WOOCOMMERCE_VERSION,'2.5.0','<')) {
        if (!function_exists('woocommerce_template_loop_add_to_cart')) {
            function woocommerce_template_loop_add_to_cart( $args = array() ) {
                global $product;
                if ( $product ) {
                    $ajax_cart_en         = 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart' );
                    $defaults = array(
                        'quantity' => 1,
                        'class'    => implode( ' ', array_filter( array(
                            'button',
                            'product_type_' . $product->get_type(),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $ajax_cart_en ? 'ajax_add_to_cart' : ''
                        ) ) )
                    );

                    $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

                    wc_get_template( 'loop/add-to-cart.php', $args );
                }
            }
        }
    }




}
