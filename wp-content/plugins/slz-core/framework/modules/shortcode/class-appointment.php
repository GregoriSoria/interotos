<?php
class Medicplus_Core_Appointment extends Medicplus_Core_Custom_Post_Model {

	private $post_type = 'medicplus_appoint';
	private $post_taxonomy = 'medicplus_appoint_cat';
	private $html_format;

	public function __construct() {
		$this->meta_attributes();
		$this->set_meta_attributes();
		$this->post_meta_prefix = $this->post_type . '_';
		$this->taxonomy_cat = $this->post_taxonomy;
		$this->html_format = $this->set_default_options();
	}
	public function meta_attributes() {
		$meta_atts = array( 
			'status'          => esc_html__( 'Status', 'slz-core' ),
			'description'     => esc_html__( 'Description', 'slz-core' ),
			'fields'          => esc_html__( 'Fields', 'slz-core' ),
			'meta'            => esc_html__( 'Meta', 'slz-core' ),
		);

		$this->post_meta_atts = $meta_atts;
	}
	public function set_meta_attributes() {
		$meta_arr = array();
		$meta_label_arr = array();
		foreach( $this->post_meta_atts as $att => $name ){
			$key = $att;
			$meta_arr[$key] = '';
			$meta_label_arr[$key] = $name;
		}
		$this->post_meta_def = $meta_arr;
		$this->post_meta = $meta_arr;
		$this->post_meta_label = $meta_label_arr;
	}
	public function init( $atts = array(), $query_args = array() ) {
		// set attributes
		$default_atts = array(
			'offset_post'  => '0',
			'limit_post'   => '-1',
			'sort_by'      => 'post__in',
			'post_id'      => '',
		);
		$atts = array_merge( $default_atts, $atts );
		$this->attributes = $atts;

		// query
		$default_args = array(
			'post_type' => $this->post_type,
		);
		$query_args = array_merge( $default_args, $query_args );
		// setting
		$this->setting( $query_args);
	}
	public function setting( $query_args ){
		if( !isset( $this->attributes['uniq_id'] ) ) {
			$this->attributes['uniq_id'] = $this->post_type . '-' .Medicplus_Core::make_id();
		}
		// query
		$this->query = $this->get_query( $query_args, $this->attributes );
		$this->post_count = 0;
		if( $this->query->have_posts() ) {
			$this->post_count = $this->query->post_count;
		}
	}
	public function reset(){
		wp_reset_postdata();
	}

	//------------------- Post Infomations >> -------------------

	public function set_default_options( $html_options = array() ) {
		$defaults = array(
		);
		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}
	private function get_thumb_size() {
		$params = Medicplus_Core_Params::get( 'block-image-size', 'appointment' );
		$this->attributes['thumb-size'] = Medicplus_Core_Util::get_thumb_size( $params, $this->attributes );
	}
}