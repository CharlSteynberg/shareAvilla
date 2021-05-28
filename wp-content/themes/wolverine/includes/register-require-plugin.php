<?php
/**
 * G5Plus Theme Framework includes
 *
 * The $g5plus_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link http://g5plus.net
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once THEME_DIR . 'g5plus-framework/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'g_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function g_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'               => 'Wolverine Framework', // The plugin name
            'slug'               => 'wolverine-framework', // The plugin slug (typically the folder name)
            'source'             => get_template_directory() .  '/theme-plugins/wolverine-framework-v1.4.zip', // The plugin source
	        'version'            => '1.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
	    array(
		    'name'               => 'Revolution Slider', // The plugin name
		    'slug'               => 'revslider', // The plugin slug (typically the folder name)
		    'source'             => get_template_directory() .  '/theme-plugins/revslider_6.2.15.zip', // The plugin source
		    'required'           => true, // If false, the plugin is only 'recommended' instead of required
		    'version'            => '6.2.15', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		    'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		    'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    'external_url'       => '', // If set, overrides default API URL and points to an external URL
	    ),
	    array(
		    'name'               => 'Visual Composer', // The plugin name
		    'slug'               => 'js_composer', // The plugin slug (typically the folder name)
		    'source' => get_template_directory() .  '/theme-plugins/js_composer_6.2.0.zip', // The plugin source
		    'required'           => true, // If false, the plugin is only 'recommended' instead of required
		    'version' => '6.2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		    'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		    'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    'external_url'       => '', // If set, overrides default API URL and points to an external URL
	    ),


        array(
            'name'               => 'Envato Market', // The plugin name
            'slug'               => 'envato-market', // The plugin slug (typically the folder name)
            'source'             => get_template_directory() . '/theme-plugins/envato-market.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'version'            => '2.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'               => 'Contact Form 7', // The plugin name
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'               => 'WP Mail SMTP', // The plugin name
            'slug'               => 'wp-mail-smtp', // The plugin slug (typically the folder name)
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'               => 'WooCommerce', // The plugin name
            'slug'               => 'woocommerce', // The plugin slug (typically the folder name)
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'               => 'MailChimp for WordPress', // The plugin name
            'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
        ),
	    array(
		    'name' => 'WPZOOM Social Feed Widget',
		    'slug' => 'instagram-widget-by-wpzoom',
		    'required' => false,
	    ),
        array(
            'name'               => 'WP User Avatar', // The plugin name
            'slug'               => 'wp-user-avatar', // The plugin slug (typically the folder name)
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'               => 'Restaurant Reservations', // The plugin name
            'slug'               => 'restaurant-reservations', // The plugin slug (typically the folder name)
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'wolverine';
    $config = array(
        'domain'       => $theme_text_domain,
        'id'           => 'g_theme_id',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'install-required-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'wolverine' ),
            'menu_title'                      => __( 'Install Plugins', 'wolverine' ),
            'installing'                      => __( 'Installing Plugin: %s', 'wolverine' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'wolverine' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'wolverine' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'wolverine' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'wolverine' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'wolverine' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'wolverine' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'wolverine' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'wolverine' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'wolverine' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'wolverine' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'wolverine' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'wolverine' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'wolverine' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'wolverine' ), // %s = dashboard link.
            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
