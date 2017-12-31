<?php 
/**
 * Widget_Categories class.
 *
 * @since 1.0
 */

class Medicplus_Widget_Categories extends WP_Widget{
	
	public function __construct(){
		$widget_ops = array('classname' => 'widget_slz_categories', 'description' => esc_html__('A list of Categories','medicplus'));
		parent::__construct('medicplus_categories', esc_html_x('SLZ: Categories', 'Categories widget','medicplus' ),$widget_ops);
	}
	
	function form($instance){
		$default = array(
			'title'   => esc_html__("Category",'medicplus'),
		);
		$instance = wp_parse_args((array) $instance, $default);
		$title = esc_attr($instance['title']);
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title') );?>"><?php esc_html_e('Title: ', 'medicplus' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title') ); ?>" name="<?php echo esc_attr($this->get_field_name('title') ); ?>" value="<?php echo esc_attr($title); ?>"/>
		</p>
	<?php
	}
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}
	function widget($args,$instance){
		extract($args);
		$title = apply_filters('widget_title',$instance['title'] );
		$categories = get_categories();
		echo wp_kses_post( $before_widget );?>
			<div class="widget-sidebar category-wrapper">
			<?php
				if( !empty( $title ) ) {
					echo wp_kses_post( $before_title );
					echo esc_html( $title );
					echo wp_kses_post( $after_title );
				}
				if( $categories ):?>
					<ul class="category-list list-unstyled">
						<?php 
							foreach($categories as $key => $value){
								$category_id = $value->cat_ID;
								$category_link = get_category_link( $category_id );
								echo '<li class="category wow fadeInUp"><a href="'.esc_url( $category_link ).'" class="category-link">'.esc_attr( $value->name ).'<i class="fa fa-angle-right"></i></a></li>';
							}
						?>
					</ul><?php
				endif; //categories ?>
			</div>
		<?php
		echo wp_kses_post( $after_widget );
	}
}