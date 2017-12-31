<?php
	$image_ids = explode( ',', $images );
	$custom_css = '';
	if( !empty($height) ) {
		$custom_css .= sprintf('.sc-carousel-%1$s .slider-howwedo { height: %2$s;}',
								$id,
								$height
							);
	}
?>
<?php if($style == 1){ ?>
<div class="slz-shortcode howwedo sc-carousel-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $extra_class ); ?>">
	<div class="slider-howwedo">
		<div data-slider-id="carousel-<?php echo esc_attr( $id ); ?>" class="slider-howwedo-wrapper owl-carousel">
		<?php
			$i = 0;
			foreach( $image_ids as $image_id ){
				$image_src = wp_get_attachment_image_src( $image_id, 'medicplus-thumb-650x382' );
				if( $image_src ){
					printf('<div data-item="item-%1$s" class="item item-%1$s">
								<img src="%2$s" alt="" class="img-responsive">
							</div>',
							esc_attr( $id.$image_id ),
							esc_url( $image_src[0] )
						);
					if( !empty( $background ) ){
						$custom_css .= sprintf('.sc-carousel-%1$s .slider-howwedo-wrapper .item-%2$s,
												.sc-carousel-%1$s .thumbs-howwedo .item-%2$s { 
													background-image:url(%3$s);
												}',
												esc_attr( $id ),
												esc_attr( $id.$image_id ),
												esc_url( $image_src[0] )
											);
					}
				}
				$i++;
			}
			if( $i == 1 ) {
				$custom_css .= sprintf( '.sc-carousel-%s .slider-howwedo .nav-howwedo{display: none;}', esc_attr( $id ) );
			}
			if( !empty( $background ) ){
				$custom_css .= sprintf('.sc-carousel-%1$s .slider-howwedo .slider-howwedo-wrapper .item img,
										.sc-carousel-%1$s .slider-howwedo .thumbs-howwedo .thumb-item img {
											position: absolute;
											left: -9999px;
											top: -9999px;
										}', esc_attr( $id ) );
			}
		?>
		</div>
		<div class="thumbs-howwedo owl-carousel">
		<?php
			$count = 1;
			foreach( $image_ids as $index => $image_id ){
				$image = wp_get_attachment_image( $image_id, 'medicplus-thumb-650x382' );
				$cls = '';
				if( $count == 1 ){
					$cls = 'active';
				}
				if( $image ){
					printf('<a href="#item-%1$s" class="thumb-item item-%1$s %3$s" data-item="%4$s">%2$s</a>',
							$id.$image_id,
							$image,
							$cls,
							$index
						);
					$count ++;
				}
			}
		?>
		</div>
		<div class="nav-howwedo">
			<a href="javascript:void(0)" class="nav-howwedo-left"><i class="fa fa-angle-left"></i></a>
			<a href="javascript:void(0)" class="nav-howwedo-right"><i class="fa fa-angle-right"></i></a>
		</div>
	</div>
</div>
<?php
}else{

	if(count($image_ids) >1) :
?>
<div class="slz-shortcode service-content sc-carousel-<?php echo esc_attr( $id ).' '.esc_attr( $extra_class ); ?>">
	<div class="services-detail-wrapper">
		<div class="post-img-wrapper">
			<div class="post-image post-slider owl-carousel">
			<?php
				foreach( $image_ids as $image_id ){
					$image = wp_get_attachment_image( $image_id, 'medicplus-thumb-650x382' );
					if( $image ){
						printf('<div>%2$s</div>',
								$image_id,
								$image
							);
					}
				}
			?>
			</div>
			<div class="post-nav">
				<a href="javascript:void(0)" class="disabled"><i class="fa fa-angle-left"></i></a>
				<a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php } ?>
<?php
if( !empty( $custom_css ) ){
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
?>