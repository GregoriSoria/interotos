<?php
Medicplus_Core::load_class( 'models.Custom_Post_Model' );
class Medicplus_Core_Gallery extends Medicplus_Core_Custom_Post_Model {

	private $post_type = 'medicplus_gallery';
	private $post_taxonomy = 'medicplus_gallery_cat';
	private $html_format;

	public function __construct() {
		$this->meta_attributes();
		$this->set_meta_attributes();
		$this->post_meta_prefix = $this->post_type . '_';
		$this->taxonomy_cat = $this->post_taxonomy;
	}

	public function meta_attributes() {
		$meta_atts = array(
			'gallery_image'      => esc_html__('Gallery Images', 'slz-core'),
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

	public function reset(){
		wp_reset_postdata();
	}

	public function init( $atts = array(), $query_args = array() ) {
		// set attributes
		$default_atts = array(
			'layout'				=> 'gallery',
			'column'				=> '2',
			'limit_post'			=> '-1',
			'offset_post'			=> '',
			'sort_by'				=> '',
			'pagination'			=> 'load_more',
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
		$custom_css = $this->add_custom_css();
		if( $custom_css ) {
			do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
		}
		// image size
		$this->get_thumb_size();
		$this->set_responsive_class();
	}

	public function set_responsive_class( $atts = array() ) {
		$class = '';
		$column = $this->attributes['column'];
		$def = array(
			'1' => 'col-xs-12 gallery-1col',
			'2' => 'col-sm-6 col-xs-12 gallery-2col',
			'3' => 'col-md-4 col-sm-6 col-xs-12 gallery-3col',
			'4' => 'col-lg-3 col-md-4 col-sm-6 col-xs-12 gallery-4col',
		);
		
		if( $column && isset($def[$column])) {
			return $this->attributes['responsive-class'] = $def[$column];
		} else {
			return $this->attributes['responsive-class'] = $def['2'];
		}
	}

	public function add_custom_css() {
		$css = '';
		if( !empty($this->attributes['color_filter']) ) {
			$css .= sprintf('.%s .gallery-wrapper .filter-button-group .btn { color: %s;}',
								$this->attributes['uniq_id'], $this->attributes['color_filter']
							);
		}
		if( !empty($this->attributes['color_filter_hv']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .filter-button-group .btn.active, .%1$s .gallery-wrapper .filter-button-group .btn:hover { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_filter_hv']
							);
		}
		if( !empty($this->attributes['color_filter_line']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .filter-button-group .btn:after { background-color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_filter_line']
							);
		}
		if( !empty($this->attributes['background_item']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .galleryContainer .bg-overlay { background-color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['background_item']
							);
		}
		if( !empty($this->attributes['color_item_text']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .galleryContainer .bg-overlay .title-hover { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_item_text']
							);
		}
		if( !empty($this->attributes['background_button']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .btn-wrapper .btn { background-color: %2$s; border-color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['background_button']
							);
		}
		if( !empty($this->attributes['background_button_hv']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .btn-wrapper .btn:hover { background-color: %2$s; border-color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['background_button_hv']
							);
		}
		if( !empty($this->attributes['color_button']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .btn-wrapper .btn { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_button']
							);
		}
		if( !empty($this->attributes['color_button_hv']) ) {
			$css .= sprintf('.%1$s .gallery-wrapper .btn-wrapper .btn:hover { color: %2$s;}',
								$this->attributes['uniq_id'], $this->attributes['color_button_hv']
							);
		}
		return $css;
	}

	/*-------------------- >> Render Html << -------------------------*/
	public function render_sc( $html_options = array() ) {
		$this->html_format = $this->set_default_options( $html_options );
		$count_post = $index = 0;
		$output = '';

		$classMasonryArr = array(
			'1' => '',
			'2' => 'height-gallery-2x',
			'3' => '',
			'4' => '',
			'5' => '',
			'6' => 'height-gallery-2x',
			'7' => '',
			'8' => 'height-gallery-2x',
			'9' => '',
		);
		if ( !empty($this->attributes['count_post']) ) {
			$count_post = $this->attributes['count_post'];
		}

		if( $this->query->have_posts() ) {
			while ( $this->query->have_posts() ) {
				$this->query->the_post();
				$this->loop_index();
				$count_post++;
				$html_options = $this->html_format;
				$output .= sprintf( $html_options['html_format'],
					$this->get_taxonomy_slug($this->taxonomy_cat),
					$this->permalink,
					$this->title,
					$this->get_featured_image( $html_options ),
					$this->get_feature_image_url(),
					$this->post_id,
					$this->set_responsive_class(),
					$this->get_post_class(),
					$classMasonryArr[$count_post]
					,$count_post
				);
				$this->attributes['count_post'] = $count_post;
				if ( $count_post == 9) { 
					$count_post = 0;
				}
			}
			$this->reset();
		}
		return $output;
	}

	public function render_filter_type( $atts = array() ) {
		$output = '';
		$taxonomy = $this->post_taxonomy;
		$format = '<button class="btn gallery_filter_tab" data-filter=".%1$s" data-slug="%1$s" data-category="%2$s" data-json="%3$s">%2$s</button>';
		$args = array(
			'pad_counts ' 	=> 1,
			'slug' 			=> $atts['category_slug'],
		);
		$terms = get_terms( $taxonomy, $args );
		if ($terms && ! is_wp_error($terms)) {
			foreach( $terms as $term ) {
				$atts['category_slug'] = $term->slug;
				$json_data = esc_attr( json_encode($atts) );
				$output .= sprintf( $format, esc_attr( $term->slug), esc_html( $term->name ), $json_data );
			}
		}
		return $output;
	}

	public function get_feature_image_url( $idThumb = '', $thumb_type = 'large', $echo = false ) {
		$output = $thumb_img = '';
		if (empty($idThumb)) {
			$idThumb = get_post_thumbnail_id( $this->post_id );
		}
		$thumb_size = $this->attributes['thumb-size'][$thumb_type];
		if( !empty($idThumb) ) {
			$thumb_img = wp_get_attachment_image_src( $idThumb, $thumb_size );
			$output = $thumb_img[0];
		}

		if( $echo ) {
			echo wp_kses_post( $output );
		} else {
			return $output;
		}
	}

	public function get_meta_gallery_image( $thumb_type = 'large', $echo = false ) {
		$out = $thumb_img = '';
		$gallery = $this->post_meta['gallery_image'];
		$galleryArr = explode(',', $gallery);
		$thumb_size = $this->attributes['thumb-size'][$thumb_type];
		if( !empty($galleryArr) ) {
			$idThumb = $galleryArr[0];
			$thumb_img = wp_get_attachment_image_src( $idThumb, $thumb_size );
			$out = $thumb_img[0];
		}

		if( $echo ) {
			echo wp_kses_post( $output );
		} else {
			return $output;
		}
	}

	public function set_default_options( $html_options = array() ) {
		$defaults = array(
			'cat_format'			=> '%1$s',
			'image_format'			=> '%1$s',
		);
		$html_options = array_merge( $defaults, $html_options );
		return $html_options;
	}

	public function get_thumb_size() {
		$params = Medicplus_Core_Params::get( 'block-image-size', $this->attributes['layout'] );
		$this->attributes['thumb-size'] = Medicplus_Core_Util::get_thumb_size( $params, $this->attributes );
	}

}