<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$medicplus_all_container_css = medicplus_get_container_css();

get_header(); ?>
<div class="section section-padding padding-top-100 padding-bottom-100">
	<div class="<?php echo esc_attr($medicplus_all_container_css['container_css']);?>">
		<div class="row slz-woocommerce">
			<div id="page-content" class="<?php echo esc_attr( $medicplus_all_container_css['content_css'] ); ?>">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
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
