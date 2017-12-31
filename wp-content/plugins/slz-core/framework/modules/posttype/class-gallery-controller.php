<?php

/**
 * Gallery Controller
 * 
 * @since 1.0
 */

Medicplus_Core::load_class( 'Abstract' );

class Medicplus_Core_Gallery_Controller extends Medicplus_Core_Abstract {

	public function save() {
		global $post;
		$post_id = $post->ID;
		parent::save();
		if( isset( $_POST['medicplus_gallery_meta']) ) {
			$data_meta = $_POST['medicplus_gallery_meta'];
			foreach( $data_meta as $key => $value ) {
				
				update_post_meta ( $post_id, $key, $value );
			}
		}
	}

	public function metabox_gallery_options() {
		global $post;
		$post_id = $post->ID;
		$obj_prop = new Medicplus_Core_Gallery();
		$obj_prop->loop_index();
		$data_meta = $obj_prop->post_meta;
		$this->render( 'gallery', array( 'data_meta' => $data_meta ) );
	}
}