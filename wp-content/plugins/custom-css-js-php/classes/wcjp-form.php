<?php
if ( ! class_exists( 'WCJP_FORM' ) ) {

	class WCJP_FORM extends FlipperCode_HTML_Markup{


		function __construct($options = array()) {

                        $premium_features;
			
			$productInfo = array('productName' => __('Custom css-js-php',WCJP_TEXT_DOMAIN),
                        'productSlug' => 'custom-css-js-php',
                        'productTagLine' => 'Write custom code for php, html, javascript or css and insert in to your theme using shortcode, actions or filters.',
                        'productTextDomain' => WCJP_TEXT_DOMAIN,
                        'productIconImage' => WCJP_URL.'core/core-assets/images/wp-poet.png',
                        'videoURL' => 'https://www.youtube.com/channel/UCcghD6ZtR2oGAlzXtIIQ5NQ',
                        'productVersion' => WCJP_VERSION,
                        'docURL' => 'http://guide.flippercode.com/',
                        'demoURL' => 'https://www.flippercode.com/shop/',
                        'productImagePath' => WCJP_URL.'core/core-assets/product-images/',
                        'productSaleURL' => 'https://www.flippercode.com/',
                        'multisiteLicence' => 'https://www.flippercode.com/',
                        'premium_features' => $premium_features,
                        'excludeBlocks' => array('product-activation','newsletter')
			);
    
			$productInfo = array_merge($productInfo, $options);
			parent::__construct($productInfo);

		}

	}
	
}
