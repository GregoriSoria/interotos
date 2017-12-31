<?php
if( ! function_exists( 'medicplus_core_post_pagination_link' ) ) :
	function medicplus_core_post_pagination_link($link)
	{
		$url =  preg_replace('!">$!','',_wp_link_page($link));
		$url =  preg_replace('!^<a href="!','',$url);
		return $url;
	}
endif;

if( ! function_exists( 'medicplus_core_get_pagenum_link' ) ) :
	function medicplus_core_get_pagenum_link( $pagenum = 1, $escape = true, $base = null) {
		global $wp_rewrite;
	
		$pagenum = (int) $pagenum;
	
		$request = $base ? remove_query_arg( 'paged', $base ) : remove_query_arg( 'paged' );
	
		$home_root = parse_url(home_url('/'));
		$home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
		$home_root = preg_quote( $home_root, '|' );
	
		$request = preg_replace('|^'. $home_root . '|i', '', $request);
		$request = preg_replace('|^/+|', '', $request);
	
		if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
			$base = trailingslashit( home_url('/') );
	
			if ( $pagenum > 1 ) {
				$result = add_query_arg( 'paged', $pagenum, $base . $request );
			} else {
				$result = $base . $request;
			}
		} else {
			$qs_regex = '|\?.*?$|';
			preg_match( $qs_regex, $request, $qs_match );
	
			if ( !empty( $qs_match[0] ) ) {
				$query_string = $qs_match[0];
				$request = preg_replace( $qs_regex, '', $request );
			} else {
				$query_string = '';
			}
	
			$request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
			$request = preg_replace( '|^' . preg_quote( $wp_rewrite->index, '|' ) . '|i', '', $request);
			$request = ltrim($request, '/');
	
			$base = trailingslashit( home_url('/') );
	
			if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
				$base .= $wp_rewrite->index . '/';
	
			if ( $pagenum > 1 ) {
				$request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
			}
	
			$result = $base . $request . $query_string;
		}
	
		/**
		 * Filter the page number link for the current request.
		 *
		 * @since 2.5.0
		 *
		 * @param string $result The page number link.
		 */
		$result = apply_filters( 'get_pagenum_link', $result );
	
		if ( $escape )
			return esc_url( $result );
		else
			return esc_url_raw( $result );
	}
endif;

// upload images
add_action( 'wp_ajax_medicplus_core_image_upload', 'medicplus_core_image_upload' );
if( ! function_exists( 'medicplus_core_image_upload' ) ) :
	function medicplus_core_image_upload()
	{
		$submitted_file = $_FILES['medicplus_core_upload_file'];
		$uploaded_image = wp_handle_upload( $submitted_file, array( 'test_form' => false ) );
		
		if ( isset( $uploaded_image['file'] ) ) {
			$file_name          =   basename( $submitted_file['name'] );
			$file_type          =   wp_check_filetype( $uploaded_image['file'] );
			
			$attachment_details = array(
				'guid'           => $uploaded_image['url'],
				'post_mime_type' => $file_type['type'],
				'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);
	
			$attach_id      =   wp_insert_attachment( $attachment_details, $uploaded_image['file'] );
			$attach_data    =   wp_generate_attachment_metadata( $attach_id, $uploaded_image['file'] );
			
			if( isset( $attach_data ) && !empty( $attach_data ) ) {
				// attachment is image
				wp_update_attachment_metadata( $attach_id, $attach_data );
				$thumbnail_url = medicplus_core_get_thumbnail_url( $attach_data );
			}
			else {
				// attachment is not image
				$image_src = wp_get_attachment_image_src($attach_id, 'thumbnail' , true);
				$thumbnail_url = $image_src[0];
			}
			$ajax_response = array(
				'success'   => true,
				'url' => $thumbnail_url,
				'attachment_id'    => $attach_id
			);
			echo json_encode( $ajax_response );
			die;
		}
		else {
			$ajax_response = array( 'success' => false, 'reason' => 'Image upload failed!' );
			echo json_encode( $ajax_response );
			die;
		}
	}
endif;

if( !function_exists( 'medicplus_core_get_thumbnail_url' ) ):
	function medicplus_core_get_thumbnail_url( $attach_data ){
		$upload_dir         =   wp_upload_dir();
		$image_path_array   =   explode( '/', $attach_data['file'] );
		$image_path_array   =   array_slice( $image_path_array, 0, count( $image_path_array ) - 1 );
		if( isset( $attach_data['sizes']['thumbnail'] ) ) {
			$image_path      =   implode( '/', $image_path_array );
			$image_path     .=   '/' . $attach_data['sizes']['thumbnail']['file'];
		}
		else {
			$image_path      =   $attach_data['file'];
		}
		return $upload_dir['baseurl'] . '/' . $image_path ;
	}
endif;

// remove image
add_action( 'wp_ajax_remove_upload_image', 'medicplus_core_remove_upload_image' );
if( !function_exists( 'medicplus_core_remove_upload_image' ) ):
	function medicplus_core_remove_upload_image() {
		$attachment_removed = false;
		if( isset( $_POST['attachment_id'] ) ) {
			$attachment_id = intval( $_POST['attachment_id'] );
			 if ( $attachment_id > 0 &&  wp_delete_attachment ( $attachment_id ) ) {
				$attachment_removed = true;
			}
		}
		$ajax_response = array(
			'attachment_removed' => $attachment_removed,
		);
		echo json_encode( $ajax_response );
		die;
	}
endif;

if( ! function_exists( 'medicplus_core_add_menu_page' ) ) :
	function medicplus_core_add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null)
	{
		add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
	}
endif;

if( ! function_exists( 'medicplus_core_add_submenu_page' ) ) :
	function medicplus_core_add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '')
	{
		add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	}
endif;