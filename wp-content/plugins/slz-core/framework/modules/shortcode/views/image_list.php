<?php
$image_ids = explode( ',', $images);

if( $style_image == '1' ) {
	if( $image_ids ) {
		echo '<div class="slz-shortcode image-list-'.esc_attr($id).' '.esc_attr($extra_class).'">';
			echo '<div class="certification-block">';
				echo '<div class="certificate-wrapper">';
					
					foreach( $image_ids as $key => $image_id ){
						$image_url = wp_get_attachment_image_url( $image_id, 'full' );
						if($image_url){
							printf('<div class="award item slick-slide slick-current slick-active" data-slick-index="%1$s">
									<img src="%2$s" alt="" class="img-responsive">
									</div>',
									$key,
									$image_url
							);
						}
					}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
}

else{
	if( $array_image_list ){
		echo '<div class="slz-shortcode clients '.esc_attr($extra_class).'">';
			echo '<div class="clients-wrapper owl-carousel">';
				foreach ( $array_image_list as $index => $item ) {
					$image_id = Medicplus_Core::get_value( $item, 'image_link');
					$link = Medicplus_Core::get_value( $item, 'url');
					$html_image = '';
					if( $image_id ) {
						$image_url = wp_get_attachment_image_url( absint($image_id), 'full' );
						$image_src = '<img src="'.esc_url($image_url).'" alt="" class="img-responsive active-logo">';
						$html_image = '<span class="item-logo" >'.$image_src.'</span>';
						if( $link ) {
							$link_val = Medicplus_Core_Util::get_link( $link );
							if( $link_val ){
								$html_image_format = '<a class="item-logo" href="%1$s"  %2$s %3$s >%4$s</a>';
								$html_image = sprintf( $html_image_format, $link_val['link'], $link_val['url_title'], $link_val['target'], $image_src );
							}
						}
						echo '<div class="owl-item" >' . $html_image . '</div>';
					}
				}
			echo '</div>';
		echo '</div>';
	}
}