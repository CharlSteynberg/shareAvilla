<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/28/2015
 * Time: 5:18 PM
 */
if (!class_exists('g5plusFramework_Admin')) {
	class g5plusFramework_Admin {

		private $prefix;


		private $version;


		public function __construct( $prefix, $version ) {
			$this->prefix = $prefix;
			$this->version = $version;

			add_action('wp_ajax_popup_icon', array($this,'popup_icon'));
		}

		/**
		 * Register the stylesheets for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles() {

            $pages = isset($_GET['page']) ? $_GET['page'] : '';
            if ($pages == '_options') return;


			wp_enqueue_style( $this->prefix.'admin', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/css/admin.css'), array(), $this->version, 'all' );
			wp_enqueue_style( $this->prefix.'wolverine-icon', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/wolverine-icon/css/styles.min.css'), array(), $this->version, 'all' );
			wp_enqueue_style( $this->prefix.'font-awesome', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/fonts-awesome/css/font-awesome.min.css'), array(), $this->version, 'all' );
			wp_enqueue_style( $this->prefix.'popup-icon', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/css/popup-icon.css'), array(), $this->version, 'all' );

			wp_enqueue_style( $this->prefix.'bootstrap-tagsinput', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'), array(), $this->version, 'all' );

			wp_enqueue_style('select2', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/jquery.select2/css/select2.min.css'), array(), '4.0.3');




		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts() {

			wp_enqueue_script( $this->prefix .'admin', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/js/admin.js'), array( 'jquery' ), $this->version, false );


			wp_enqueue_script( $this->prefix .'bootstrap-tagsinput', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'), array( 'jquery' ), $this->version, false );

			wp_enqueue_script( 'select2', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/jquery.select2/js/select2.full.min.js'), array( 'jquery' ), '4.0.3', true);

			wp_enqueue_script( $this->prefix .'media-init', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/js/g5plus-media-init.js'), array( 'jquery' ), $this->version, false );
			if (function_exists('wp_enqueue_media')) {
				wp_enqueue_media();
			}

			wp_enqueue_script( $this->prefix .'popup-icon', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/js/popup-icon.js'), array( 'jquery' ), $this->version, false );

			wp_localize_script( $this->prefix .'admin' , 'g5plus_framework_meta' , array(
				'ajax_url' => admin_url( 'admin-ajax.php?activate-multi=true' )
			) );

		}

		public function dequeue_assets(){
			$screen         = get_current_screen();
			$screen_id      = $screen ? $screen->id : '';
			$screen_ids   = array(
				'widgets',
				'toplevel_page__options'
			);

			if ( in_array( $screen_id, $screen_ids ) ) {
				wp_dequeue_style( 'woocommerce_admin_styles' );
				wp_dequeue_style('yith_wcan_admin');
				wp_dequeue_style('jquery-ui-style');
				wp_dequeue_style('yit-jquery-ui-style');
				wp_dequeue_style('jquery-ui-overcast');

				wp_dequeue_script('woocommerce_settings');

				wp_dequeue_script( 'wpb_ace' );
				wp_deregister_script( 'wpb_ace' );
			}
		}

		public function popup_icon() {
			$icons = array('glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'remove', 'close', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'gear', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'rotate-right', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'dedent', 'outdent', 'indent', 'video-camera', 'photo', 'image', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'edit', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'mail-forward', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'warning', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'gears', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook-f', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'group', 'users', 'chain', 'link', 'cloud', 'flask', 'cut', 'scissors', 'copy', 'files-o', 'paperclip', 'save', 'floppy-o', 'square', 'navicon', 'reorder', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'unsorted', 'sort', 'sort-down', 'sort-desc', 'sort-up', 'sort-asc', 'envelope', 'linkedin', 'rotate-left', 'undo', 'legal', 'gavel', 'dashboard', 'tachometer', 'comment-o', 'comments-o', 'flash', 'bolt', 'sitemap', 'umbrella', 'paste', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile-phone', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'mail-reply', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'mail-reply-all', 'reply-all', 'star-half-empty', 'star-half-full', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'unlink', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'toggle-down', 'caret-square-o-down', 'toggle-up', 'caret-square-o-up', 'toggle-right', 'caret-square-o-right', 'euro', 'eur', 'gbp', 'dollar', 'usd', 'rupee', 'inr', 'cny', 'rmb', 'yen', 'jpy', 'ruble', 'rouble', 'rub', 'won', 'krw', 'bitcoin', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'toggle-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'turkish-lira', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'institution', 'bank', 'university', 'mortar-board', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'automobile', 'car', 'cab', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-photo-o', 'file-picture-o', 'file-image-o', 'file-zip-o', 'file-archive-o', 'file-sound-o', 'file-audio-o', 'file-movie-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-bouy', 'life-buoy', 'life-saver', 'support', 'life-ring', 'circle-o-notch', 'ra', 'rebel', 'ge', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'wechat', 'weixin', 'send', 'paper-plane', 'send-o', 'paper-plane-o', 'history', 'genderless', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'soccer-ball-o', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'shekel', 'sheqel', 'ils', 'meanpath', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'hotel', 'bed', 'viacoin', 'train', 'subway', 'medium');
            $icon_wolverine = array('icon-outline-vector-icons-pack-1','icon-outline-vector-icons-pack-2','icon-outline-vector-icons-pack-3','icon-outline-vector-icons-pack-4','icon-outline-vector-icons-pack-5','icon-outline-vector-icons-pack-6','icon-outline-vector-icons-pack-7','icon-outline-vector-icons-pack-14','icon-outline-vector-icons-pack-15','icon-outline-vector-icons-pack-16','icon-outline-vector-icons-pack-17','icon-outline-vector-icons-pack-18','icon-outline-vector-icons-pack-19','icon-outline-vector-icons-pack-20','icon-outline-vector-icons-pack-27','icon-outline-vector-icons-pack-28','icon-outline-vector-icons-pack-29','icon-outline-vector-icons-pack-30','icon-outline-vector-icons-pack-31','icon-outline-vector-icons-pack-32','icon-outline-vector-icons-pack-33','icon-outline-vector-icons-pack-40','icon-outline-vector-icons-pack-41','icon-outline-vector-icons-pack-42','icon-outline-vector-icons-pack-43','icon-outline-vector-icons-pack-44','icon-outline-vector-icons-pack-45','icon-outline-vector-icons-pack-46','icon-outline-vector-icons-pack-53','icon-outline-vector-icons-pack-54','icon-outline-vector-icons-pack-55','icon-outline-vector-icons-pack-56','icon-outline-vector-icons-pack-57','icon-outline-vector-icons-pack-58','icon-outline-vector-icons-pack-59','icon-outline-vector-icons-pack-66','icon-outline-vector-icons-pack-67','icon-outline-vector-icons-pack-68','icon-outline-vector-icons-pack-69','icon-outline-vector-icons-pack-70','icon-outline-vector-icons-pack-71','icon-outline-vector-icons-pack-72','icon-outline-vector-icons-pack-79','icon-outline-vector-icons-pack-80','icon-outline-vector-icons-pack-81','icon-outline-vector-icons-pack-82','icon-outline-vector-icons-pack-83','icon-outline-vector-icons-pack-84','icon-outline-vector-icons-pack-85','icon-outline-vector-icons-pack-92','icon-outline-vector-icons-pack-93','icon-outline-vector-icons-pack-94','icon-outline-vector-icons-pack-95','icon-outline-vector-icons-pack-96','icon-outline-vector-icons-pack-97','icon-outline-vector-icons-pack-98','icon-outline-vector-icons-pack-105','icon-outline-vector-icons-pack-106','icon-outline-vector-icons-pack-107','icon-outline-vector-icons-pack-108','icon-outline-vector-icons-pack-109','icon-outline-vector-icons-pack-110','icon-outline-vector-icons-pack-111','icon-outline-vector-icons-pack-118','icon-outline-vector-icons-pack-119','icon-outline-vector-icons-pack-120','icon-outline-vector-icons-pack-121','icon-outline-vector-icons-pack-122','icon-outline-vector-icons-pack-123','icon-outline-vector-icons-pack-124','icon-outline-vector-icons-pack-131','icon-outline-vector-icons-pack-132','icon-outline-vector-icons-pack-133','icon-outline-vector-icons-pack-134','icon-outline-vector-icons-pack-135','icon-outline-vector-icons-pack-136','icon-outline-vector-icons-pack-137','icon-outline-vector-icons-pack-144','icon-outline-vector-icons-pack-145','icon-outline-vector-icons-pack-146','icon-outline-vector-icons-pack-147','icon-outline-vector-icons-pack-148','icon-outline-vector-icons-pack-149','icon-outline-vector-icons-pack-150','icon-outline-vector-icons-pack-157','icon-outline-vector-icons-pack-158','icon-outline-vector-icons-pack-159','icon-outline-vector-icons-pack-160','icon-outline-vector-icons-pack-161','icon-outline-vector-icons-pack-162','icon-outline-vector-icons-pack-163','icon-outline-vector-icons-pack-8','icon-outline-vector-icons-pack-9','icon-outline-vector-icons-pack-10','icon-outline-vector-icons-pack-11','icon-outline-vector-icons-pack-12','icon-outline-vector-icons-pack-13','icon-outline-vector-icons-pack-21','icon-outline-vector-icons-pack-22','icon-outline-vector-icons-pack-23','icon-outline-vector-icons-pack-24','icon-outline-vector-icons-pack-25','icon-outline-vector-icons-pack-26','icon-outline-vector-icons-pack-34','icon-outline-vector-icons-pack-35','icon-outline-vector-icons-pack-36','icon-outline-vector-icons-pack-37','icon-outline-vector-icons-pack-38','icon-outline-vector-icons-pack-39','icon-outline-vector-icons-pack-47','icon-outline-vector-icons-pack-48','icon-outline-vector-icons-pack-49','icon-outline-vector-icons-pack-50','icon-outline-vector-icons-pack-51','icon-outline-vector-icons-pack-52','icon-outline-vector-icons-pack-60','icon-outline-vector-icons-pack-61','icon-outline-vector-icons-pack-62','icon-outline-vector-icons-pack-63','icon-outline-vector-icons-pack-64','icon-outline-vector-icons-pack-65','icon-outline-vector-icons-pack-73','icon-outline-vector-icons-pack-74','icon-outline-vector-icons-pack-75','icon-outline-vector-icons-pack-76','icon-outline-vector-icons-pack-77','icon-outline-vector-icons-pack-78','icon-outline-vector-icons-pack-86','icon-outline-vector-icons-pack-87','icon-outline-vector-icons-pack-88','icon-outline-vector-icons-pack-89','icon-outline-vector-icons-pack-90','icon-outline-vector-icons-pack-91','icon-outline-vector-icons-pack-99','icon-outline-vector-icons-pack-100','icon-outline-vector-icons-pack-101','icon-outline-vector-icons-pack-102','icon-outline-vector-icons-pack-103','icon-outline-vector-icons-pack-104','icon-outline-vector-icons-pack-112','icon-outline-vector-icons-pack-113','icon-outline-vector-icons-pack-114','icon-outline-vector-icons-pack-115','icon-outline-vector-icons-pack-116','icon-outline-vector-icons-pack-117','icon-outline-vector-icons-pack-125','icon-outline-vector-icons-pack-126','icon-outline-vector-icons-pack-127','icon-outline-vector-icons-pack-128','icon-outline-vector-icons-pack-129','icon-outline-vector-icons-pack-130','icon-outline-vector-icons-pack-138','icon-outline-vector-icons-pack-139','icon-outline-vector-icons-pack-140','icon-outline-vector-icons-pack-141','icon-outline-vector-icons-pack-142','icon-outline-vector-icons-pack-143','icon-outline-vector-icons-pack-151','icon-outline-vector-icons-pack-152','icon-outline-vector-icons-pack-153','icon-outline-vector-icons-pack-154','icon-outline-vector-icons-pack-155','icon-outline-vector-icons-pack-156','icon-outline-vector-icons-pack-164','icon-outline-vector-icons-pack-165','icon-outline-vector-icons-pack-166','icon-outline-vector-icons-pack-167','icon-outline-vector-icons-pack-168','icon-indians-icons-02','icon-indians-icons-03','icon-indians-icons-04','icon-indians-icons-05','icon-indians-icons-06','icon-indians-icons-07','icon-indians-icons-08','icon-indians-icons-09','icon-wolverine-logo-01','icon-wolverine-logo-02','icon-wolverine-logo-03','icon-wolverine-logo-04','icon-wolverine-logo-05','icon-wolverine-logo-06','icon-wolverine-logo-08','icon-wolverine-logo-09','icon-wolverine-logo-10','icon-address','icon-adjust','icon-air','icon-alert','icon-archive','icon-arrow-combo','icon-arrows-ccw','icon-attach','icon-attention','icon-back','icon-back-in-time','icon-bag','icon-basket','icon-battery','icon-behance','icon-bell','icon-block','icon-book','icon-book-open','icon-bookmark','icon-bookmarks','icon-box','icon-briefcase','icon-brush','icon-bucket','icon-calendar','icon-camera','icon-cancel','icon-cancel-circled','icon-cancel-squared','icon-cc','icon-cc-by','icon-cc-nc','icon-cc-nc-eu','icon-cc-nc-jp','icon-cc-nd','icon-cc-pd','icon-cc-remix','icon-cc-sa','icon-cc-share','icon-cc-zero','icon-ccw','icon-cd','icon-chart-area','icon-chart-bar','icon-chart-line','icon-chart-pie','icon-chat','icon-check','icon-clipboard','icon-clock','icon-cloud','icon-cloud-thunder','icon-code','icon-cog','icon-comment','icon-compass','icon-credit-card','icon-cup','icon-cw','icon-database','icon-db-shape','icon-direction','icon-doc','icon-doc-landscape','icon-doc-text','icon-doc-text-inv','icon-docs','icon-dot','icon-dot-2','icon-dot-3','icon-down','icon-down-bold','icon-down-circled','icon-down-dir','icon-down-open','icon-down-open-big','icon-down-open-mini','icon-down-thin','icon-download','icon-dribbble','icon-dribbble-circled','icon-drive','icon-dropbox','icon-droplet','icon-erase','icon-evernote','icon-export','icon-eye','icon-facebook','icon-facebook-circled','icon-facebook-squared','icon-fast-backward','icon-fast-forward','icon-feather','icon-flag','icon-flash','icon-flashlight','icon-flattr','icon-flickr','icon-flickr-circled','icon-flight','icon-floppy','icon-flow-branch','icon-flow-cascade','icon-flow-line','icon-flow-parallel','icon-flow-tree','icon-folder','icon-forward','icon-gauge','icon-github','icon-github-circled','icon-globe','icon-google-circles','icon-gplus','icon-gplus-circled','icon-graduation-cap','icon-heart','icon-heart-empty','icon-help','icon-help-circled','icon-home','icon-hourglass','icon-inbox','icon-infinity','icon-info','icon-info-circled','icon-instagrem','icon-install','icon-key','icon-keyboard','icon-lamp','icon-language','icon-lastfm','icon-lastfm-circled','icon-layout','icon-leaf','icon-left','icon-left-bold','icon-left-circled','icon-left-dir','icon-left-open','icon-left-open-big','icon-left-open-mini','icon-left-thin','icon-level-down','icon-level-up','icon-lifebuoy','icon-light-down','icon-light-up','icon-link','icon-linkedin','icon-linkedin-circled','icon-list','icon-list-add','icon-location','icon-lock','icon-lock-open','icon-login','icon-logo-db','icon-logout','icon-loop','icon-magnet','icon-mail','icon-map','icon-megaphone','icon-menu','icon-mic','icon-minus','icon-minus-circled','icon-minus-squared','icon-mixi','icon-mobile','icon-monitor','icon-moon','icon-mouse','icon-music','icon-mute','icon-network','icon-newspaper','icon-note','icon-note-beamed','icon-palette','icon-paper-plane','icon-pause','icon-paypal','icon-pencil','icon-phone','icon-picasa','icon-picture','icon-pinterest','icon-pinterest-circled','icon-play','icon-plus','icon-plus-circled','icon-plus-squared','icon-popup','icon-print','icon-progress-0','icon-progress-1','icon-progress-2','icon-progress-3','icon-publish','icon-qq','icon-quote','icon-rdio','icon-rdio-circled','icon-record','icon-renren','icon-reply','icon-reply-all','icon-resize-full','icon-resize-small','icon-retweet','icon-right','icon-right-bold','icon-right-circled','icon-right-dir','icon-right-open','icon-right-open-big','icon-right-open-mini','icon-right-thin','icon-rocket','icon-rss','icon-search','icon-share','icon-shareable','icon-shuffle','icon-signal','icon-sina-weibo','icon-skype','icon-skype-circled','icon-smashing','icon-sound','icon-soundcloud','icon-spotify','icon-spotify-circled','icon-star','icon-star-empty','icon-stop','icon-stumbleupon','icon-stumbleupon-circled','icon-suitcase','icon-sweden','icon-switch','icon-tag','icon-tape','icon-target','icon-thermometer','icon-thumbs-down','icon-thumbs-up','icon-ticket','icon-to-end','icon-to-start','icon-tools','icon-traffic-cone','icon-trash','icon-trophy','icon-tumblr','icon-tumblr-circled','icon-twitter','icon-twitter-circled','icon-up','icon-up-bold','icon-up-circled','icon-up-dir','icon-up-open','icon-up-open-big','icon-up-open-mini','icon-up-thin','icon-upload','icon-upload-cloud','icon-user','icon-user-add','icon-users','icon-vcard','icon-video','icon-vimeo','icon-vimeo-circled','icon-vkontakte','icon-volume','icon-water','icon-window','icon-wolverine-logo-07','icon-key21','icon-password1','icon-user14','icon-shopping111','icon-icon-search','icon-arrow413','icon-arrow427','icon-wrong6','icon-icon-opened29','icon-icon-opened29-1','icon-dark37','icon-dark37-1','icon-list23','icon-menu27','icon-menu45','icon-menu53','icon-menu55','icon-list23-1','icon-wrong6-1','icon-previous11','icon-thin36','icon-thin35','icon-up77','icon-right106','icon-next15','icon-collapse3','icon-expand22','icon-play43','icon-search-icon','icon-cart-icon','icon-minus-1','icon-plus-1','icon-185100-caddie-shop-shopping-streamline','icon-185101-caddie-shopping-streamline','icon-ecommerce-bag','icon-ecommerce-bag-check','icon-ecommerce-bag-cloud','icon-ecommerce-bag-download','icon-ecommerce-bag-minus','icon-ecommerce-bag-plus','icon-ecommerce-bag-refresh','icon-ecommerce-bag-remove','icon-ecommerce-bag-search','icon-ecommerce-bag-upload','icon-svg-icon-02','icon-svg-icon-03','icon-svg-icon-04','icon-svg-icon-05','icon-svg-icon-06','icon-svg-icon-07','icon-svg-icon-08','icon-svg-icon-09','icon-svg-icon-10','icon-svg-icon-11','icon-svg-icon-12','icon-svg-icon-13','icon-svg-icon-14','icon-svg-icon-15','icon-svg-icon-16','icon-svg-icon-17','icon-svg-icon-18');
			ob_start();
			?>
			<div id="g5plus-framework-popup-icon-wrapper">
				<div class="popup-icon-wrapper">
					<div class="popup-content">
						<div class="icon-search">
							<input placeholder="Search" type="text" id="txtSearch">

							<div class="preview">
								<span></span> <a id="iconPreview" href="javascript:;"><i class="fa fa-home"></i></a>
							</div>
							<div style="clear: both;"></div>
						</div>
						<div class="list-icon">
							<h3>Font Wolverine</h3>
							<ul id="group-1">
								<?php foreach ($icon_wolverine as $icon) {
									?>
									<li><a title="wicon <?php echo esc_attr($icon); ?>" href="javascript:;"><i class="wicon <?php echo esc_attr($icon); ?>"></i></a></li>
									<?php

								} ?>
							</ul>
							<br>

							<h3>Font Awesome</h3>
							<ul id="group-1">
								<?php foreach ($icons as $icon) {
									?>
									<li><a title="fa fa-<?php echo esc_attr($icon); ?>" href="javascript:;"><i
												class="fa fa-<?php echo esc_attr($icon); ?>"></i></a></li>
									<?php

								} ?>
							</ul>
						</div>
					</div>
					<div class="popup-bottom">
						<a id="btnSave" href="javascript:;" class="button button-primary">Insert Icon</a>
					</div>
				</div>
			</div>

			<?php
			die(); // this is required to return a proper result
		}


	}
}