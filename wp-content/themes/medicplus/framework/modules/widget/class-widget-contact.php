<?php 
/**
 * Widget_Contact class.
 *
 * @since 1.0
 */

class Medicplus_Widget_Contact extends WP_Widget{
	
	public function __construct(){
		$widget_ops = array('classname' => 'widget_slz_contact', 'description' => esc_html__("Slz Contact", 'medicplus' ) );
		parent::__construct('medicplus_contact', esc_html_x('SLZ: Contact', 'Contact widget', 'medicplus' ), $widget_ops );
	}
	public function form($instance){
		$default = array(
			'description' => esc_html__("For help selecting a doctor or making an appointment:", 'medicplus' ),
			'phone'       => '',
		);
		$instance = wp_parse_args((array) $instance, $default );
		$description = esc_attr( $instance['description'] );
		extract($instance)
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('description') ); ?>"><?php esc_html_e( 'Description: ', 'medicplus' );?></label>
			<textarea class="widefat" rows="4" id="<?php echo esc_attr( $this->get_field_id('description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>"><?php echo esc_textarea($description ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('phone') );?>"><?php esc_html_e('Phone number: ', 'medicplus' );?></label>
			<input class="widefat" type="text" id="<?php  echo esc_attr($this->get_field_id('phone') );?>" name="<?php echo esc_attr($this->get_field_name('phone'))?>" value="<?php echo esc_attr($phone) ?>"/>
		</p>
		<?php
	}
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['description']  = strip_tags( $new_instance['description'] );
		$instance['phone']  = strip_tags( $new_instance['phone'] );
		return $instance;
	}
	function widget($args, $instance){
		extract($args);
		extract($instance);
		echo wp_kses_post( $before_widget );
		if( !empty($phone) || !empty($description) ):
		?>
			<div class="widget-sidebar doctor-block">
				<div class="contact-wrapper"><?php echo nl2br( esc_textarea($description) );?>
					<?php if( !empty( $phone ) ):?>
					<i class="fa fa-phone"><span><?php echo esc_attr($phone);?></span></i>
					<?php endif;?>
				</div>
			</div>
		<?php
		endif;
		echo wp_kses_post( $after_widget );
	}
}