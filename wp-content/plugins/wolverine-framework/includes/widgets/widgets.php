<?php
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/g5plus-widget.php' );
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/social-profile-widget.php' );
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/footer-logo-widget.php' );
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/recent-projects-widget.php' );
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/posts.php' );
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/twitter.php' );
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/banner.php' );
include_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/widgets/about.php' );

if (!function_exists('g5plus_get_social_icon')) {
	function g5plus_get_social_icon($icons,$class = '') {
		$twitter = g5plus_framework_get_option('twitter_url');

		$facebook = g5plus_framework_get_option('facebook_url');

		$dribbble = g5plus_framework_get_option('dribbble_url');

		$vimeo = g5plus_framework_get_option('vimeo_url');

		$tumblr = g5plus_framework_get_option('tumblr_url');

		$skype = g5plus_framework_get_option('skype_username');

		$linkedin = g5plus_framework_get_option('linkedin_url');

		$flickr = g5plus_framework_get_option('flickr_url');

		$youtube = g5plus_framework_get_option('youtube_url');

		$pinterest = g5plus_framework_get_option('pinterest_url');

		$foursquare = g5plus_framework_get_option('foursquare_url');

		$instagram = g5plus_framework_get_option('instagram_url');

		$github = g5plus_framework_get_option('github_url');

		$xing = g5plus_framework_get_option('xing_url');

		$rss = g5plus_framework_get_option('rss_url');

		$behance = g5plus_framework_get_option('behance_url');

		$soundcloud = g5plus_framework_get_option('soundcloud_url');

		$deviantart = g5plus_framework_get_option('deviantart_url');

		$yelp = g5plus_framework_get_option('yelp_url');

		$email = g5plus_framework_get_option('email_address');

		$social_icons = '<ul class="'. $class .'">';

		if ( empty( $icons ) ) {
			if ( $twitter ) {
				$social_icons .= '<li><a title="'. esc_attr__('Twitter','wolverine') .'" href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i>'. esc_html__('Twitter','wolverine') .'</a></li>' . "\n";
			}
			if ( $facebook ) {
				$social_icons .= '<li><a title="'. esc_attr__('Facebook','wolverine') .'" href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i>'. esc_html__('Facebook','wolverine') .'</a></li>' . "\n";
			}
			if ( $dribbble ) {
				$social_icons .= '<li><a title="'. esc_attr__('Dribbble','wolverine') .'" href="' . esc_url( $dribbble ) . '" target="_blank"><i class="fa fa-dribbble"></i>'. esc_html__('Dribbble','wolverine') .'</a></li>' . "\n";
			}
			if ( $youtube ) {
				$social_icons .= '<li><a title="'. esc_attr__('Youtube','wolverine') .'" href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i>'. esc_html__('Youtube','wolverine') .'</a></li>' . "\n";
			}
			if ( $vimeo ) {
				$social_icons .= '<li><a title="'. esc_attr__('Vimeo','wolverine') .'" href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i>'. esc_html__('Vimeo','wolverine') .'</a></li>' . "\n";
			}
			if ( $tumblr ) {
				$social_icons .= '<li><a title="'. esc_attr__('Tumblr','wolverine') .'" href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i>'. esc_html__('Tumblr','wolverine') .'</a></li>' . "\n";
			}
			if ( $skype ) {
				$social_icons .= '<li><a title="'. esc_attr__('Skype','wolverine') .'" href="skype:' . esc_attr( $skype ) . '" target="_blank"><i class="fa fa-skype"></i>'. esc_html__('Skype','wolverine') .'</a></li>' . "\n";
			}
			if ( $linkedin ) {
				$social_icons .= '<li><a title="'. esc_attr__('Linkedin','wolverine') .'" href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i>'. esc_html__('Linkedin','wolverine') .'</a></li>' . "\n";
			}

			if ( $flickr ) {
				$social_icons .= '<li><a title="'. esc_attr__('Flickr','wolverine') .'" href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i>'. esc_html__('Flickr','wolverine') .'</a></li>' . "\n";
			}
			if ( $pinterest ) {
				$social_icons .= '<li><a title="'. esc_attr__('Pinterest','wolverine') .'" href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i>'. esc_html__('Pinterest','wolverine') .'</a></li>' . "\n";
			}
			if ( $foursquare ) {
				$social_icons .= '<li><a title="'. esc_attr__('Foursquare','wolverine') .'" href="' . esc_url( $foursquare ) . '" target="_blank"><i class="fa fa-foursquare"></i>'. esc_html__('Foursquare','wolverine') .'</a></li>' . "\n";
			}
			if ( $instagram ) {
				$social_icons .= '<li><a title="'. esc_attr__('Instagram','wolverine') .'" href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i>'. esc_html__('Instagram','wolverine') .'</a></li>' . "\n";
			}
			if ( $github ) {
				$social_icons .= '<li><a title="'. esc_attr__('GitHub','wolverine') .'" href="' . esc_url( $github ) . '" target="_blank"><i class="fa fa-github"></i>'. esc_html__('GitHub','wolverine') .'</a></li>' . "\n";
			}
			if ( $xing ) {
				$social_icons .= '<li><a title="'. esc_attr__('Xing','wolverine') .'" href="' . esc_url( $xing ) . '" target="_blank"><i class="fa fa-xing"></i>'. esc_html__('Xing','wolverine') .'</a></li>' . "\n";
			}
			if ( $behance ) {
				$social_icons .= '<li><a title="'. esc_attr__('Behance','wolverine') .'" href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i>'. esc_html__('Behance','wolverine') .'</a></li>' . "\n";
			}
			if ( $deviantart ) {
				$social_icons .= '<li><a title="'. esc_attr__('Deviantart','wolverine') .'" href="' . esc_url( $deviantart ) . '" target="_blank"><i class="fa fa-deviantart"></i>'. esc_html__('Deviantart','wolverine') .'</a></li>' . "\n";
			}
			if ( $soundcloud ) {
				$social_icons .= '<li><a title="'. esc_attr__('SoundCloud','wolverine') .'" href="' . esc_url( $soundcloud ) . '" target="_blank"><i class="fa fa-soundcloud"></i>'. esc_html__('SoundCloud','wolverine') .'</a></li>' . "\n";
			}
			if ( $yelp ) {
				$social_icons .= '<li><a title="'. esc_attr__('Yelp','wolverine') .'" href="' . esc_url( $yelp ) . '" target="_blank"><i class="fa fa-yelp"></i>'. esc_html__('Yelp','wolverine') .'</a></li>' . "\n";
			}
			if ( $rss ) {
				$social_icons .= '<li><a title="'. esc_attr__('rss','wolverine') .'" href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i>'. esc_html__('rss','wolverine') .'</a></li>' . "\n";
			}
			if ( $email ) {
				$social_icons .= '<li><a title="'. esc_attr__('Email','wolverine') .'" href="mailto:' . esc_attr( $email ) . '" target="_blank"><i class="fa fa-vk"></i>'. esc_html__('Email','wolverine') .'</a></li>' . "\n";
			}
		} else {

			$social_type = explode( '||', $icons );
			if (empty($twitter)) { $twitter = '#'; }
			if (empty($facebook)) { $facebook = '#'; }
			if (empty($dribbble)) { $dribbble = '#'; }
			if (empty($youtube)) { $youtube = '#'; }
			if (empty($vimeo)) { $vimeo = '#'; }
			if (empty($tumblr)) { $tumblr = '#'; }
			if (empty($skype)) { $skype = '#'; }
			if (empty($linkedin)) { $linkedin = '#'; }
			if (empty($flickr)) { $flickr = '#'; }
			if (empty($pinterest)) { $pinterest = '#'; }
			if (empty($foursquare)) { $foursquare = '#'; }
			if (empty($instagram)) { $instagram = '#'; }
			if (empty($github)) { $github = '#'; }
			if (empty($xing)) { $xing = '#'; }
			if (empty($behance)) { $behance = '#'; }
			if (empty($deviantart)) { $deviantart = '#'; }
			if (empty($soundcloud)) { $soundcloud = '#'; }
			if (empty($yelp)) { $yelp = '#'; }
			if (empty($rss)) { $rss = '#'; }
			if (empty($email)) { $email = '#'; }

			foreach ( $social_type as $id ) {
				if ( ( $id == 'twitter' ) && $twitter ) {
					$social_icons .= '<li><a title="'. esc_attr__('Twitter','wolverine') .'" href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i>'. esc_html__('Twitter','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'facebook' ) && $facebook ) {
					$social_icons .= '<li><a title="'. esc_attr__('Facebook','wolverine') .'" href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i>'. esc_html__('Facebook','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'dribbble' ) && $dribbble ) {
					$social_icons .= '<li><a title="'. esc_attr__('Dribbble','wolverine') .'" href="' . esc_url( $dribbble ) . '" target="_blank"><i class="fa fa-dribbble"></i>'. esc_html__('Dribbble','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'youtube' ) && $youtube ) {
					$social_icons .= '<li><a title="'. esc_attr__('Youtube','wolverine') .'" href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i>'. esc_html__('Youtube','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'vimeo' ) && $vimeo ) {
					$social_icons .= '<li><a title="'. esc_attr__('Vimeo','wolverine') .'" href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i>'. esc_html__('Vimeo','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'tumblr' ) && $tumblr ) {
					$social_icons .= '<li><a title="'. esc_attr__('Tumblr','wolverine') .'" href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i>'. esc_html__('Tumblr','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'skype' ) && $skype ) {
					$social_icons .= '<li><a title="'. esc_attr__('Skype','wolverine') .'" href="skype:' . esc_attr( $skype ) . '" target="_blank"><i class="fa fa-skype"></i>'. esc_html__('Skype','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'linkedin' ) && $linkedin ) {
					$social_icons .= '<li><a title="'. esc_attr__('Linkedin','wolverine') .'" href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i>'. esc_html__('Linkedin','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'flickr' ) && $flickr ) {
					$social_icons .= '<li><a title="'. esc_attr__('Flickr','wolverine') .'" href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i>'. esc_html__('Flickr','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'pinterest' ) && $pinterest ) {
					$social_icons .= '<li><a title="'. esc_attr__('Pinterest','wolverine') .'" href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i>'. esc_html__('Pinterest','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'foursquare' ) && $foursquare ) {
					$social_icons .= '<li><a title="'. esc_attr__('Foursquare','wolverine') .'" href="' . esc_url( $foursquare ) . '" target="_blank"><i class="fa fa-foursquare"></i>'. esc_html__('Foursquare','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'instagram' ) && $instagram ) {
					$social_icons .= '<li><a title="'. esc_attr__('Instagram','wolverine') .'" href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i>'. esc_html__('Instagram','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'github' ) && $github ) {
					$social_icons .= '<li><a title="'. esc_attr__('GitHub','wolverine') .'" href="' . esc_url( $github ) . '" target="_blank"><i class="fa fa-github"></i>'. esc_html__('GitHub','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'xing' ) && $xing ) {
					$social_icons .= '<li><a title="'. esc_attr__('Xing','wolverine') .'" href="' . esc_url( $xing ) . '" target="_blank"><i class="fa fa-xing"></i>'. esc_html__('Xing','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'behance' ) && $behance ) {
					$social_icons .= '<li><a title="'. esc_attr__('Behance','wolverine') .'" href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i>'. esc_html__('Behance','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'deviantart' ) && $deviantart ) {
					$social_icons .= '<li><a title="'. esc_attr__('Deviantart','wolverine') .'" href="' . esc_url( $deviantart ) . '" target="_blank"><i class="fa fa-deviantart"></i>'. esc_html__('Deviantart','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'soundcloud' ) && $soundcloud ) {
					$social_icons .= '<li><a title="'. esc_attr__('SoundCloud','wolverine') .'" href="' . esc_url( $soundcloud ) . '" target="_blank"><i class="fa fa-soundcloud"></i>'. esc_html__('SoundCloud','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'yelp' ) && $yelp ) {
					$social_icons .= '<li><a title="'. esc_attr__('Yelp','wolverine') .'" href="' . esc_url( $yelp ) . '" target="_blank"><i class="fa fa-yelp"></i>'. esc_html__('Yelp','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'rss' ) && $rss ) {
					$social_icons .= '<li><a title="'. esc_attr__('Rss','wolverine') .'" href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i>'. esc_html__('Rss','wolverine') .'</a></li>' . "\n";
				}
				if ( ( $id == 'email' ) && $email ) {
					$social_icons .= '<li><a title="'. esc_attr__('Email','wolverine') .'" href="mailto:' . esc_attr( $email ) . '" target="_blank"><i class="fa fa-vk"></i>'. esc_html__('Email','wolverine') .'</a></li>' . "\n";
				}
			}
		}

		$social_icons .= '</ul>';

		return $social_icons;
	}
}
