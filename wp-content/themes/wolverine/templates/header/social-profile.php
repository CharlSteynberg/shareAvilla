<?php
$prefix = 'g5plus_';

$header_social_profile = get_post_meta(get_the_ID(), $prefix . 'header_customize_social_profile', false);

if (($header_social_profile == array()) || ($header_social_profile == '')) {
	$header_social_profile = g5plus_get_option('header_customize_social_profile',array());
}

$twitter = g5plus_get_option('twitter_url');

$facebook = g5plus_get_option('facebook_url');

$dribbble = g5plus_get_option('dribbble_url');

$vimeo = g5plus_get_option('vimeo_url');

$tumblr = g5plus_get_option('tumblr_url');

$skype = g5plus_get_option('skype_username');

$linkedin = g5plus_get_option('linkedin_url');

$flickr = g5plus_get_option('flickr_url');

$youtube = g5plus_get_option('youtube_url');

$pinterest = g5plus_get_option('pinterest_url');

$foursquare = g5plus_get_option('foursquare_url');

$instagram = g5plus_get_option('instagram_url');

$github = g5plus_get_option('github_url');

$xing = g5plus_get_option('xing_url');

$rss = g5plus_get_option('rss_url');

$behance = g5plus_get_option('behance_url');

$soundcloud = g5plus_get_option('soundcloud_url');

$deviantart = g5plus_get_option('deviantart_url');

$yelp = g5plus_get_option('yelp_url');

$email = g5plus_get_option('email_address');

$social_icons = '';

if ( ($header_social_profile == array()) || (empty( $header_social_profile )) ) {
	if ( $twitter ) {
		$social_icons .= '<li><a href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' . "\n";
	}
	if ( $facebook ) {
		$social_icons .= '<li><a href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' . "\n";
	}
	if ( $dribbble ) {
		$social_icons .= '<li><a href="' . esc_url( $dribbble ) . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>' . "\n";
	}
	if ( $youtube ) {
		$social_icons .= '<li><a href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>' . "\n";
	}
	if ( $vimeo ) {
		$social_icons .= '<li><a href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>' . "\n";
	}
	if ( $tumblr ) {
		$social_icons .= '<li><a href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>' . "\n";
	}
	if ( $skype ) {
		$social_icons .= '<li><a href="skype:' . esc_attr( $skype ) . '" target="_blank"><i class="fa fa-skype"></i></a></li>' . "\n";
	}
	if ( $linkedin ) {
		$social_icons .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' . "\n";
	}

	if ( $flickr ) {
		$social_icons .= '<li><a href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>' . "\n";
	}
	if ( $pinterest ) {
		$social_icons .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>' . "\n";
	}
	if ( $foursquare ) {
		$social_icons .= '<li><a href="' . esc_url( $foursquare ) . '" target="_blank"><i class="fa fa-foursquare"></i></a></li>' . "\n";
	}
	if ( $instagram ) {
		$social_icons .= '<li><a href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>' . "\n";
	}
	if ( $github ) {
		$social_icons .= '<li><a href="' . esc_url( $github ) . '" target="_blank"><i class="fa fa-github"></i></a></li>' . "\n";
	}
	if ( $xing ) {
		$social_icons .= '<li><a href="' . esc_url( $xing ) . '" target="_blank"><i class="fa fa-xing"></i></a></li>' . "\n";
	}
	if ( $behance ) {
		$social_icons .= '<li><a href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i></a></li>' . "\n";
	}
	if ( $deviantart ) {
		$social_icons .= '<li><a href="' . esc_url( $deviantart ) . '" target="_blank"><i class="fa fa-deviantart"></i></a></li>' . "\n";
	}
	if ( $soundcloud ) {
		$social_icons .= '<li><a href="' . esc_url( $soundcloud ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>' . "\n";
	}
	if ( $yelp ) {
		$social_icons .= '<li><a href="' . esc_url( $yelp ) . '" target="_blank"><i class="fa fa-yelp"></i></a></li>' . "\n";
	}
	if ( $rss ) {
		$social_icons .= '<li><a href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i></a></li>' . "\n";
	}
	if ( $email ) {
		$social_icons .= '<li><a href="mailto:' . esc_attr( $email ) . '" target="_blank"><i class="fa fa-vk"></i></a></li>' . "\n";
	}
} else {
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

	foreach ( $header_social_profile as $id ) {
		if ( ( $id == 'twitter' ) && $twitter ) {
			$social_icons .= '<li><a href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' . "\n";
		}
		if ( ( $id == 'facebook' ) && $facebook ) {
			$social_icons .= '<li><a href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' . "\n";
		}
		if ( ( $id == 'dribbble' ) && $dribbble ) {
			$social_icons .= '<li><a href="' . esc_url( $dribbble ) . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>' . "\n";
		}
		if ( ( $id == 'youtube' ) && $youtube ) {
			$social_icons .= '<li><a href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>' . "\n";
		}
		if ( ( $id == 'vimeo' ) && $vimeo ) {
			$social_icons .= '<li><a href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>' . "\n";
		}
		if ( ( $id == 'tumblr' ) && $tumblr ) {
			$social_icons .= '<li><a href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>' . "\n";
		}
		if ( ( $id == 'skype' ) && $skype ) {
			$social_icons .= '<li><a href="skype:' . esc_attr( $skype ) . '" target="_blank"><i class="fa fa-skype"></i></a></li>' . "\n";
		}
		if ( ( $id == 'linkedin' ) && $linkedin ) {
			$social_icons .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' . "\n";
		}
		if ( ( $id == 'flickr' ) && $flickr ) {
			$social_icons .= '<li><a href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>' . "\n";
		}
		if ( ( $id == 'pinterest' ) && $pinterest ) {
			$social_icons .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>' . "\n";
		}
		if ( ( $id == 'foursquare' ) && $foursquare ) {
			$social_icons .= '<li><a href="' . esc_url( $foursquare ) . '" target="_blank"><i class="fa fa-foursquare"></i></a></li>' . "\n";
		}
		if ( ( $id == 'instagram' ) && $instagram ) {
			$social_icons .= '<li><a href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>' . "\n";
		}
		if ( ( $id == 'github' ) && $github ) {
			$social_icons .= '<li><a href="' . esc_url( $github ) . '" target="_blank"><i class="fa fa-github"></i></a></li>' . "\n";
		}
		if ( ( $id == 'xing' ) && $xing ) {
			$social_icons .= '<li><a href="' . esc_url( $xing ) . '" target="_blank"><i class="fa fa-xing"></i></a></li>' . "\n";
		}
		if ( ( $id == 'behance' ) && $behance ) {
			$social_icons .= '<li><a href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i></a></li>' . "\n";
		}
		if ( ( $id == 'deviantart' ) && $deviantart ) {
			$social_icons .= '<li><a href="' . esc_url( $deviantart ) . '" target="_blank"><i class="fa fa-deviantart"></i></a></li>' . "\n";
		}
		if ( ( $id == 'soundcloud' ) && $soundcloud ) {
			$social_icons .= '<li><a href="' . esc_url( $soundcloud ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>' . "\n";
		}
		if ( ( $id == 'yelp' ) && $yelp ) {
			$social_icons .= '<li><a href="' . esc_url( $yelp ) . '" target="_blank"><i class="fa fa-yelp"></i></a></li>' . "\n";
		}
		if ( ( $id == 'rss' ) && $rss ) {
			$social_icons .= '<li><a href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i></a></li>' . "\n";
		}
		if ( ( $id == 'email' ) && $email ) {
			$social_icons .= '<li><a href="mailto:' . esc_attr( $email ) . '" target="_blank"><i class="fa fa-vk"></i></a></li>' . "\n";
		}
	}
}
if (empty($social_icons)) {
	return;
}
?>
<ul class="header-customize-item header-social-profile-wrapper">
	<?php echo wp_kses_post( $social_icons ); ?>
</ul>