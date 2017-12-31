<?php
/**
 * Widget_Services class.
 * 
 * @since 1.0
 */

class Medicplus_Widget_Services extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_medicplus_services', 'description' => esc_html__( "A list of services", 'medicplus' ) );
		parent::__construct( 'medicplus_services', esc_html_x( 'SLZ: Services', 'Services widget', 'medicplus' ), $widget_ops );
	}

	function form( $instance ) {
		$default = array( 
			'title'   		=> esc_html__( "Services", 'medicplus' ),
			'limit_post' 	=> '5',
			'offset_post' 	=> '',
			'sort_by' 		=> '',
			'category' 		=> ''
		);
		$sort_arr       = Medicplus_Core_Params::get('sort-service');
		$cat_arr        = Medicplus_Core_Com::get_tax_options2slug( 'medicplus_service_cat', array('empty'       => esc_html__( '--All Categories--', 'medicplus' ) ) );
		$instance 		= wp_parse_args( (array) $instance, $default );
		$title    		= esc_attr($instance['title']);
		$limit_post 	= esc_attr($instance['limit_post']);
		$offset_post 	= esc_attr($instance['offset_post']);
		$sort_by 		= esc_attr($instance['sort_by']);
		$category 		= esc_attr($instance['category']);
		?>
		<p>
			<label for="<?php echo  esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title', 'medicplus' );?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo  esc_attr( $this->get_field_id('limit_post') ); ?>"><?php esc_html_e( 'Number Post', 'medicplus' );?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('limit_post') ); ?>" name="<?php echo esc_attr( $this->get_field_name('limit_post') ); ?>" value="<?php echo esc_attr( $limit_post ); ?>" />
		</p>
		<p>
			<label for="<?php echo  esc_attr( $this->get_field_id('offset_post') ); ?>"><?php esc_html_e( 'Offset post', 'medicplus' );?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('offset_post') ); ?>" name="<?php echo esc_attr( $this->get_field_name('offset_post') ); ?>" value="<?php echo esc_attr( $offset_post ); ?>" />
		</p>
		<p>
			<label for="<?php echo  esc_attr( $this->get_field_id('sort_by') ); ?>"><?php esc_html_e( 'Sort By', 'medicplus' );?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('sort_by') ); ?>" name="<?php echo esc_attr( $this->get_field_name('sort_by') ); ?>" >
				<?php foreach( $sort_arr  as $k => $v ){?>
					<option value="<?php echo esc_attr($v); ?>"<?php if( $sort_by == $v ) echo " selected"; ?>><?php echo esc_html($k); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo  esc_attr( $this->get_field_id('category') ); ?>"><?php esc_html_e( 'Service Categories', 'medicplus' );?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('category') ); ?>" name="<?php echo esc_attr( $this->get_field_name('category') ); ?>" >
				<?php foreach( $cat_arr  as $k => $v ){?>
					<option value="<?php echo esc_attr($v); ?>"<?php if( $category == $v ) echo " selected"; ?>><?php echo esc_html($k); ?></option>
				<?php } ?>
			</select>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$params = array(
			'title',
			'limit_post',
			'offset_post',
			'sort_by',
			'category',
		);
		foreach( $params as $item ) {
			$instance[$item] = strip_tags( $new_instance[$item] );
		}
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$default  = array(
			'title'           => '',
			'limit_post'      => '',
			'offset_post' 	  => '',
			'sort_by' 		  => '',
			'category' 		  => ''
		);
		$instance = wp_parse_args( (array) $instance, $default ); 
		extract( $instance );
		$atts = $instance;
		$model = new Medicplus_Core_Service();
		$atts['method'] = 'cat';
		$model->init( $atts );
		$html_format = '<div class="howwedoit-inner item">
								<div class="btn-for-icon right">
									<i class="icon1 %3$s"></i><i class="icon2 %3$s"></i>
								</div>
								<a href="%2$s" class="howwedoit-title">%1$s</a>
						</div>';
		echo wp_kses_post( $before_widget );
		?>
		<div class="widget-sidebar widget-other-services">
			<?php
				if( !empty( $title ) ){
					echo wp_kses_post( $before_title );
					echo esc_html( $title );
					echo wp_kses_post( $after_title );
				}
			?>
			<div class="howwedoit-content">
				<?php 
					$html_options = array(
							'html_format' => $html_format,
					);
					$model->render_widget( $html_options );
				?>
			</div>
		</div>
		<?php
		echo wp_kses_post( $after_widget );
	}
}
