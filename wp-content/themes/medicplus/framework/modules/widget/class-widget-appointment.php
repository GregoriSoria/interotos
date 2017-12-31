<?php
/**
 * Widget_Appointment class.
 * 
 * @since 1.0
 */

class Medicplus_Widget_Appointment extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_slz_appointment', 'description' => esc_html__( "A list of appointment", 'medicplus' ) );
		parent::__construct( 'medicplus_appointment', esc_html_x( 'SLZ: Appointment', 'Appointment widget', 'medicplus' ), $widget_ops );
	}

	function form( $instance ) {
		$default = array( 
			'title'         => esc_html__( "Appointment", 'medicplus' ),
			'contact_form'  => '',
		);
		$instance = wp_parse_args( (array) $instance, $default );
		$title = esc_attr( $instance['title'] );
		$contact_form = esc_html( $instance['contact_form'] );
		$contact_form_arr = array('' => esc_html__( '-None-', 'medicplus' ));
		$args = array (
					'post_type'        => 'wpcf7_contact_form',
					'post_per_page'    => -1,
					'status'           => 'publish',
					'suppress_filters' => false,
				);
		$post_arr = get_posts( $args );
		foreach( $post_arr as $post ){
			$name = ( !empty( $post->post_title ) )? $post->post_title : $post->post_name;
			$contact_form_arr[$post->ID ] =  $name;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'medicplus'); ?>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('contact_form') ); ?>"><?php esc_html_e('Contact form:', 'medicplus'); ?>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('contact_form') ); ?>" name="<?php echo esc_attr( $this->get_field_name('contact_form') ); ?>">
					<?php foreach ($contact_form_arr as $key => $value) {
						$selected = $contact_form == $key ? 'selected="selected"' : '';
						echo '<option value="'. $key .'" '. $selected .'>'. $value .'</option>';
					}?>
				</select>
			</label>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contact_form'] = strip_tags( $new_instance['contact_form'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$default  = array(
			'title'        => '',
			'contact_form' => '',
		);
		$title = $instance ['title'];
		$contact_form = $instance ['contact_form'];
		$instance   = wp_parse_args( (array) $instance, $default );
		extract( $instance );

		echo wp_kses_post( $before_widget );
		?>
		<div class="widget-sidebar widget-make-appointment">
			<div class="make-app-inner">
				<?php if ( !empty($title) ) {
					printf('<div class="make-app-btn">%s</div>', esc_html($title));
				} ?>
				<div class="slz-shortcode sc_appointment">
					<?php if ( !empty( $contact_form ) && MEDICPLUS_WPCF7_ACTIVE ) { ?>
					<?php echo do_shortcode('[contact-form-7 id="'.esc_html($contact_form).'" title="'.esc_attr($title).'" html_id="appointment-form-'.esc_html($contact_form).'" html_class="appointment-form"]');
					} ?>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<?php
		echo wp_kses_post( $after_widget );
		
	}
}