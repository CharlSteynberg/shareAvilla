<?php

/**
 *  Resizes an image and returns an array containing the resized URL, width, height and file type. Uses native WordPress functionality.
 *
 *  Because WordPress 3.5 has added the new 'WP_Image_Editor' class and depreciated some of the functions
 *  we would normally rely on (such as wp_load_image), a separate function has been created for 3.5+.
 *
 *  Providing two separate functions means we can be backwards compatible and future proof. Hooray!
 *  
 *  The first function (3.5+) supports GD Library and Imagemagick. Worpress will pick whichever is most appropriate.
 *  The second function (3.4.2 and lower) only support GD Library.
 *  If none of the supported libraries are available the function will bail and return the original image.
 *
 *  Both functions produce the exact same results when successful.
 *  Images are saved to the WordPress uploads directory, just like images uploaded through the Media Library.
 * 
	*  Copyright 2013 Matthew Ruddy (http://easinglider.com)
	*  
	*  This program is free software; you can redistribute it and/or modify
	*  it under the terms of the GNU General Public License, version 2, as 
	*  published by the Free Software Foundation.
	* 
	*  This program is distributed in the hope that it will be useful,
	*  but WITHOUT ANY WARRANTY; without even the implied warranty of
	*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	*  GNU General Public License for more details.
	*  
	*  You should have received a copy of the GNU General Public License
	*  along with this program; if not, write to the Free Software
	*  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 *  @author Matthew Ruddy (http://easinglider.com)
 *  @return array   An array containing the resized image URL, width, height and file type.
 */
function matthewruddy_image_resize_id($images_id, $width = NULL, $height = NULL, $crop = true, $retina = false) {
	$width      = intval( $width !== '' ? $width : get_option( 'thumbnail_size_w' ) );
	$height     = intval( $height !== '' ? $height : get_option( 'thumbnail_size_h' ) );
	$retina     = ( $retina === true ) ? 2 : 1;
	$orig_image = wp_get_attachment_image_src( $images_id, 'full' );

	if ( $orig_image === false ) {
		//return array( 'url' => '', 'width' => $width, 'height' => $height );
		return '';
	}

	$url         = $orig_image[0];
	$orig_width  = $orig_image[1];
	$orig_height = $orig_image[2];
	$file_path   = get_attached_file( $images_id );

	// Check for Multisite
	if ( is_multisite() ) {
		global $blog_id;
		if ($blog_id != 1) {
			$file_path = str_replace("/wp-content/uploads/sites/{$blog_id}/sites/{$blog_id}/", "/wp-content/uploads/sites/{$blog_id}/", $file_path);
		}
	}


	// Some additional info about the image.
	$info = pathinfo( $file_path );
	$dir  = $info['dirname'];
	$ext  = '';
	if ( ! empty( $info['extension'] ) ) {
		$ext = $info['extension'];
	}

	if ( $height === 0 ) {
		$height = round( ( $orig_height / $orig_width ) * $width );
		if ($width >= $orig_width) {
			return $url;
			/*return array(
				'url'    => $url,
				'width'  => $orig_width,
				'height' => $orig_height,
				'type'   => $ext,
				'path'   => $file_path
			);*/
		}
	}

	// Destination width and height variables
	$dest_width  = $width * $retina;
	$dest_height = $height * $retina;

	$name = wp_basename( $file_path, ".$ext" );

	// Suffix applied to filename.
	$suffix_retina = ( 1 != $retina ) ? '@' . $retina . 'x' : null;
	$suffix        = "{$width}x{$height}{$suffix_retina}";
	// Get the destination file name.
	$dest_file_name = "{$dir}/{$name}-{$suffix}.{$ext}";

	if ( ! file_exists( $dest_file_name ) ) {
		// Load Wordpress Image Editor.
		$editor = wp_get_image_editor( $file_path );
		if ( is_wp_error( $editor ) ) {
			//return array( 'url' => $url, 'width' => $width, 'height' => $height );
			return $url;
		}
		$src_x = $src_y = 0;
		$src_w = $orig_width;
		$src_h = $orig_height;
		if ( $crop ) {
			$cmp_x = $orig_width / $dest_width;
			$cmp_y = $orig_height / $dest_height;
			// Calculate x or y coordinate, and width or height of source.
			if ( $cmp_x > $cmp_y ) {
				$src_w = round( $orig_width / $cmp_x * $cmp_y );
				$src_x = round( ( $orig_width - ( $orig_width / $cmp_x * $cmp_y ) ) / 2 );
			} elseif ( $cmp_y > $cmp_x ) {
				$src_h = round( $orig_height / $cmp_y * $cmp_x );
				$src_y = round( ( $orig_height - ( $orig_height / $cmp_y * $cmp_x ) ) / 2 );
			}
		}

		// Check if the file is writable before proceeding.
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}
		if ( ! $wp_filesystem->put_contents( $dest_file_name, '', FS_CHMOD_FILE ) ) {
			//return array( 'url' => $url, 'width' => $orig_width, 'height' => $orig_height );
			return $url;
		}

		// Time to crop the image!
		$editor->crop( $src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height );
		// Now let's save the image.
		$saved = $editor->save( $dest_file_name );
		// If saving fails, return the original image.
		if ( is_wp_error( $saved ) ) {
			//return array( 'url' => $url, 'width' => $width, 'height' => $height );
			return $url;
		}

		// Get resized image information.
		$resized_url    = str_replace( basename( $url ), basename( $saved['path'] ), $url );
		$resized_width  = $saved['width'];
		$resized_height = $saved['height'];
		$resized_type   = $saved['mime-type'];
		// Add the resized dimensions to original image metadata (so we can delete our resized images when the original image is delete from the Media Library).
		$metadata = wp_get_attachment_metadata( $images_id );
		if ( isset( $metadata['image_meta'] ) ) {
			//$metadata['image_meta']['resized_images'][] = $resized_width . 'x' . $resized_height;
			$metadata['image_meta']['resized_images'][] = "{$name}-{$suffix}.{$ext}";
			wp_update_attachment_metadata( $images_id, $metadata );
		}
		$image_array = array(
			'url'    => $resized_url,
			'width'  => $resized_width,
			'height' => $resized_height,
			'type'   => $resized_type,
			'path'   => $dest_file_name,
		);
	} else {
		$image_array = array(
			'url'    => str_replace( wp_basename( $url ), wp_basename( $dest_file_name ), $url ),
			'width'  => $dest_width,
			'height' => $dest_height,
			'type'   => $ext,
			'path'   => $dest_file_name
		);
	}

	//$retina_url                = file_exists( "{$dir}/{$name}-{$suffix}{$suffix_retina}.{$ext}" ) ? rtrim( $image_array['url'], ".{$ext}" ) . "@2x.{$ext}" : false;
	//$image_array['retina_url'] = $retina_url;

	return $image_array['url'];


}

/**
 *  Deletes the resized images when the original image is deleted from the WordPress Media Library.
 *
 *  @author Matthew Ruddy
 */
add_action( 'delete_attachment', 'matthewruddy_delete_resized_images' );
function matthewruddy_delete_resized_images( $post_id ) {

	// Get attachment image metadata
	$metadata = wp_get_attachment_metadata( $post_id );
	if ( !$metadata )
		return;

	// Do some bailing if we cannot continue
	if ( !isset( $metadata['file'] ) || !isset( $metadata['image_meta']['resized_images'] ) )
		return;
	$pathinfo = pathinfo( $metadata['file'] );
	$resized_images = $metadata['image_meta']['resized_images'];

	// Get WordPress uploads directory (and bail if it doesn't exist)
	$wp_upload_dir = wp_upload_dir();
	$upload_dir = $wp_upload_dir['basedir'];
	if ( !is_dir( $upload_dir ) )
		return;

	// Delete the resized images
	foreach ( $resized_images as $dims ) {

		// Get the resized images filename
		$file = $upload_dir .'/'. $pathinfo['dirname'] .'/'. $pathinfo['filename'] .'-'. $dims .'.'. $pathinfo['extension'];

		// Delete the resized image
		@unlink( $file );

	}

}
