<?php $prefix='medicplus_gallery_'; ?>
<div class="slz-custom-meta" >
	<div class="slz-meta-row active" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Gallery Images', 'slz-core' );?></span>
			<p class="description"><?php esc_html_e( 'Images should have minimum size: 750x500. Bigger size images will be cropped automatically.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php $this->gallery( $prefix . 'meta['. $prefix .'gallery_image]', $data_meta['gallery_image'] ); ?>
		</div>
	</div>
</div>