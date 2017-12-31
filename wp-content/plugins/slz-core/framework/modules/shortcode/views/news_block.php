<?php
$model = new Medicplus_Core_Block;
$atts['limit_post'] = 3;
$model->init( $atts );
$block_cls = $model->attributes['extra_class'] . ' ' . $model->attributes['block-class'];

$html_options = array(
	'meta_info_format' => '<ul class="list-meta list-inline list-unstyled">
								<li>%1$s</li>
							</ul>',
	'title_format'     => '<h2 class="post-title"><a href="%2$s">%1$s</a></h2>',
	'meta_seperate'    => '</li><li>',
	'image_format'     => '<a href="%1$s" class="post-link">%2$s</a>',
);
$count = 0;
$custom_css = '';
$bg_img_css = '.%1$s .%2$s .recent-news-bg-img { background-image: url(%3$s);}' . "\n";
if( $model->query->have_posts() ) :
	$model->html_format = $model->set_post_options_defaults( $html_options );
?>
<div class="slz-shortcode recent-news recent-news-2 <?php echo esc_attr( $block_cls ) ?>" data-item=".<?php echo esc_attr( $model->attributes['block-class'] ) ?>">
	<div class="recent-news-wrapper">
		<div class="grid grid-isotope">
		<?php while ( $model->query->have_posts() ) :
				$model->query->the_post();
				$model->loop_index();
				$count ++;
				if( $count == 1):
					$type = 'large';
				?>
					<div class="grid-item height-2x <?php echo ( $model->get_post_class() );?>">
						<div class="post-wrapper">
							<div class="post-inner">
								<div class="post-image recent-news-bg-img">
									<?php $model->get_featured_image($type, true, $model->html_format );?>
								</div>
								<div class="post-content">
									<div class="post-meta">
										<?php $model->get_date( true );?>
										<?php echo wp_kses_post( $model->get_meta_info_more() );?>
									</div>
									<?php $model->get_title(false, true, $model->html_format);?>
									</div>
							</div>
						</div>
					</div><?php
				else:
					$type = 'small';
					$model->html_format['title_format'] = '<h3 class="recent-news-title"><a href="%2$s">%1$s</a></h3>';
					$model->html_format['meta_info_format'] = '<div class="recent-news-meta">
															<ul class="list-meta list-inline list-unstyled">
																<li>%1$s</li>
															</ul>
														</div>';?>
					<div class="grid-item <?php echo ( $model->get_post_class() );?>">
						<div class="recent-news-item">
							<div class="recent-news-image recent-news-bg-img">
								<?php $model->get_featured_image($type, true, $model->html_format );?>
							</div>
							<div class="recent-news-content">
								<?php $model->get_date( true );?>
								<?php $model->get_title(false, true, $model->html_format );?>
								<div class="recent-news-description">
									<?php $model->get_excerpt(true, true);?>
								</div>
								<?php echo $model->get_meta_info_more();?>
							</div>
						</div>
					</div><?php
				endif;
				$url = $model->get_featured_url($type);
				$item_post_class = 'post-' . $model->post_id;
				$custom_css .= sprintf($bg_img_css, $model->attributes['block-class'], $item_post_class, esc_url($url));
			endwhile;?>
		</div>
	</div>
</div>
<?php
wp_reset_postdata();
if( $custom_css ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
endif;
?>