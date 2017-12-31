<?php
$prefix = 'medicplus_testi_';
?>
<div class="slz-custom-meta" >
	<div class="slz-meta-row active" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Position', 'slz-core' );?></span>
			<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Position of testimonial.', 'slz-core' ) );?></span>
		</div>
		<div class="slz-field">
			<?php echo ( $this->text_field( 'medicplus_testi_meta['. $prefix .'position]',
																$this->get_field( $data_meta, 'position' ),
																array( 'class' => 'slz-block' ) ) );?>
		</div>
	</div>
</div>