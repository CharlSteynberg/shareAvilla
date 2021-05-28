<?php
if ( !class_exists('XMenu_Setting_Options' ) ):
	class XMenu_Setting_Options {
		private static $instance;
		public $setting_options;
		public static function init() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new XMenu_Setting_Options;
			}

			return self::$instance;
		}
		function __construct() {
			$theme_location = get_registered_nav_menus();
			$nav_menus = wp_get_nav_menus();
			$nav_menu_arr = array();
			foreach ($nav_menus as $nav_key => $nav_value) {
				$nav_menu_arr[$nav_value->slug] = $nav_value->name;
			}
			$this->setting_options = array(
				'settings' => array(
					'text' => 'Settings',
					'config' => array(
						'setting-heading' => array(
							'text' => __('Settings','wolverine'),
							'type' => 'heading',
						),

						/*'setting-responsive-breakpoint' => array(
							'text' => __('Responsive Breakpoint','wolverine'),
							'type' => 'text',
							'std' => '',
							'des' => 'The viewport width at which the menu will collapse to mobile menu. Do not include units. By default 991',
						),*/

						'transition' => array(
							'text' => __('Select Menu Transition','wolverine'),
							'type' => 'select',
							'std' => 'none',
							'options' => xmenu_get_transition()
						),
						'transition-duration' => array(
							'text' => __('Transition Duration','wolverine'),
							'type' => 'text',
							'std' => '',
							'des' => 'The transition duration. By default 0.5s',
						),
					),
				),

				'images' => array(
					'text' => 'Images',
					'config' => array(
						'image-heading' => array(
							'text' => __('Images Settings','wolverine'),
							'type' => 'heading',
						),
						'image-size' => array(
							'text' => __('Image Size','wolverine'),
							'type' => 'select',
							'std' => 'none',
							'options' => xmenu_get_image_size(1)
						),
						'image-width' => array(
							'text' => __('Image Width','wolverine'),
							'type' => 'text',
							'std' => '',
							'des' => 'The width attribute value for item images! Do not include units',
						),
						'image-height' => array(
							'text' => __('Image Height','wolverine'),
							'type' => 'text',
							'std' => '',
							'des' => 'The height attribute value for item images! Do not include units',
						),
					),
				),

			);
			add_action( 'admin_menu', array($this, 'admin_menu') );
			add_action( 'wp_ajax_xmenu_setting_create', array($this, 'xmenu_setting_create') );
			add_action( 'wp_ajax_xmenu_setting_save', array($this, 'xmenu_setting_save') );
			add_action( 'wp_ajax_xmenu_delete_setting', array($this, 'xmenu_delete_setting') );
		}

		function get_setting_defaults() {
			$setting_default = array();
			foreach($this->setting_options as $setting_key => $setting_value) {
				foreach($setting_value['config'] as $key => $value) {
					if ($value['type'] != 'heading') {
						if ($value['type'] == 'list-checkbox') {
							$setting_default[$key] = array();
						}
						else {
							$setting_default[$key] = $value['std'];
						}
					}
					else {
						$setting_default[$key] = '';
					}

				}
			}
			return $setting_default;
		}

		function admin_menu() {
			add_theme_page(
				__('XMENU Settings','wolverine'),
				__('XMENU Settings','wolverine'),
				'manage_options',
				'xmenu-settings',
				array($this, 'control_panel')
			);
		}

		function control_panel() {
			if (isset( $_POST['do'])) {
				echo '<h1>POST</h1>';
			}
			if( !isset( $_GET['do'] ) ){
				$this->plugin_page();
			}
			else {
				switch ($_GET['do']) {
					case 'widget':
						$this->widget_manager();
						break;
					default:
						$this->plugin_page();
						break;
				}
			}

		}

		function plugin_page() {
			$current_menu = '';
			$current_menu_separate = '';
			if (isset($_GET['menu']) && !empty($_GET['menu'])) {
				$current_menu_separate = '_';
				$current_menu = $_GET['menu'];
				unset($this->setting_options['settings']);
				unset($this->setting_options['integration']);
			}

			$setting_default = $this->get_setting_defaults();

			$settings = get_option(XMENU_SETTING_OPTIONS .  $current_menu_separate . $current_menu);
			if (isset($settings) && $settings) {
				$settings = array_merge($setting_default, $settings);
			}
			else {
				$settings = $setting_default;
			}

			$terms = get_terms( 'nav_menu', array( 'hide_empty' => false ));
			$setting_menus = array();
			$setting_not_create = array();
			foreach ($terms as $term_value) {
				if (get_option(XMENU_SETTING_OPTIONS . '_' . $term_value->slug) !== false) {
					$setting_menus[] = $term_value->slug;
				}
				else {
					$setting_not_create[$term_value->slug] = $term_value->name;
				}
			}

			?>
			<div class="xmenu-settings">
				<h2>
					<a class="tab <?php echo esc_attr($current_menu == '' ? 'active' : '') ?>" href="themes.php?page=xmenu-settings"><strong><?php _e('XMENU','wolverine') ?></strong> <?php _e('Setting','wolverine') ?></a>
					<?php foreach ($setting_menus as $setting_menu): ?>
						<a class="tab <?php echo esc_attr($current_menu == $setting_menu ? 'active' : '') ?>" href="<?php echo esc_url('themes.php?page=xmenu-settings&menu=' . $setting_menu) ?>"><strong><?php echo esc_html($setting_menu); ?></strong> <?php _e('Setting','wolverine') ?></a>
					<?php endforeach; ?>
					<a class="tab" href="themes.php?page=xmenu-settings&do=widget"><strong><?php _e('XMENU','wolverine') ?></strong> <?php _e('Widget Manager','wolverine') ?></a>
					<button id="setting-add-menu" type="button" class="button button-primary x-fr"><?php _e('Add Menu Setting','wolverine') ?></button>
				</h2>
				<form method="post" action="themes.php?page=xmenu-settings" novalidate="novalidate" id="xmenu_settings">
					<div class="xmenu-settings-inner">
						<ul class="setting-left">
							<?php $is_first = true;?>
							<?php foreach($this->setting_options as $setting_key => $setting_value): ?>
								<li class="<?php echo esc_attr($is_first ? 'active':'') ?>" data-ref="<?php echo esc_attr($setting_key)?>"><?php echo esc_html($setting_value['text']) ?></li>
								<?php $is_first = false;?>
							<?php endforeach; ?>
						</ul>
						<div class="setting-right">
							<?php $is_first = true;?>
							<?php foreach($this->setting_options as $setting_key => $setting_value): ?>
								<table class="form-table <?php echo esc_attr($is_first ? 'active':'') ?>" data-ref="<?php echo esc_attr($setting_key)?>">
									<tbody>
									<?php foreach($setting_value['config'] as $key => $item): ?>
										<?php xmenu_bind_setting_item($key, $item, $settings[$key]);?>
									<?php endforeach;?>
									</tbody>
								</table>
								<?php $is_first = false;?>
							<?php endforeach; ?>
						</div>
						<div style="clear: both"></div>
					</div>
					<p class="submit">
						<input type="hidden" name="action" value="xmenu_setting_save" />
						<button type="button" id="xmenu-save-setting" class="button button-primary"><i class="fa fa-save"></i> <?php echo __('Save Changes','wolverine')?></button>
						<?php if (!empty($current_menu)): ?>
							<input id="xmenu_menu_slug" type="hidden" name="menu_slug" value="<?php echo esc_attr($current_menu) ?>"/>
							<button type="button" class="button button-primary" id="xmenu-delete-setting"><i class="fa fa-remove"></i> <?php echo __('Delete Settings','wolverine')?></button>
						<?php endif;?>
					</p>
				</form>
				<div class="x-popup" id="xmenu-setting-popup">
					<div class="x-popup-inner">
						<h3><?php _e('Select Menu for your new settings','wolverine') ?> <i id="setting-add-menu-close" class="fa fa-close"></i></h3>
						<div class="x-popup-select">
							<select id="xmenu-select-create">
								<?php foreach($setting_not_create as $setting_not_create_key => $setting_not_create_value): ?>
									<option value="<?php echo esc_attr($setting_not_create_key)?>"><?php echo esc_html($setting_not_create_value)?></option>
								<?php endforeach; ?>
							</select>
							<button id="xmenu-create-button" type="button"><?php _e('Create Menu Setting','wolverine') ?></button>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		function widget_manager() {
			$widgets = get_option(XMENU_MENU_ITEM_WIDGET_AREAS, array());
			$sidebars = get_option('sidebars_widgets');
			if (isset($_POST['submit']) && ($_POST['submit'])) {
				if (isset($_POST['widget_area_id'])) {
					$widget_area_id = $_POST['widget_area_id'];
					foreach( $widget_area_id as $id ){
						if( isset( $widgets[$id] ) ){
							unset( $widgets[$id] );
						}
						if (isset($sidebars) & is_array($sidebars) && isset($sidebars[XMENU_MENU_WIDGET_AREAS_ID . $id])) {
							unset($sidebars[XMENU_MENU_WIDGET_AREAS_ID . $id]);
						}
					}
					update_option('sidebars_widgets', $sidebars);
					update_option( XMENU_MENU_ITEM_WIDGET_AREAS , $widgets );
				}
			}

			$terms = get_terms( 'nav_menu', array( 'hide_empty' => false ));
			$setting_menus = array();
			foreach ($terms as $term_value) {
				if (get_option(XMENU_SETTING_OPTIONS . '_' . $term_value->slug) !== false) {
					$setting_menus[] = $term_value->slug;
				}
			}
			?>
			<div class="xmenu-settings">
				<h2>
					<a class="tab" href="themes.php?page=xmenu-settings"><strong><?php _e('XMENU','wolverine') ?></strong> <?php _e('Setting','wolverine') ?></a>
					<?php foreach ($setting_menus as $setting_menu): ?>
						<a class="tab" href="<?php echo esc_url('themes.php?page=xmenu-settings&menu=' . $setting_menu)  ?>"><strong><?php echo esc_html($setting_menu); ?></strong> <?php _e('Setting','wolverine') ?></a>
					<?php endforeach; ?>
					<a class="tab active" href="themes.php?page=xmenu-settings&do=widget"><strong><?php _e('XMENU','wolverine') ?></strong> <?php _e('Widget Manager','wolverine') ?></a>
				</h2>
				<form action="themes.php?page=xmenu-settings&do=widget" method="post">
					<table class="form-table">
						<tbody>
							<?php foreach( $widgets as $menu_item_id => $widget_title ):?>
								<tr>
									<td class="w20px">
										<fieldset>
											<label for="widget_area_id_<?php echo esc_attr($menu_item_id); ?>">
												<input id="widget_area_id_<?php echo esc_attr($menu_item_id); ?>" name="widget_area_id[]" type="checkbox" value="<?php echo esc_attr($menu_item_id); ?>" />
											</label>
										</fieldset>
									</td>
									<td><?php echo esc_html($widget_title) . __(' [Menu Item ', 'wolverine') . esc_html($menu_item_id) .']'; ?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					<p><?php _e('Choose which Custom Widget Areas to delete', 'wolverine') ?></p>
					<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo __('Delete Widget Areas','wolverine')?>"></p>
				</form>
			</div>
			<?php
		}

		function xmenu_setting_create() {
			$error_result = array(
				'code' => '-1',
				'message' => __('Create menu settings fail','wolverine'),
			);

			$menu_slug = '';
			if (isset($_POST['menu_slug'])) {
				$menu_slug = $_POST['menu_slug'];
			}

			if (empty($menu_slug)) {
				echo json_encode($error_result);
				die();
			}

			if (get_option(XMENU_SETTING_OPTIONS . '_' . $menu_slug) !== false) {
				echo json_encode($error_result);
				die();
			}

			$menu_ops = array();
			update_option(XMENU_SETTING_OPTIONS . '_' . $menu_slug, $menu_ops);

			$error_result = array(
				'code' => '1',
				'message' => '',
			);
			echo json_encode($error_result);
			die();
		}
		function xmenu_setting_save(){
			$error_result = array(
				'code' => '-1',
				'message' => __('Create menu settings fail','wolverine'),
			);

			try{
				$current_menu = '';
				$current_menu_separate = '';
				if (isset($_POST['menu_slug']) && !empty($_POST['menu_slug'])) {
					$current_menu_separate = '_';
					$current_menu = $_POST['menu_slug'];
					unset($this->setting_options['settings']);
					unset($this->setting_options['integration']);
				}

				$setting_default = $this->get_setting_defaults();

				$settings = array();
				if (isset($_POST[XMENU_SETTING_OPTIONS])) {
					$settings = $_POST[XMENU_SETTING_OPTIONS];
				}
				foreach($this->setting_options as $setting_key => $setting_value) {
					foreach($setting_value['config'] as $key => $value) {
						if (!isset($settings[$key]) && ($value['type'] == 'checkbox')) {
							$settings[$key] = '';
						}
						if (!isset($settings[$key]) && ($value['type'] == 'list-checkbox')) {
							$settings[$key] = array();
						}
					}
				}

				$settings = array_merge($setting_default, $settings);

				update_option(XMENU_SETTING_OPTIONS .  $current_menu_separate . $current_menu, $settings);

				do_action('xmenu_setting_save',$current_menu_separate . $current_menu,$settings);

				$error_result['code'] = 1;
				$error_result['message'] = '';
				echo json_encode($error_result);
				die();
			}
			catch (Exception $e) {
				$error_result['message'] = $e->getMessage();
			}


			echo json_encode($error_result);
			die();
		}
		function xmenu_delete_setting() {
			$error_result = array(
				'code' => '-1',
				'message' => __('Delete menu settings fail','wolverine'),
			);

			if (isset($_POST['menu_slug']) && !empty($_POST['menu_slug'])) {
				$current_menu_separate = '_';
				$current_menu = $_POST['menu_slug'];
				delete_option(XMENU_SETTING_OPTIONS .  $current_menu_separate . $current_menu);

				try {
					WP_Filesystem();
					global $wp_filesystem;

					$file_name = XMENU_DIR .   'assets/css/style' .  $current_menu_separate . $current_menu . '.css';
					if(!$wp_filesystem->is_dir($file_name)) {
						$wp_filesystem->delete($file_name);
					}
				}
				catch (Exception $e) {}

				$error_result['code'] = '1';
				$error_result['message'] = '';
			}

			echo json_encode($error_result);
			die();
		}
	}
endif;
if( !function_exists( '_XMENU_SETTING' ) ){
	add_action('init', '_XMENU_SETTING');
	function _XMENU_SETTING() {
		return XMenu_Setting_Options::init();
	}
}