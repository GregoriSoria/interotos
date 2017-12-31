<?php
/**
 * Widget_Init class.
 * 
 * @since 1.0
 */
Medicplus::load_class( 'widget.Widget_Categories' );
Medicplus::load_class( 'widget.Widget_Recent_Post' );
Medicplus::load_class( 'widget.Widget_Appointment' );
Medicplus::load_class( 'widget.Widget_Contact' );
if(MEDICPLUS_CORE_IS_ACTIVE) {
	Medicplus::load_class( 'widget.Widget_Services' );
	Medicplus::load_class( 'widget.Widget_Doctor' );
	Medicplus::load_class( 'widget.Widget_Department' );
}
class Medicplus_Widget_Init {
	/**
	 * Load widgets
	 *
	 */
	public function load() {
		register_widget( 'Medicplus_Widget_Categories' );
		register_widget( 'Medicplus_Widget_Recent_Post' );
		register_widget( 'Medicplus_Widget_Appointment' );
		register_widget( 'Medicplus_Widget_Contact' );
		if(MEDICPLUS_CORE_IS_ACTIVE) {
			register_widget( 'Medicplus_Widget_Services' );
			register_widget( 'Medicplus_Widget_Doctor' );
			register_widget( 'Medicplus_Widget_Department' );
		}
	}
	/**
	 * Register sidebars
	 *
	 */
	public function widgets_init() {
		register_sidebar( array (
			'name'          => esc_html__( 'Default Widget Area', 'medicplus' ),
			'id'            => 'medicplus-sidebar-default',
			'description'   => esc_html__( 'Add widgets here to appear in sidebar of posts and pages', 'medicplus'),
			'before_widget' => '<div id="%1$s" class="widget-sidebar slz-widget  box %2$s widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'
		));
		// Register footer area
		for ( $i = 1; $i < 5; $i++ ) {
			register_sidebar( array (
				'name'          => sprintf( esc_html__( 'Footer Widget Area %s', 'medicplus' ), $i ),
				'id'            => 'medicplus-sidebar-footer-' . $i,
				'description'   => sprintf( esc_html__( 'Add widgets here to appear in footer column %s.', 'medicplus' ), $i ),
				'before_widget' => '<div id="%1$s" class="%2$s slz-widget widget widget-footer">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="title">',
				'after_title'   => '</h4>'
			));
		}
		//Register sidebar main
		register_sidebar( array (
			'name'          => esc_html__( 'Main Widget Area', 'medicplus' ),
			'id'            => 'medicplus-sidebar-main',
			'description'   => esc_html__( 'Add widgets here to appear in sidebar pages.', 'medicplus' ),
			'before_widget' => '<div id="%1$s" class="widget-sidebar slz-widget  box %2$s widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'
		));
		//Register sidebar mblog
		register_sidebar( array (
			'name'          => esc_html__( 'Blog Widget Area', 'medicplus' ),
			'id'            => 'medicplus-sidebar-blog',
			'description'   => esc_html__( 'Add widgets here to appear in sidebar of posts.', 'medicplus' ),
			'before_widget' => '<div id="%1$s" class="widget-sidebar slz-widget box %2$s widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'
		));
		//Register sidebar mblog
		register_sidebar( array (
			'name'          => esc_html__( 'Shop Widget Area', 'medicplus' ),
			'id'            => 'medicplus-sidebar-shop',
			'description'   => esc_html__( 'Add widgets here to appear in sidebar of products.', 'medicplus' ),
			'before_widget' => '<div id="%1$s" class="widget-sidebar slz-widget box %2$s widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'
		));
		// Register custom sidebar
		$sidebars = get_option('medicplus_custom_sidebar');
		$args =  array (
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		);
		if( is_array( $sidebars ) ) {
			foreach ( $sidebars as $sidebar ) {
				if( !empty($sidebar) ) {
					$name = isset($sidebar['name']) ? $sidebar['name'] : '';
					$title = isset($sidebar['title']) ? $sidebar['title'] : '';
					$class = isset($sidebar['class']) ? $sidebar['class'] : '';
					$args['name']   = $title;
					$args['id']     = str_replace(' ','-',strtolower( $name ));
					$args['class']  = 'slz-custom';
					$args['before_widget'] = '<div class="widget-sidebar slz-widget box %2$s widget '. $class .'">';
					$args['after_widget']  = '</div>';
					$args['before_title']  = '<div class="title">';
					$args['after_title']   = '</div>';
					register_sidebar($args);
				}
			}
		}
	}
	/**
	 * Add custom sidebar area
	 *
	 */
	public function add_widget_field() {
		$nonce =  wp_create_nonce ('medicplus-delete-sidebar-nonce');
		$nonce = '<input type="hidden" name="medicplus-delete-sidebar-nonce" value="'.esc_attr($nonce).'" />';
		echo "\n<script type='text/html' id='medicplus-custom-widget'>";
		echo "\n  <form class='medicplus-add-widget' method='POST'>";
		echo "\n  <h3>".esc_html__('MedicPlus Custom Widgets', 'medicplus')."</h3>";
		echo "\n    <input class='medicplus_style_wrap' type='text' value='' placeholder = '". esc_html__('Enter Name of the new Widget Area here', 'medicplus') ."' name='medicplus-add-widget[name]' />";
		echo "\n    <input class='medicplus_style_wrap' type='text' value='' placeholder = '". esc_html__('Enter class display on front-end', 'medicplus') ."' name='medicplus-add-widget[class]' />";
		echo "\n    <input class='medicplus_button' type='submit' value='". esc_html__('Add Widget Area', 'medicplus') ."' />";
		echo "\n    ".$nonce;
		echo "\n  </form>";
		echo "\n</script>\n";
	}

	public function add_sidebar_area() {
		if( isset($_POST['medicplus-add-widget']) && !empty($_POST['medicplus-add-widget']['name']) ) {
			$sidebars = array();
			$sidebars = get_option('medicplus_custom_sidebar');
			$name = $this->get_name($_POST['medicplus-add-widget']['name']);
			$class = $_POST['medicplus-add-widget']['class'];
			$sidebars[] = array('name'=>sanitize_title($name), 'title' => $name, 'class'=>$class);
			update_option('medicplus_custom_sidebar', $sidebars);
			wp_redirect( esc_url(admin_url('widgets.php')) );
			die();
		}
	}

	public function get_name( $name ) {
		if( empty($GLOBALS['wp_registered_sidebars']) ){
			return $name;
		}

		$taken = array();
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			$taken[] = $sidebar['name'];
		}
		$sidebars = get_option('medicplus_custom_sidebar');

		if( empty($sidebars) ) {
			$sidebars = array();
		}

		$taken = array_merge($taken, $sidebars);
		if( in_array($name, $taken) ) {
			$counter  = substr($name, -1);
			$new_name = "";
			if( !is_numeric($counter) ) {
				$new_name = $name . " 1";
			}
			else {
				$new_name = substr($name, 0, -1) . ((int) $counter + 1);
			}
			$name = $new_name;
		}
		return $name;
	}
	public function delete_custom_sidebar() {
		check_ajax_referer('medicplus-delete-sidebar-nonce');
		if( !empty($_POST['name']) ) {
			$name = sanitize_title($_POST['name']);
			$sidebars = get_option('medicplus_custom_sidebar');
			foreach($sidebars as $key => $sidebar){
				if( strcmp(trim($sidebar['name']), trim($name)) == 0) {
					unset($sidebars[$key]);
					update_option('medicplus_custom_sidebar', $sidebars);
					echo "success";
					break;
				}
			}
		}
		die();
	}
}