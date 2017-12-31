<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
$medicplus_image           = Medicplus::get_option('slz-404-illustration-image', 'url');
$medicplus_image_1         = Medicplus::get_option('slz-404-illustration-image1', 'url');
$medicplus_home_link_text  = Medicplus::get_option('slz-404-backhome');
$medicplus_btn_link_text   = Medicplus::get_option('slz-404-button-02');
$medicplus_btn_link        = Medicplus::get_option('slz-404-button-02-link');
$medicplus_btn_link_custom = Medicplus::get_option('slz-404-button-02-link-custom');

if(!empty($medicplus_btn_link_custom)){
	$medicplus_btn_link = $medicplus_btn_link_custom;
}
else{
	if ( !empty($medicplus_btn_link) ) {
		$medicplus_btn_link = get_page_link($medicplus_btn_link);
	}
}
?>

<?php get_header(); ?>

<section class="page-404-wrapper">
	<div class="container">
		<div class="page-404-inner"><?php if (!empty($medicplus_image)){ echo '<img src="'.esc_url($medicplus_image).'" alt="" class="img-responsive img-doctor">';}?>
			<div class="page-not-found">
				<h2 class="title-404"><?php esc_html_e('404','medicplus');?></h2>
				<span class="description-404"><?php echo esc_html(Medicplus::get_option('slz-404-title')); ?></span>
			</div>
			<?php if (!empty($medicplus_image_1)){ echo '<img src="'.esc_url($medicplus_image_1).'" alt="" class="img-responsive whoops">';}?>
			<div class="page-404-text"><?php echo wp_kses_post(Medicplus::get_option('slz-404-desc')); ?></div>
			<div class="btn-wrapper">
				<?php if(!empty($medicplus_home_link_text)){?>
					<a href="<?php echo esc_url(site_url()); ?>" class="btn"><?php echo esc_html($medicplus_home_link_text); ?></a>
				<?php }
				if (!empty($medicplus_btn_link_text)){?>
					<a href="<?php echo esc_url($medicplus_btn_link); ?>" class="btn btn-transparent"><?php echo esc_html($medicplus_btn_link_text); ?></a>
				<?php }?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>