<?php
/**
 * Top Controller.
 * 
 * @since 1.0
 */
Medicplus::load_class( 'Abstract' );

class Medicplus_Top_Controller extends Medicplus_Abstract {
	public function show_post_index(){
		$this->render( MEDICPLUS_THEME_DIR . '/index.php', array() );
	}
	public function header() {
		$this->render( 'header', array());
	}
	public function footer_main() {
		$this->render( 'footer', array());
	}
	public function footer_contact() {
		$this->render( 'footer-contact', array());
	}
	public function breadcrumb() {
		$this->render( 'breadcrumb', array());
	}
	public function show_post_entry_thumbnail( $args = array() ) {
		$this->render( 'entry-thumbnail', array ( 'args' => $args ) );
	}
	public function show_post_entry_meta( $args = array() ) {
		$posttags = get_the_tags();
		$category_list = get_the_category();
		$this->render( 'entry-meta', array (
			'args' => $args,
			'posttags' => $posttags,
			'category_list' => $category_list 
		) );
	}
	public function show_post_tags_meta( $args = array() ) {
		$posttags = get_the_tags();
		$this->render( 'tags-meta', array (
			'args' => $args,
			'posttags' => $posttags
		) );
	}
	public function show_post_category_meta( $args = array() ) {
		$postcats = get_the_category();
		$this->render( 'categories-meta', array (
			'args' => $args,
			'postcats' => $postcats
		) );
	}
	
	public function show_post_author() {	
		$author_id = get_the_author_meta( 'ID' );
		$this->render( 'author', array (
			'author_id' => $author_id
		) );
	}
	public function show_post_entry_video( $args = array() ) {
		if(class_exists('Medicplus_Core_Video_Model')){
			$post_id = get_the_ID();
			$post_options = get_post_meta( $post_id, 'medicplus_feature_video', true);
			$youtube_id = Medicplus::get_value( $post_options, 'youtube_id' );
			$vimeo_id = Medicplus::get_value( $post_options, 'vimeo_id' );
			$upload_video = Medicplus::get_value( $post_options, 'upload_video' );
			if(empty($youtube_id) && empty($vimeo_id) && empty($upload_video) ){
				do_action( 'medicplus_entry_thumbnail');
			}
			else{
				$video_model = new Medicplus_Core_Video_Model();
				$video_model->init();
				echo ( $video_model->get_video( $post_options['video_type'] , $youtube_id, $vimeo_id , $upload_video ) );
			}
		} else {
			do_action( 'medicplus_entry_thumbnail');
		}
	}
	public function show_page_title() {
		$this->render( 'page-title',array() );
	}
	public function show_slider() {
		$this->render( 'slider',array() );
	}
	// share post
	public function get_share_link() {
		$this->render( 'share_link', array());
	}
	public function show_login_link() {
		$this->render( 'login-link');
	}
	// show comments
	public function show_frm_comment() {
		$this->render( 'comments');
	}
	//show author list
	public function show_author_list() {
		$this->render( 'author_list');
	}
	public function show_help_link() {
		$this->render( 'help_link');
	}
}