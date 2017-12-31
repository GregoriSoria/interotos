<?php

get_header();
$medicplus_all_container_css = medicplus_get_container_css();
?>
<div class="section section-padding padding-top-100 padding-bottom-100">
	<div class="<?php echo esc_attr($medicplus_all_container_css['container_css']);?>">
		<div class="row mbxxl">
			<div id="page-content" class="author-archive <?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
				<?php do_action('medicplus_show_author_list');?>
			</div>
			<?php if( $medicplus_all_container_css['has_sidebar'] != 'none' ):?>
			<div id='page-sidebar' class="sidebar <?php echo esc_attr( $medicplus_all_container_css['sidebar_css'] ); ?>">
				<?php medicplus_get_sidebar($medicplus_all_container_css['sidebar_id']);?>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<?php get_footer(); ?>