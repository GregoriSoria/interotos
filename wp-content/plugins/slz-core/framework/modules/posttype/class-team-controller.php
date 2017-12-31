<?php
/**
 * Team Controller
 * 
 * @since 1.0
 */

Medicplus_Core::load_class( 'Abstract' );

class Medicplus_Core_Team_Controller extends Medicplus_Core_Abstract {

	public function save() {
		global $post;
		$post_id = $post->ID;
		parent::save();
		if( isset( $_POST['medicplus_team_meta']) ) {
			$data_meta = $_POST['medicplus_team_meta'];
			foreach( $data_meta as $key => $value ) {
				update_post_meta ( $post_id, $key, $value );
			}
		}
		do_action( SLZCORE_THEME_PREFIX .'_save_page', $post_id );
	}

	public function metabox_team_options() {
		global $post;
		$post_id = $post->ID;
		$obj_prop = new Medicplus_Core_Team();
		$obj_prop->loop_index();
		$data_meta = $obj_prop->post_meta;
		$this->render( 'team', array( 'data_meta' => $data_meta ) );
	}
}