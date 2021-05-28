<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Options Class
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SPWPS_Options' ) ) {
	class SPWPS_Options extends SPWPS_Abstract {

		// constans
		public $unique       = '';
		public $notice       = '';
		public $abstract     = 'options';
		public $sections     = array();
		public $options      = array();
		public $errors       = array();
		public $pre_tabs     = array();
		public $pre_fields   = array();
		public $pre_sections = array();
		public $args         = array(

			// framework title.
			'framework_title'         => '',
			'framework_class'         => '',

			// menu settings.
			'menu_title'              => '',
			'menu_slug'               => '',
			'menu_type'               => 'menu',
			'menu_capability'         => 'manage_options',
			'menu_icon'               => null,
			'menu_position'           => null,
			'menu_hidden'             => false,
			'menu_parent'             => '',

			// menu extras.
			'show_bar_menu'           => true,
			'show_sub_menu'           => true,
			'show_network_menu'       => true,

			'show_search'             => true,
			'show_reset_all'          => true,
			'show_reset_section'      => true,
			'show_all_options'        => true,
			'show_form_warning'       => true,
			'sticky_header'           => true,
			'save_defaults'           => true,
			'ajax_save'               => true,

			// admin bar menu settings.
			'admin_bar_menu_icon'     => '',
			'admin_bar_menu_priority' => 80,

			// database model.
			'database'                => '', // options, transient, theme_mod, network.
			'transient_time'          => 0,

			// contextual help.
			'contextual_help'         => array(),
			'contextual_help_sidebar' => '',

			// typography options.
			'enqueue_webfont'         => true,
			'async_webfont'           => false,

			// others.
			'output_css'              => true,

			// theme.
			'theme'                   => 'dark',
			'class'                   => '',

			// external default values.
			'defaults'                => array(),

		);

		// run framework construct.
		public function __construct( $key, $params = array() ) {

			$this->unique   = $key;
			$this->args     = apply_filters( "spwps_{$this->unique}_args", wp_parse_args( $params['args'], $this->args ), $this );
			$this->sections = apply_filters( "spwps_{$this->unique}_sections", $params['sections'], $this );

			// run only is admin panel options, avoid performance loss.
			$this->pre_tabs     = $this->pre_tabs( $this->sections );
			$this->pre_fields   = $this->pre_fields( $this->sections );
			$this->pre_sections = $this->pre_sections( $this->sections );

			$this->get_options();
			$this->set_options();
			$this->save_defaults();

			add_action( 'admin_menu', array( &$this, 'add_admin_menu' ) );
			add_action( 'admin_bar_menu', array( &$this, 'add_admin_bar_menu' ), $this->args['admin_bar_menu_priority'] );
			add_action( 'wp_ajax_spwps_' . $this->unique . '_ajax_save', array( &$this, 'ajax_save' ) );

			if ( ! empty( $this->args['show_network_menu'] ) ) {
				add_action( 'network_admin_menu', array( &$this, 'add_admin_menu' ) );
			}

			// wp enqeueu for typography and output css.
			parent::__construct();

		}

		// instance.
		public static function instance( $key, $params = array() ) {
			return new self( $key, $params );
		}

		public function pre_tabs( $sections ) {

			$result  = array();
			$parents = array();
			$count   = 100;

			foreach ( $sections as $key => $section ) {
				if ( ! empty( $section['parent'] ) ) {
					$section['priority']             = ( isset( $section['priority'] ) ) ? $section['priority'] : $count;
					$parents[ $section['parent'] ][] = $section;
					unset( $sections[ $key ] );
				}
				$count++;
			}

			foreach ( $sections as $key => $section ) {
				$section['priority'] = ( isset( $section['priority'] ) ) ? $section['priority'] : $count;
				if ( ! empty( $section['id'] ) && ! empty( $parents[ $section['id'] ] ) ) {
					$section['subs'] = wp_list_sort( $parents[ $section['id'] ], array( 'priority' => 'ASC' ), 'ASC', true );
				}
				$result[] = $section;
				$count++;
			}

			return wp_list_sort( $result, array( 'priority' => 'ASC' ), 'ASC', true );
		}

		public function pre_fields( $sections ) {

			$result = array();

			foreach ( $sections as $key => $section ) {
				if ( ! empty( $section['fields'] ) ) {
					foreach ( $section['fields'] as $field ) {
						$result[] = $field;
					}
				}
			}

			return $result;
		}

		public function pre_sections( $sections ) {

			$result = array();

			foreach ( $this->pre_tabs as $tab ) {
				if ( ! empty( $tab['subs'] ) ) {
					foreach ( $tab['subs'] as $sub ) {
						$result[] = $sub;
					}
				}
				if ( empty( $tab['subs'] ) ) {
					$result[] = $tab;
				}
			}

			return $result;
		}

		// add admin bar menu
		public function add_admin_bar_menu( $wp_admin_bar ) {

			if ( ! empty( $this->args['show_bar_menu'] ) && empty( $this->args['menu_hidden'] ) ) {

				global $submenu;

				$menu_slug = $this->args['menu_slug'];
				$menu_icon = ( ! empty( $this->args['admin_bar_menu_icon'] ) ) ? '<span class="spwps-ab-icon ab-icon ' . esc_attr( $this->args['admin_bar_menu_icon'] ) . '"></span>' : '';

				$wp_admin_bar->add_node(
					array(
						'id'    => $menu_slug,
						'title' => $menu_icon . esc_attr( $this->args['menu_title'] ),
						'href'  => esc_url( ( is_network_admin() ) ? network_admin_url( 'admin.php?page=' . $menu_slug ) : admin_url( 'admin.php?page=' . $menu_slug ) ),
					)
				);

				if ( ! empty( $submenu[ $menu_slug ] ) ) {
					foreach ( $submenu[ $menu_slug ] as $key => $menu ) {
						$wp_admin_bar->add_node(
							array(
								'parent' => $menu_slug,
								'id'     => $menu_slug . '-' . $key,
								'title'  => $menu[0],
								'href'   => esc_url( ( is_network_admin() ) ? network_admin_url( 'admin.php?page=' . $menu[2] ) : admin_url( 'admin.php?page=' . $menu[2] ) ),
							)
						);
					}
				}

				if ( ! empty( $this->args['show_network_menu'] ) ) {
					$wp_admin_bar->add_node(
						array(
							'parent' => 'network-admin',
							'id'     => $menu_slug . '-network-admin',
							'title'  => $menu_icon . esc_attr( $this->args['menu_title'] ),
							'href'   => esc_url( network_admin_url( 'admin.php?page=' . $menu_slug ) ),
						)
					);
				}
			}

		}

		public function ajax_save() {

			// Sanitizing post data to ajax save.
			$_POST = ( ! empty( $_POST['data'] ) ) ? wp_kses_post_deep( json_decode( wp_unslash( trim( $_POST['data'] ) ), true ) ) : array();

			$result = $this->set_options( true );

			if ( ! $result ) {
				wp_send_json_error( array( 'error' => esc_html__( 'Error while saving.', 'woo-product-slider' ) ) );
			} else {
				wp_send_json_success(
					array(
						'notice' => $this->notice,
						'errors' => $this->errors,
					)
				);
			}

		}

		// get default value
		public function get_default( $field ) {

			$default = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$default = ( isset( $this->args['defaults'][ $field['id'] ] ) ) ? $this->args['defaults'][ $field['id'] ] : $default;

			return $default;

		}

		// save defaults and set new fields value to main options
		public function save_defaults() {

			$tmp_options = $this->options;

			foreach ( $this->pre_fields as $field ) {
				if ( ! empty( $field['id'] ) ) {
					$this->options[ $field['id'] ] = ( isset( $this->options[ $field['id'] ] ) ) ? $this->options[ $field['id'] ] : $this->get_default( $field );
				}
			}

			if ( $this->args['save_defaults'] && empty( $tmp_options ) ) {
				$this->save_options( $this->options );
			}

		}

		// set options
		public function set_options( $ajax = false ) {

			$noncekey    = 'spwps_options_nonce' . $this->unique;
			$nonce       = ( ! empty( $_POST[ $noncekey ] ) ) ? sanitize_text_field( wp_unslash( $_POST[ $noncekey ] ) ) : '';
			$request     = ( ! empty( $_POST[ $this->unique ] ) ) ? wp_kses_post_deep( $_POST[ $this->unique ] ) : array();
			$transient   = ( ! empty( $_POST['spwps_transient'] ) ) ? wp_kses_post_deep( $_POST['spwps_transient'] ) : array();
			$import_data = ( ! empty( $_POST['spwps_import_data'] ) ) ? wp_kses_post_deep( json_decode( wp_unslash( trim( $_POST['spwps_import_data'] ) ), true ) ) : array();

			if ( wp_verify_nonce( $nonce, 'spwps_options_nonce' ) ) {

				$importing  = false;
				$section_id = ( ! empty( $transient['section'] ) ) ? $transient['section'] : '';

				// import data
				if ( is_array( $import_data ) && ! empty( $import_data ) ) {

					$request   = $import_data;
					$importing = true;

					$this->notice = esc_html__( 'Success. Imported backup options.', 'woo-product-slider' );

				} elseif ( ! empty( $transient['reset'] ) ) {

					foreach ( $this->pre_fields as $field ) {
						if ( ! empty( $field['id'] ) ) {
							$request[ $field['id'] ] = $this->get_default( $field );
						}
					}

					$this->notice = esc_html__( 'Default options restored.', 'woo-product-slider' );

				} elseif ( ! empty( $transient['reset_section'] ) && ! empty( $section_id ) ) {

					if ( ! empty( $this->pre_sections[ $section_id - 1 ]['fields'] ) ) {

						foreach ( $this->pre_sections[ $section_id - 1 ]['fields'] as $field ) {
							if ( ! empty( $field['id'] ) ) {
								$request[ $field['id'] ] = $this->get_default( $field );
							}
						}
					}

					$this->notice = esc_html__( 'Default options restored for only this section.', 'woo-product-slider' );

				} else {

					// sanitize and validate
					foreach ( $this->pre_fields as $field ) {

						if ( ! empty( $field['id'] ) ) {

							  // sanitize
							if ( ! empty( $field['sanitize'] ) ) {

								$sanitize                = $field['sanitize'];
								$value_sanitize          = isset( $request[ $field['id'] ] ) ? $request[ $field['id'] ] : '';
								$request[ $field['id'] ] = call_user_func( $sanitize, $value_sanitize );

							}

							// validate
							if ( ! empty( $field['validate'] ) ) {

								$value_validate = isset( $request[ $field['id'] ] ) ? $request[ $field['id'] ] : '';
								$has_validated  = call_user_func( $field['validate'], $value_validate );

								if ( ! empty( $has_validated ) ) {
									$request[ $field['id'] ]      = ( isset( $this->options[ $field['id'] ] ) ) ? $this->options[ $field['id'] ] : '';
									$this->errors[ $field['id'] ] = $has_validated;
								}
							}

							// auto sanitize
							if ( ! isset( $request[ $field['id'] ] ) || is_null( $request[ $field['id'] ] ) ) {
								$request[ $field['id'] ] = '';
							}
						}
					}
				}

				// ignore nonce requests
				if ( isset( $request['_nonce'] ) ) {
					unset( $request['_nonce'] ); }

				// Ajax and Importing doing wp_unslash already.
				if ( ! $ajax && ! $importing ) {
					$request = wp_unslash( $request );
				}

				$request = apply_filters( "spwps_{$this->unique}_save", $request, $this );

				do_action( "spwps_{$this->unique}_save_before", $request, $this );

				$this->options = $request;

				$this->save_options( $request );

				do_action( "spwps_{$this->unique}_save_after", $request, $this );

				if ( empty( $this->notice ) ) {
					$this->notice = esc_html__( 'Settings saved.', 'woo-product-slider' );
				}

				return true;

			}

			return false;

		}

		// save options database
		public function save_options( $request ) {

			if ( $this->args['database'] === 'transient' ) {
				set_transient( $this->unique, $request, $this->args['transient_time'] );
			} elseif ( $this->args['database'] === 'theme_mod' ) {
				set_theme_mod( $this->unique, $request );
			} elseif ( $this->args['database'] === 'network' ) {
				update_site_option( $this->unique, $request );
			} else {
				update_option( $this->unique, $request );
			}

			do_action( "spwps_{$this->unique}_saved", $request, $this );

		}

		// get options from database
		public function get_options() {

			if ( $this->args['database'] === 'transient' ) {
				$this->options = get_transient( $this->unique );
			} elseif ( $this->args['database'] === 'theme_mod' ) {
				$this->options = get_theme_mod( $this->unique );
			} elseif ( $this->args['database'] === 'network' ) {
				$this->options = get_site_option( $this->unique );
			} else {
				$this->options = get_option( $this->unique );
			}

			if ( empty( $this->options ) ) {
				$this->options = array();
			}

			return $this->options;

		}

		// wp api: admin menu
		public function add_admin_menu() {

			extract( $this->args );

			if ( $menu_type === 'submenu' ) {

				$menu_page = call_user_func( 'add_submenu_page', $menu_parent, esc_attr( $menu_title ), esc_attr( $menu_title ), $menu_capability, $menu_slug, array( &$this, 'add_options_html' ) );

			} else {

				$menu_page = call_user_func( 'add_menu_page', esc_attr( $menu_title ), esc_attr( $menu_title ), $menu_capability, $menu_slug, array( &$this, 'add_options_html' ), $menu_icon, $menu_position );

				if ( ! empty( $this->args['show_sub_menu'] ) && count( $this->pre_tabs ) > 1 ) {

					// create submenus
					$tab_key = 1;
					foreach ( $this->pre_tabs as $section ) {

						call_user_func( 'add_submenu_page', $menu_slug, esc_attr( $section['title'] ), esc_attr( $section['title'] ), $menu_capability, $menu_slug . '#tab=' . $tab_key, '__return_null' );

						if ( ! empty( $section['subs'] ) ) {
							$tab_key += ( count( $section['subs'] ) - 1 );
						}

						$tab_key++;

					}

					remove_submenu_page( $menu_slug, $menu_slug );

				}

				if ( ! empty( $menu_hidden ) ) {
					remove_menu_page( $menu_slug );
				}
			}

			add_action( 'load-' . $menu_page, array( &$this, 'add_page_on_load' ) );

		}

		public function add_page_on_load() {

			if ( ! empty( $this->args['contextual_help'] ) ) {

				$screen = get_current_screen();

				foreach ( $this->args['contextual_help'] as $tab ) {
					$screen->add_help_tab( $tab );
				}

				if ( ! empty( $this->args['contextual_help_sidebar'] ) ) {
					$screen->set_help_sidebar( $this->args['contextual_help_sidebar'] );
				}
			}

		}

		public function error_check( $sections, $err = '' ) {

			if ( ! $this->args['ajax_save'] ) {

				if ( ! empty( $sections['fields'] ) ) {
					foreach ( $sections['fields'] as $field ) {
						if ( ! empty( $field['id'] ) ) {
							if ( array_key_exists( $field['id'], $this->errors ) ) {
								$err = '<span class="spwps-label-error">!</span>';
							}
						}
					}
				}

				if ( ! empty( $sections['subs'] ) ) {
					foreach ( $sections['subs'] as $sub ) {
						$err = $this->error_check( $sub, $err );
					}
				}

				if ( ! empty( $sections['id'] ) && array_key_exists( $sections['id'], $this->errors ) ) {
					$err = $this->errors[ $sections['id'] ];
				}
			}

			return $err;
		}

		// option page html output
		public function add_options_html() {

			$has_nav       = ( count( $this->pre_tabs ) > 1 ) ? true : false;
			$show_all      = ( ! $has_nav ) ? ' spwps-show-all' : '';
			$ajax_class    = ( $this->args['ajax_save'] ) ? ' spwps-save-ajax' : '';
			$sticky_class  = ( $this->args['sticky_header'] ) ? ' spwps-sticky-header' : '';
			$wrapper_class = ( $this->args['framework_class'] ) ? ' ' . $this->args['framework_class'] : '';
			$theme         = ( $this->args['theme'] ) ? ' spwps-theme-' . $this->args['theme'] : '';
			$class         = ( $this->args['class'] ) ? ' ' . $this->args['class'] : '';

			do_action( 'spwps_options_before' );
			// echo '<h1 class="spwps-options-page-title">' . $this->args['menu_title'] . '</h1>';
			echo '<div class="spwps spwps-options' . esc_attr( $theme . $class . $wrapper_class ) . '" data-slug="' . esc_attr( $this->args['menu_slug'] ) . '" data-unique="' . esc_attr( $this->unique ) . '">';
			$notice_class = ( ! empty( $this->notice ) ) ? 'spwps-form-show' : '';
			$notice_text  = ( ! empty( $this->notice ) ) ? $this->notice : '';

			echo '<div class="spwps-form-result spwps-form-success ' . esc_attr( $notice_class ) . '">' . wp_kses_post( $notice_text ) . '</div>';

		//	echo ( $this->args['show_form_warning'] ) ? '<div class="spwps-form-result spwps-form-warning">' . esc_html__( 'Settings have changed, you should save them!', 'woo-product-slider' ) . '</div>' : '';

			echo ( $has_nav && $this->args['show_all_options'] ) ? '<div class="spwps-expand-all" title="' . esc_html__( 'show all options', 'woo-product-slider' ) . '"><i class="fas fa-outdent"></i></div>' : '';
			echo '<div class="spwps-container">';

			echo '<form method="post" action="" enctype="multipart/form-data" id="spwps-form" autocomplete="off">';

			echo '<input type="hidden" class="spwps-section-id" name="spwps_transient[section]" value="1">';

			wp_nonce_field( 'spwps_options_nonce', 'spwps_options_nonce' . $this->unique );

			echo '<div class="spwps-header' . esc_attr( $sticky_class ) . '">';
			echo '<div class="spwps-header-inner">';

			echo '<div class="spwps-header-left">';
			echo '<h1><img src="'. SP_WPS_URL . 'admin/assets/images/wps-icon-color.svg" alt="">' . $this->args['framework_title'] . '</h1>';
			echo '</div>';

			echo '<div class="spwps-header-right">';



			echo ( $this->args['show_search'] ) ? '<div class="spwps-search"><input type="text" name="spwps-search" placeholder="' . esc_html__( 'Search option(s)', 'woo-product-slider' ) . '" autocomplete="off" /></div>' : '';

			echo '<div class="spwps-buttons">';
			echo '<input type="submit" name="' . esc_attr( $this->unique ) . '[_nonce][save]" class="button button-primary spwps-top-save spwps-save' . esc_attr( $ajax_class ) . '" value="' . esc_html__( 'Save', 'woo-product-slider' ) . '" data-save="' . esc_html__( 'Saving...', 'woo-product-slider' ) . '">';
			echo ( $this->args['show_reset_section'] ) ? '<input type="submit" name="spwps_transient[reset_section]" class="button button-secondary spwps-reset-section spwps-confirm" value="' . esc_html__( 'Reset Section', 'woo-product-slider' ) . '" data-confirm="' . esc_html__( 'Are you sure to reset this section options?', 'woo-product-slider' ) . '">' : '';
			echo ( $this->args['show_reset_all'] ) ? '<input type="submit" name="spwps_transient[reset]" class="button spwps-warning-primary spwps-reset-all spwps-confirm" value="' . esc_html__( 'Reset All', 'woo-product-slider' ) . '" data-confirm="' . esc_html__( 'Are you sure to reset all options?', 'woo-product-slider' ) . '">' : '';
			echo '</div>';

			echo '</div>';

			echo '<div class="clear"></div>';
			echo '</div>';
			echo '</div>';

			echo '<div class="spwps-wrapper' . esc_attr( $show_all ) . '">';

			if ( $has_nav ) {

				echo '<div class="spwps-nav spwps-nav-options">';

				echo '<ul>';

				$tab_key = 1;

				foreach ( $this->pre_tabs as $tab ) {

					$tab_error = $this->error_check( $tab );
					$tab_icon  = ( ! empty( $tab['icon'] ) ) ? '<i class="spwps-tab-icon ' . esc_attr( $tab['icon'] ) . '"></i>' : '';

					if ( ! empty( $tab['subs'] ) ) {

						echo '<li class="spwps-tab-depth-0">';

						echo '<a href="#tab=' . $tab_key . '" class="spwps-arrow">' . wp_kses_post( $tab_icon . $tab['title'] . $tab_error ) . '</a>';

						echo '<ul>';

						foreach ( $tab['subs'] as $sub ) {

							$sub_error = $this->error_check( $sub );
							$sub_icon  = ( ! empty( $sub['icon'] ) ) ? '<i class="spwps-tab-icon ' . esc_attr( $sub['icon'] ) . '"></i>' : '';

							echo '<li class="spwps-tab-depth-1"><a id="spwps-tab-link-' . esc_attr( $tab_key ) . '" href="#tab=' . esc_attr( $tab_key ) . '">' . wp_kses_post( $sub_icon . $sub['title'] . $sub_error ) . '</a></li>';

							$tab_key++;

						}

						echo '</ul>';

						echo '</li>';

					} else {

						echo '<li class="spwps-tab-depth-0"><a id="spwps-tab-link-' . esc_attr( $tab_key ) . '" href="#tab=' . esc_attr( $tab_key ) . '">' . wp_kses_post( $tab_icon . $tab['title'] . $tab_error ) . '</a></li>';

						$tab_key++;

					}
				}

				echo '</ul>';

				echo '</div>';

			}

			echo '<div class="spwps-content">';

			echo '<div class="spwps-sections">';

			$section_key = 1;

			foreach ( $this->pre_sections as $section ) {

				$onload       = ( ! $has_nav ) ? ' spwps-onload' : '';
				$section_icon = ( ! empty( $section['icon'] ) ) ? '<i class="spwps-section-icon ' . esc_attr( $section['icon'] ) . '"></i>' : '';

				echo '<div id="spwps-section-' . $section_key . '" class="spwps-section' . esc_attr( $onload ) . '">';
				echo ( $has_nav ) ? '<div class="spwps-section-title"><h3>' . wp_kses_post( $section_icon . $section['title'] ) . '</h3></div>' : '';
				echo ( ! empty( $section['description'] ) ) ? '<div class="spwps-field spwps-section-description">' . wp_kses_post( $section['description'] ) . '</div>' : '';

				if ( ! empty( $section['fields'] ) ) {

					foreach ( $section['fields'] as $field ) {

						$is_field_error = $this->error_check( $field );

						if ( ! empty( $is_field_error ) ) {
							$field['_error'] = $is_field_error;
						}

						if ( ! empty( $field['id'] ) ) {
							$field['default'] = $this->get_default( $field );
						}

						$value = ( ! empty( $field['id'] ) && isset( $this->options[ $field['id'] ] ) ) ? $this->options[ $field['id'] ] : '';

						SPWPS::field( $field, $value, $this->unique, 'options' );

					}
				} else {

								echo '<div class="spwps-no-option spwps-text-muted">' . esc_html__( 'No option provided by developer.', 'woo-product-slider' ) . '</div>';

				}

				echo '</div>';

				$section_key++;

			}

			echo '</div>';

			echo '<div class="clear"></div>';

			echo '</div>';

			echo '<div class="spwps-nav-background"></div>';

			echo '</div>';

			echo '</form>';

			echo '</div>';

			echo '<div class="clear"></div>';

			echo '</div>';

			do_action( 'spwps_options_after' );

		}
	}
}
