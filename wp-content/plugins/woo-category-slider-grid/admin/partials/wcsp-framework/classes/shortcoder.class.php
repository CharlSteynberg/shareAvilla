<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Shortcoder Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'SP_WCS_Shortcoder' ) ) {
	class SP_WCS_Shortcoder extends SP_WCS_Abstract{
		// constans
		public $unique       = '';
		public $abstract     = 'shortcoder';
		public $blocks       = array();
		public $sections     = array();
		public $pre_tabs     = array();
		public $pre_sections = array();
		public $args         = array(
			'button_title'     => 'Add Shortcode',
			'select_title'     => 'Select a shortcode',
			'insert_title'     => 'Insert Shortcode',
			'show_in_editor'   => true,
			'defaults'         => array(),
			'gutenberg'        => array(
				'title'          => 'SP_WCS Shortcodes',
				'description'    => 'SP_WCS Shortcode Block',
				'icon'           => 'screenoptions',
				'category'       => 'widgets',
				'keywords'       => array( 'shortcode', 'spf', 'insert' ),
				'placeholder'    => 'Write shortcode here...',
			),
		);
		// run shortcode construct
		public function __construct( $key, $params = array() ) {
			$this->unique       = $key;
			$this->args         = apply_filters( "spf_{$this->unique}_args", wp_parse_args( $params['args'], $this->args ), $this );
			$this->sections     = apply_filters( "spf_{$this->unique}_sections", $params['sections'], $this );
			$this->pre_tabs     = $this->pre_tabs( $this->sections );
			$this->pre_sections = $this->pre_sections( $this->sections );
			add_action( 'admin_footer', array( &$this, 'add_shortcode_modal' ) );
			add_action( 'customize_controls_print_footer_scripts', array( &$this, 'add_shortcode_modal' ) );
			add_action( 'wp_ajax_spf-get-shortcode-'. $this->unique, array( &$this, 'get_shortcode' ) );
			if( ! empty( $this->args['show_in_editor'] ) ) {
				SP_WCS::$shortcode_instances[] = wp_parse_args( array( 'hash' => md5( $key ), 'modal_id' => $this->unique ), $this->args );
				// elementor editor support
				if( SP_WCS::is_active_plugin( 'elementor/elementor.php' ) ) {
					add_action( 'elementor/editor/before_enqueue_scripts', array( 'SP_WCS', 'add_admin_enqueue_scripts' ), 20 );
					add_action( 'elementor/editor/footer', array( &$this, 'add_shortcode_modal' ) );
					add_action( 'elementor/editor/footer', 'spf_set_icons' );
				}
			}
		}
		// instance
		public static function instance( $key, $params = array() ) {
			return new self( $key, $params );
		}
		public function pre_tabs( $sections ) {
			$result  = array();
			$parents = array();
			$count   = 100;
			foreach( $sections as $key => $section ) {
				if( ! empty( $section['parent'] ) ) {
					$section['priority'] = ( isset( $section['priority'] ) ) ? $section['priority'] : $count;
					$parents[$section['parent']][] = $section;
					unset( $sections[$key] );
				}
				$count++;
			}
			foreach( $sections as $key => $section ) {
				$section['priority'] = ( isset( $section['priority'] ) ) ? $section['priority'] : $count;
				if( ! empty( $section['id'] ) && ! empty( $parents[$section['id']] ) ) {
					$section['subs'] = wp_list_sort( $parents[$section['id']], array( 'priority' => 'ASC' ), 'ASC', true );
				}
				$result[] = $section;
				$count++;
			}
			return wp_list_sort( $result, array( 'priority' => 'ASC' ), 'ASC', true );
		}
		public function pre_sections( $sections ) {
			$result = array();
			foreach( $this->pre_tabs as $tab ) {
				if( ! empty( $tab['subs'] ) ) {
					foreach( $tab['subs'] as $sub ) {
						$result[] = $sub;
					}
				}
				if( empty( $tab['subs'] ) ) {
					$result[] = $tab;
				}
			}
			return $result;
		}
		// get default value
		public function get_default( $field ) {
			$default = ( isset( $field['id'] ) && isset( $this->args['defaults'][$field['id']] ) ) ? $this->args['defaults'][$field['id']] : '';
			$default = ( isset( $field['default'] ) ) ? $field['default'] : $default;
			return $default;
		}
		public function add_shortcode_modal() {
			$has_select   = ( count( $this->pre_tabs ) > 1 ) ? true : false;
			$single_usage = ( ! $has_select ) ? ' spf-shortcode-single' : '';
			$hide_header  = ( ! $has_select ) ? ' hidden' : '';
		?>
			<div id="spf-modal-<?php echo $this->unique; ?>" class="wp-core-ui spf-modal spf-shortcode<?php echo $single_usage; ?>" data-modal-id="<?php echo $this->unique; ?>" data-nonce="<?php echo wp_create_nonce( 'spf_shortcode_nonce' ); ?>">
				<div class="spf-modal-table">
					<div class="spf-modal-table-cell">
						<div class="spf-modal-overlay"></div>
						<div class="spf-modal-inner">
							<div class="spf-modal-title">
								<?php echo $this->args['button_title']; ?>
								<div class="spf-modal-close"></div>
							</div>
							<?php
								echo '<div class="spf-modal-header'. $hide_header .'">';
								echo '<select>';
								echo ( $has_select ) ? '<option value="">'. $this->args['select_title'] .'</option>' : '';
								$tab_key = 1;
								foreach ( $this->pre_tabs as $tab ) {
									if( ! empty( $tab['subs'] ) ) {
										echo '<optgroup label="'. $tab['title'] .'">';
										foreach ( $tab['subs'] as $sub ) {
											$view      = ( ! empty( $sub['view'] ) ) ? ' data-view="'. $sub['view'] .'"' : '';
											$shortcode = ( ! empty( $sub['shortcode'] ) ) ? ' data-shortcode="'. $sub['shortcode'] .'"' : '';
											$group     = ( ! empty( $sub['group_shortcode'] ) ) ? ' data-group="'. $sub['group_shortcode'] .'"' : '';
											echo '<option value="'. $tab_key .'"'. $view . $shortcode . $group .'>'. $sub['title'] .'</option>';
											$tab_key++;
										}
										echo '</optgroup>' ;
									} else {
											$view      = ( ! empty( $tab['view'] ) ) ? ' data-view="'. $tab['view'] .'"' : '';
											$shortcode = ( ! empty( $tab['shortcode'] ) ) ? ' data-shortcode="'. $tab['shortcode'] .'"' : '';
											$group     = ( ! empty( $tab['group_shortcode'] ) ) ? ' data-group="'. $tab['group_shortcode'] .'"' : '';
											echo '<option value="'. $tab_key .'"'. $view . $shortcode . $group .'>'. $tab['title'] .'</option>';
										$tab_key++;
									}
								}
								echo '</select>';
								echo '</div>';
							?>
							<div class="spf-modal-content">
								<div class="spf-modal-loading"><div class="spf-loading"></div></div>
								<div class="spf-modal-load"></div>
							</div>
							<div class="spf-modal-insert-wrapper hidden"><a href="#" class="button button-primary spf-modal-insert"><?php echo $this->args['insert_title']; ?></a></div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		public function get_shortcode() {
			ob_start();
			$shortcode_key = spf_get_var( 'shortcode_key' );
			if( ! empty( $shortcode_key ) && wp_verify_nonce( spf_get_var( 'nonce' ), 'spf_shortcode_nonce' ) ) {
				$unallows  = array( 'group', 'repeater', 'sorter' );
				$section   = $this->pre_sections[$shortcode_key-1];
				$shortcode = ( ! empty( $section['shortcode'] ) ) ? $section['shortcode'] : '';
				$view      = ( ! empty( $section['view'] ) ) ? $section['view'] : 'normal';
				if( ! empty( $section ) ) {
					//
					// View: normal
					if( ! empty( $section['fields'] ) && $view !== 'repeater' ) {
						echo '<div class="spf-fields">';
						foreach ( $section['fields'] as $field ) {
							if( in_array( $field['type'], $unallows ) ) { $field['_notice'] = true; }
							// Extra tag improves for spesific fields (border, spacing, dimensions etc...)
							$field['tag_prefix'] = ( ! empty( $field['tag_prefix'] ) ) ? $field['tag_prefix'] .'_' : '';
							$field_default = $this->get_default( $field );
							SP_WCS::field( $field, $field_default, $shortcode, 'shortcode' );
						}
						echo '</div>';
					}
					//
					// View: group and repeater fields
					$repeatable_fields = ( $view === 'repeater' && ! empty( $section['fields'] ) ) ? $section['fields'] : array();
					$repeatable_fields = ( $view === 'group' && ! empty( $section['group_fields'] ) ) ? $section['group_fields'] : $repeatable_fields;
					if( ! empty( $repeatable_fields ) ) {
						$button_title    = ( ! empty( $section['button_title'] ) ) ? ' '. $section['button_title'] : esc_html__( 'Add one more', 'woo-category-slider' );
						$inner_shortcode = ( ! empty( $section['group_shortcode'] ) ) ? $section['group_shortcode'] : $shortcode;
						echo '<div class="spf--repeatable">';
							echo '<div class="spf--repeat-shortcode">';
								echo '<div class="spf-repeat-remove fa fa-times"></div>';
								echo '<div class="spf-fields">';
								foreach ( $repeatable_fields as $field ) {
									if( in_array( $field['type'], $unallows ) ) { $field['_notice'] = true; }
									// Extra tag improves for spesific fields (border, spacing, dimensions etc...)
									$field['tag_prefix'] = ( ! empty( $field['tag_prefix'] ) ) ? $field['tag_prefix'] .'_' : '';
									$field_default = $this->get_default( $field );
									SP_WCS::field( $field, $field_default, $inner_shortcode.'[0]', 'shortcode' );
								}
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="spf--repeat-button-block"><a class="button spf--repeat-button" href="#"><i class="fa fa-plus-circle"></i> '. $button_title .'</a></div>';
					}
				}
			} else {
				echo '<div class="spf-field spf-text-error">'. esc_html__( 'Security check', 'woo-category-slider' ) .'</div>';
			}
			wp_send_json_success( array( 'success' => true, 'content' => ob_get_clean() ) );
		}
		// Once editor setup for gutenberg and media buttons
		public static function once_editor_setup() {
			if ( function_exists( 'register_block_type' ) ) {
				add_action( 'init', array( 'SP_WCS_Shortcoder', 'add_guteberg_block' ) );
			}
			if ( spf_wp_editor_api() ) {
				add_action( 'media_buttons', array( 'SP_WCS_Shortcoder', 'add_media_buttons' ) );
			}
		}
		// Add gutenberg blocks.
		public static function add_guteberg_block() {
			wp_register_script( 'spf-gutenberg-block', SP_WCS::include_plugin_url( 'assets/js/spf-gutenberg-block.js' ), array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components' ) );
			wp_localize_script( 'spf-gutenberg-block', 'spf_gutenberg_blocks', SP_WCS::$shortcode_instances );
			foreach( SP_WCS::$shortcode_instances as $hash => $value ) {
				register_block_type( 'spf-gutenberg-block/block-'. $hash, array(
					'editor_script' => 'spf-gutenberg-block',
				) );
			}
		}
		// Add media buttons
		public static function add_media_buttons( $editor_id ) {
			foreach( SP_WCS::$shortcode_instances as $hash => $value ) {
				echo '<a href="#" class="button button-primary spf-shortcode-button" data-editor-id="'. $editor_id .'" data-modal-id="'. $value['modal_id'] .'">'. $value['button_title'] .'</a>';
			}
		}
	}
}