<?php
/**
 * Controller Post.
 * 
 * @since 1.0
 */

Medicplus_Core::load_class( 'Abstract' );

class Medicplus_Core_Post_Controller extends Medicplus_Core_Abstract {

	public function metabox_feature_video() {
		global $post;
		$post_id = $post->ID;
		$post_meta = array();
		if( $post_id ) {
			$post_meta = get_post_meta( $post_id, SLZCORE_THEME_PREFIX . '_feature_video', true );
		}
		$this->render( 'feature-video', array(
			'post_meta' => $post_meta
		));
	}
}