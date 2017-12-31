<?php
/**
 * Service Controller
 * 
 * @since 1.0
 */
Medicplus_Core::load_class( 'Abstract' );
class Medicplus_Core_Service_Controller extends Medicplus_Core_Abstract {
	public function save() {
		global $post;
		$post_id = $post->ID;
		parent::save();
		if( isset( $_POST['medicplus_service_meta']) ) {
			$data_meta = $_POST['medicplus_service_meta'];
			foreach( $data_meta as $key => $value ) {
				update_post_meta ( $post_id, $key, $value );
			}
		}
		do_action( SLZCORE_THEME_PREFIX .'_save_page', $post_id );
	}

	public function metabox_service_options() {
		global $post;
		$post_id = $post->ID;
		$obj_prop = new Medicplus_Core_Service();
		$obj_prop->loop_index();
		$data_meta = $obj_prop->post_meta;
		$this->render( 'service', array( 'data_meta' => $data_meta ) );
	}

}