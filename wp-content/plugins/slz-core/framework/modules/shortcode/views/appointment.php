<?php
$uniq_id = 'slz_appointment-'.esc_attr( $id );
$custom_css = '';
if( !empty($color_error) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form span[role=alert] { color: %2$s !important;}',
							$uniq_id, $color_error
						);
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form div.wpcf7-validation-errors { color: %2$s !important; border-color: %2$s !important; }',
							$uniq_id, $color_error
						);
}
if( !empty($color_input) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .form-md-line-input .form-control, .%1$s input[type=text], .%1$s .appointment-form input[type=text], .%1$s .appointment-form input[type=email], .%1$s .appointment-form input[type=number], .%1$s .appointment-form select, .%1$s .appointment-form textarea { color: %2$s !important;}',
							$uniq_id, $color_input
						);
}
if( !empty($color_input_line) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .form-md-line-input .form-control, .%1$s .appointment-form input[type=text], .%1$s .appointment-form input[type=email], .%1$s .appointment-form input[type=number], .%1$s .appointment-form select, .%1$s .appointment-form textarea { border-bottom-color: %2$s !important;}',
							$uniq_id, $color_input_line
						);
	$custom_css .= sprintf('.%1$s.sc_appointment .form-md-line-input.form-md-floating-label .form-control ~ label { color: %2$s !important;}',
							$uniq_id, $color_input_line
						);
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form { color: %2$s !important;}',
							$uniq_id, $color_input_line
						);
}
if( !empty($color_text_button) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form .btn-make-app, .%1$s input[type=submit] { color: %2$s !important;}',
							$uniq_id, $color_text_button
						);
}
if( !empty($color_text_button_hv) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form .btn-make-app:hover, .%1$s input[type=submit]:hover { color: %2$s !important;}',
							$uniq_id, $color_text_button_hv
						);
}
if( !empty($background_button) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form .btn-make-app, .%1$s input[type=submit] { background-color: %2$s !important; border-color: %2$s !important; }',
							$uniq_id, $background_button
						);
}
if( !empty($background_button_hv) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form .btn-make-app:hover, .%1$s input[type=submit]:hover { background-color: %2$s !important; border-color: %2$s !important; }',
							$uniq_id, $background_button_hv
						);
}
if( !empty($border_button) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form .btn-make-app, .%1$s input[type=submit] { border-color: %2$s !important;}',
							$uniq_id, $border_button
						);
}
if( !empty($border_button_hv) ) {
	$custom_css .= sprintf('.%1$s.sc_appointment .appointment-form .btn-make-app:hover, .%1$s input[type=submit]:hover { border-color: %2$s !important;}',
							$uniq_id, $border_button_hv
						);
}
?>

<div class="slz-shortcode sc_appointment <?php echo esc_attr( $uniq_id ).' '.esc_attr( $extra_class );?>">
		
<?php 
if ( !empty($style) && $style == '1' ) {
	if( !empty($background_box) ) {
		$custom_css .= sprintf('.%s.sc_appointment .appointment-form { background-color: %s !important;}',
								$uniq_id, $background_box
							);
	}
	if( !empty($background_head) ) {
		$custom_css .= sprintf('.%s.sc_appointment .make-app-btn { background-color: %s !important;}',
								$uniq_id, $background_head
							);
	}
	if( !empty($color_text_head) ) {
		$custom_css .= sprintf('.%s.sc_appointment .make-app-btn { color: %s !important;}',
								$uniq_id, $color_text_head
							);
	}
?>
	<div class="home-appointment">
		<div class="make-app-inner">
			<?php if ( !empty( $title_box ) ) { ?>
			<?php printf( '<div class="make-app-btn">%s</div>', $title_box );?>
			<?php } ?>
			<?php if ( !empty( $contact_form ) && SLZCORE_WPCF7_ACTIVE ) { ?>
			<?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'" title="'.$title_box.'" html_id="appointment-form-'.$id.'" html_class="appointment-form"]');
			} ?>
			<div class="clearfix"> </div>
		</div>
	</div>
<?php
} elseif ( $style == '2' ) {
	if( !empty($background_box) ) {
		$custom_css .= sprintf('.%s.sc_appointment .appointment-form { background-color: %s !important;}',
								$uniq_id, $background_box
							);
	}
	if( !empty($background_head) ) {
		$custom_css .= sprintf('.%s.sc_appointment .make-app-btn { background-color: %s !important;}',
								$uniq_id, $background_head
							);
	}
	if( !empty($color_text_head) ) {
		$custom_css .= sprintf('.%s.sc_appointment .make-app-btn { color: %s !important;}',
								$uniq_id, $color_text_head
							);
	}
?>
	<div class="with-appointment-board">
		<div class="make-app-inner">
			<?php if ( !empty( $title_box ) ) { ?>
			<?php printf( '<div class="make-app-btn">%s</div>', $title_box );?>
			<?php } ?>
			<?php if ( !empty( $contact_form ) && SLZCORE_WPCF7_ACTIVE ) { ?>
			<?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'" title="'.$title_box.'" html_id="appointment-form-'.$id.'" html_class="appointment-form"]');
			} ?>
			<div class="clearfix"> </div>
		</div>
	</div>
<?php
} elseif ( $style == '3' ) {
	if( !empty($background_box) ) {
		$custom_css .= sprintf('.%s.sc_appointment .appointment-content { background-color: %s !important;}',
								$uniq_id, $background_box
							);
	}
	if( !empty($background_head) ) {
		$custom_css .= sprintf('.%s.sc_appointment .appointment-content .typo-line { background-color: %s !important;}',
								$uniq_id, $background_head
							);
	}
	if( !empty($border_box) ) {
		$custom_css .= sprintf('.%1$s.sc_appointment .appointment-content { border-color: %2$s !important;}',
								$uniq_id, $border_box
							);
	}
	if( !empty($color_text_head) ) {
		$custom_css .= sprintf('.%s.sc_appointment .sub-header { color: %s !important;}',
								$uniq_id, $color_text_head
							);
	}
	if( !empty($color_line_head) ) {
		$custom_css .= sprintf('.%1$s.sc_appointment .typo-line:after { background-color: %2$s !important;}',
								$uniq_id, $color_line_head
							);
	}
	if( !empty($color_title) ) {
		$custom_css .= sprintf('.%1$s.sc_appointment .header, .%1$s.sc_appointment .description { color: %2$s !important;}',
								$uniq_id, $color_title
							);
	}
?>
	<div class="home-appointment index-2">
		<div class="make-apppointment">
			<div class="appointment-content">
				<?php if ( !empty( $title_box ) ) { ?>
				<?php printf( '<div class="typo-line"><h4 class="sub-header">%s</h4></div>', $title_box );?>
				<?php } ?>
				<?php if ( !empty( $title ) ) { ?>
				<?php printf( '<h2 class="header">%s</h2>', $title );?>
				<?php } ?>
				<?php if ( !empty( $description ) ) { ?>
				<?php printf( '<div class="description">%s</div>', $description );?>
				<?php } ?>
				<div class="make-app-wrapper">
					<div class="make-app-inner">
						<?php if ( !empty( $contact_form ) && SLZCORE_WPCF7_ACTIVE ) { ?>
						<?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'" title="'.$title_box.'" html_id="appointment-form-'.$id.'" html_class="appointment-form"]');
						} ?>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
} elseif ( $style == '4' ) {
	if( !empty($color_text_head) ) {
		$custom_css .= sprintf('.%s.sc_appointment .make-appointment-psychology .make-app-btn { color: %s !important;}',
								$uniq_id, $color_text_head
							);
	}
?>
	<div class="make-appointment-psychology">
		<?php if ( !empty( $is_container ) && $is_container == 'yes' ) { ?>
		<?php echo wp_kses_post( '<div class="container">' );?>
		<?php } ?>
			<div class="make-app-inner">
				<?php if ( !empty( $title_box ) ) { ?>
				<?php printf( '<div class="make-app-btn">%s</div>', $title_box );?>
				<?php } ?>
				<?php if ( !empty( $contact_form ) && SLZCORE_WPCF7_ACTIVE ) { ?>
				<?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'" title="'.$title_box.'" html_id="appointment-form-'.$id.'" html_class="appointment-form"]');
				} ?>
			</div>
		<?php if ( !empty( $is_container ) && $is_container == 'yes' ) { ?>
		<?php echo wp_kses_post( '</div>' );?>
		<?php } ?>
	</div>
<?php
}
if( $custom_css ) {
	do_action( SLZCORE_ADD_INLINE_CSS, $custom_css );
}
?>
</div>