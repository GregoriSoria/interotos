<?php
/**
 * Controller Top.
 * 
 * @since 1.0
 */
Medicplus_Core::load_class( 'Abstract' );

class Medicplus_Core_Top_Controller extends Medicplus_Core_Abstract {
	
	public function ajax_department_pagination(){
		$atts  = $_POST['params']['atts'];
		$page  = $_POST['params']['page'];
		$atts['paged'] = $page;
		$this->render( 'ajax-department-pagination', array( 'atts' => $atts) );
		exit;
	}

	/* Save data fields form appointment */
	public function save_form_appointment( $wpcf7 ) {
		/*
		Note: since version 3.9 Contact Form 7 has removed $wpcf7->posted_data
		and now we use an API to get the posted data.
		*/
		
		$submission = WPCF7_Submission::get_instance();
		if ( empty($submission) ) {	
			return;
		}

		$posted_data = $submission->get_posted_data();
		if ( empty($posted_data['_wpcf7_slz_appointment_form']) ) {
			return;
		}

		foreach ( $posted_data as $key => $value ) {
			if ( '_wpcf7' == substr( $key, 0, 6 ) ) {
				unset( $posted_data[$key] );
			}
		}

		$meta = array();
		$special_mail_tags = array( 'remote_ip', 'user_agent', 'url', 'date', 'time', 'post_id' );

		foreach ( $special_mail_tags as $smt ) {
			$meta[$smt] = apply_filters( 'wpcf7_special_mail_tags','', '_' . $smt, false );
		}

		$post_type = 'medicplus_appoint';
		$post_title = esc_html__( 'Appointment', 'slz-core' );
		$post_content = implode( "|", $posted_data );
		$post_status = 'pending';
		$postarr = array(
			'post_type' 		=> $post_type,
			'post_status' 		=> $post_status,
			'post_title' 		=> $post_title,
			'post_content' 		=> $post_content,
			'comment_status' 	=> 'closed',
			'ping_status' 		=> 'closed',
		);
		$post_id = wp_insert_post( $postarr );

		$fields = array();
		if ( $post_id ) {
			wp_update_post(
				array(
					'ID' 			=> $post_id,
					'post_title'	=> $post_title. '-' .$post_id
				)
			);
			foreach ( $posted_data as $key => $value ) {
				$meta_key = sanitize_key( $post_type . '_' . $key );
				update_post_meta( $post_id, $meta_key, $value );
				$fields[$key] = $value;
				// $fields[$key] = null;
			}
			update_post_meta( $post_id, $post_type . '_' . 'fields', $fields );
			update_post_meta( $post_id, $post_type . '_' . 'meta', $meta );
		}
	}

	/* Ajax get load_more of gallery */
	function ajax_get_more_gallery(){		
		$atts = $_POST['params'][0];
		echo ( $this->render( 'ajax-gallery', array( 'atts' => $atts, 'content' => null ), true ) );
		exit;
	}

}