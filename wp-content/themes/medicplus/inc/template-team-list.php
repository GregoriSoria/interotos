<?php get_header(); 
if ( ! MEDICPLUS_CORE_IS_ACTIVE ){
	exit;
}
// css to show/hide sidebar.
$medicplus_all_container_css = medicplus_get_container_css();

$medicplus_currentObject = get_queried_object();

$medicplus_atts = array();
$medicplus_atts['pagination'] 	= 'yes';
$medicplus_atts['style'] 		= 2;
$medicplus_atts['limit_post'] 	= get_option('posts_per_page');
$medicplus_atts['button_text'] 	= esc_html__( 'Ver detalhes', 'medicplus' );
if ( is_tax() ) {
	$medicplus_term_slug = !empty($medicplus_currentObject) ? $medicplus_currentObject->slug : '';
	$medicplus_atts['category_slug'] 	= $medicplus_term_slug;
}

$medicplus_model = new Medicplus_Core_Team();
$medicplus_model->init( $medicplus_atts );
$medicplus_block_cls = $medicplus_model->attributes['uniq_id'];

// 1$ - thumb img, 2$ - title, 3$ - position, 4$ - phone, 5$ - email, 6$ - social, 7$ - description, 8$ - btn readmore, 9$ - open row, 10$ - close row
$medicplus_html_format = '
	%9$s
        <div class="doctor-head-wrapper">
            <div class="doctor-head-inner">
                <div class="doctor-img">
                    %1$s
                </div>
                <div class="doctor-body">
                	%2$s
                    <div class="doctor-sub-title">%3$s</div>
                    <div class="doctor-info">
                    	%4$s
                    	%5$s
                        <ul class="info-inner list-inline list-unstyled list-socials">
                            %6$s
                        </ul>
                    </div>
                    %7$s
                </div>
                <div class="doctor-sign">
                	%8$s
                </div>
            </div>
        </div>
    %10$s
	';
?>
<div class="section blog padding-top-100 padding-bottom-100" >
	<div class="<?php echo esc_attr( $medicplus_all_container_css['container_css'] );?>">
		<div class="blog-wrapper row">
			<div id="page-content" class="<?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
				<?php if ( $medicplus_model->query->have_posts() ) : ?>
				<div class="post-wrapper">
					<div class="section-content">
						<div class="slz-shortcode sc_team_simple <?php echo esc_attr( $medicplus_block_cls ); ?>"> 
							<div class="doctor-wrapper style2 of-search-result">
								<?php $medicplus_model->render_team_list_fe( array('html_format' => $medicplus_html_format) );?>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<?php echo medicplus_paging_nav(); ?>
				</div>
				<?php else : ?>
				<div class="section-content-none">
					<?php get_template_part( 'inc/content', 'none' ); ?>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>