<?php
/**
 * Application class.
 * 
 * @since 1.0
 */
class Medicplus_Application {

	/**
	 * It called on initialization of theme
	 */
	public function run() {
		Medicplus_Loader::run();
		add_action( 'init', array( 'Medicplus_Loader', 'init' ) );
		add_action( 'admin_init', array( 'Medicplus_Loader', 'admin' ) );
	}

	/**
	 * It is an action triggered whenever a ajax call
	 */
	public function ajax() {
		@ob_clean();
		if( $act = Medicplus::get_request_param( 'module' ) ) {
			if( Medicplus::load_class( $act[0] ) && 2 == count($act) && preg_match( '/^(?P<module>\w+)\.(?P<class>\w+)$/', $act[0] ) ) {
				call_user_func_array(
					array( Medicplus::new_object( $act[0] ), $act[1] ),
					Medicplus::get_request_param( 'params', array() )
				);
			} else {
				echo json_encode( array( 'mesasge' => 'Can\'t not load class ' . $act[0] ) );
			}
		}
		die();
	}

	/**
	 *  It is an action triggered whenever a post or page is created or updated
	 *
	 * @param int $post_id The post ID.
	 */
	public function save( $post_id ) {
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		global $post;
		if( ! empty( $post->post_type ) && ( $act= Medicplus_Config::get( 'save_post', $post->post_type ) ) ) {
			if( count( $act ) >= 2 && Medicplus::load_class( $act[0] ) ) {
				call_user_func_array( array( Medicplus::new_object( $act[0] ), $act[1] ), array( $post_id ) );
			}
		}
	}

	/**
	 * Call a callback with an array of parameters.
	 *
	 * @param array $item Callback parameters.
	 */
	public function register( $data ) {
		if(isset($data)){
			foreach( $data as $params ) {
				if( $fn = array_shift( $params ) ) {
					if( 'Medicplus' == $fn ) {
						$mt = array_shift ( $params );
						call_user_func_array( array( $fn, $mt ),  $params );
					} else {
						call_user_func_array( $fn, $params );
					}
				}
			}
		}
	}
}