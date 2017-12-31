<?php
class Medicplus_Core_Pricing_Model {
	public $pricing_posts;
	public $cur_post_id;
	public $cur_post;
	public $pricing_table;
	public $max_feature_item;
	public $pricing_atts;
	public $pricing_setting;
	public $pricing_count;

	/**
	 * Get pricing posts.
	 * 
	 * @param array $args - query args
	 */
	public function get_pricing_posts( $args ) {
		$defaults = array(
			'post_type'        =>'slz_pricing',
			'post_status'      =>'publish',
			'posts_per_page'   => -1,
			'suppress_filters' => false,
		);
		$args = array_merge( $defaults, $args );
		$this->pricing_posts = get_posts( $args );
	}

	/**
	 * Get meta of pricing column.
	 * 
	 * @param array $meta - current meta.
	 * @return array
	 */
	public function get_meta_column( $meta ) {
		$defaults = array(
			'icon'            => '',
			'title'           => '',
			'subtitle'        => '',
			'price'           => '',
			'header_color'    => '',
			'active_column'   => '',
			'display_content' => '',
			'feature'         => array(),
		);
		$meta = array_merge( $defaults, $meta );
		return $meta;
	}

	/**
	 * Get title of pricing column.
	 * 
	 * @param array $meta
	 * @param array $html_options
	 * @return string
	 */
	public function get_title( $meta, $html_options = array() ) {
		$before = Medicplus_Core::get_value( $html_options, 'title_before', '<h3 class="pricing-title">' );
		$after  = Medicplus_Core::get_value( $html_options, 'title_after', '</h3>' );
		$output = $before . esc_html( Medicplus_Core::get_value( $meta, 'title' ) ) . $after;
		return $output;
	}

	/**
	 * Get subtitle of pricing column.
	 * 
	 * @param array $meta
	 * @param array $html_options
	 * @return string
	 */
	public function get_subtitle( $meta, $html_options = array() ) {
		$before = Medicplus_Core::get_value( $html_options, 'subtitle_before', '<p class="pricing-subtitle">' );
		$after  = Medicplus_Core::get_value( $html_options, 'subtitle_after', '</p>' );
		$output = $before . esc_html( Medicplus_Core::get_value( $meta, 'subtitle' ) ) . $after;
		return $output;
	}

	/**
	 * Get price of pricing column.
	 * 
	 * @param array $meta
	 * @param array $html_options
	 * @return string
	 */
	public function get_price( $meta, $html_options = array() ) {
		$default = '<div class="price-cost">
						<div class="inner">
							<p data-from="0" data-to="%1$s" data-speed="1000" class="inner-number">0</p>
						</div>
					</div>';
		$format = Medicplus_Core::get_value( $html_options, 'price_format', $default );
		$price = absint( Medicplus_Core::get_value( $meta, 'price', 0 ) );
		$currency = Medicplus_Core::get_value( $this->pricing_setting, 'currency' );
		if( empty( $currency ) ) {
			$currency = '$';
		}
		$postfix = Medicplus_Core::get_value( $this->pricing_setting, 'price_postfix' );
		return sprintf( $format, $price, $currency, $postfix );
	}

	/**
	 * Get button of pricing column.
	 * 
	 * @param array $meta
	 * @param array $html_options
	 * @return string
	 */
	public function get_button( $meta, $html_options = array() ) {
		$default = '<div class="pricing-button"><a href="%1$s">%2$s</a></div>';
		$format = Medicplus_Core::get_value( $html_options, 'button_format', $default );
		return sprintf( $format, $this->pricing_atts['btn_link'], $this->pricing_atts['btn_content'] );
	}

	/**
	 * Get feature list of pricing column.
	 * 
	 * @param array $meta
	 * @param array $html_options
	 * @return string
	 */
	public function get_feature_list( $meta, $html_options = array() ) {
		$before = Medicplus_Core::get_value( $html_options, 'feature_before', '<li>' );
		$sep    = Medicplus_Core::get_value( $html_options, 'feature_sep', '</li><li>' );
		$after  = Medicplus_Core::get_value( $html_options, 'feature_after', '</li>' );
		$format = Medicplus_Core::get_value( $html_options, 'feature_format', '<p><strong>%1$s</strong> %2$s</p>' );
		$feature = Medicplus_Core::get_value( $meta, 'feature' );

		$display_content = Medicplus_Core::get_value( $this->pricing_setting, 'display_as' );
		$defaults = array(
			'first_content' => '',
			'last_content'  => '',
			'available'     => '',
		);
		$links = array();
		$output = '';
		$count = 0;
		if( $feature ) {
			foreach( $feature as $item ) {
				$item = array_merge( $defaults, $item );
				extract($item);
				$first = $item['first_content'];
				$last = $item['last_content'];
				if( $display_content == 'last_first') {
					$first = $item['last_content'];
					$last = $item['first_content'];
				}
				$links[] = sprintf( $format, $first, $last );
				$count ++;
			}
			if( $count < $this->max_feature_item ) {
				for( $i = $count; $i < $this->max_feature_item; $i++ ) {
					$links[] = sprintf( $format, '&nbsp;', '&nbsp;' );
				}
			}
			if( $links ) {
				$output = $before . join( $sep, $links ) . $after;
			}
			if( isset( $html_options['container'] ) ) {
				$container = $html_options['container'];
			} else {
				$container = '<ul class="pricing-list">%1$s</ul>';
			}
			$output = sprintf( $container, $output );
		}
		return $output;
	}
}