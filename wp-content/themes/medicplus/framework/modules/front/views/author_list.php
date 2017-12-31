<?php
Medicplus::load_class( 'front.Blog' );
$userID = get_query_var('author');
$limit_post = get_option('posts_per_page');
$model = new Medicplus_Blog;
$atts = array(
	'layout'      => 'author',
	'pagination'  => 'yes',
	'offset_post' => 0,
	'limit_post'  => $limit_post,
	'author'      => $userID
);
$model->init( $atts );
$model->large_image_post = false;
$model->show_full_meta = false;
$model->show_author_meta = true;
$html_format =
		'<div class="grid-item post-inner %6$s post-%8$s" data-item=".post-%8$s">
			%1$s
			<div class="post-content %7$s">
				<div class="post-meta">
					%4$s
					%5$s
				</div>
				%2$s
				<div class="description">%3$s</div>
			</div>
		</div>';
if ( $model->query->have_posts() ) :
	$display_name = sprintf(esc_html__( '%s Articles', 'medicplus' ) , get_the_author_meta( 'display_name', $userID) );?>
	<div class=" author_article"><?php echo esc_html($display_name);?></div>
	<div class="blog-wrapper <?php echo esc_attr( $model->attributes['block-class'] ) ?>" data-item=".<?php echo esc_attr( $model->attributes['block-class'] ) ?>">
		<div class="post-wrapper grid ">
			<div class="recent-news-list "><?php
				$post_options = array(
					'html_format' => $html_format,
					'meta_seperate'	=> '</li><li>',
					'bg_img_css'	 => '.%1$s .%2$s .video-bg { background-image: url(%3$s);}' . "\n",
					'title_format'   => '<h2 class="post-title"><a href="%2$s">%1$s</a></h2>',
					'meta_info_format' => '<ul class="list-meta list-inline list-unstyled">
												<li>%1$s</li>
											</ul>',
					'image_format'  => '<div class="post-image"><a href="%1$s">%2$s</a></div>',
					);
				$model->render_author( $post_options );
				wp_reset_postdata();?>
			</div>
		</div>
	</div>
<?php endif; ?>