<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the content div and all content after
 *
 * @author Swlabs
 * @since 1.0
 */
?>
									</div>
									<!-- CONTENT-->
								</div>
								<!-- MAIN CONTENT-->
							</div>
							<!-- PAGE WRAPPER -->
						</div>
						<!-- WRAPPER CONTENT -->
					<!-- FOOTER-->
					<footer>
						<?php do_action('medicplus_show_footer_contact');?>
						<?php do_action('medicplus_show_footer');?>
					</footer>
				<?php if ( Medicplus::get_option('slz-backtotop') == '1') { ?>
					<div class="btn-wrapper back-to-top slz-back-to-top show"><a href="#top" class="btn btn-transparent"><i class="fa fa-angle-double-up"></i></a></div>
				<?php } ?>
				<?php if ( MEDICPLUS_WPCF7_ACTIVE ) { ?>
				<div class="modal fade slz_cf7_modal" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content contact-form-inner"></div>
					</div>
				</div>
				<?php } ?>
			</div>
			<!-- PAGE-->
		</div>
		<!-- body wrapper -->
		<!-- End #page -->
		<?php wp_footer(); ?>
	</body>
</html>