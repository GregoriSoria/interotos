<?php
	$prefix = 'medicplus_service_';
	$sh_icons = Medicplus_Core_Params::get('font_medic');
	$awesome_icons = Medicplus_Core_Params::get('font_awesome');
	$icons = array_merge( $sh_icons, $awesome_icons );
	$admin_icon_url = '<a href="'.esc_url(admin_url( 'admin.php?page='.SLZCORE_THEME_PREFIX.'_icon' )).'" target="_blank">'.esc_html('Icons','slz-core').'</a>';
?>
<div class="tab-panel">

	<ul class="tab-list">
		<li class="active">
			<a href="slz-tab-general"><?php esc_html_e( 'General', 'slz-core' );?></a>
		</li>
		<li class="">
			<a href="slz-tab-gallery"><?php esc_html_e( 'Gallery', 'slz-core' );?></a>
		</li>
	</ul>
	<div class="tab-container">
		<div class="tab-wrapper slz-page-meta">
			<!-- Group General -->
			<div id="slz-tab-general" class="tab-content active">
				<table class="form-table">
					<!-- Icon -->
					<tr class="last">
						<th scope="row" colspan="2">
							<label><?php esc_html_e( 'Icons', 'slz-core' );?></label>
							<p class="description"><?php esc_html_e( 'Please go on "MedicPlus->', 'slz-core' ).printf( "%s", $admin_icon_url ). esc_html_e( ' to referentce about icons of our theme.', 'slz-core' );?></p>
						</th>
					</tr>
					<tr class="">
						<td>
							<?php echo ( $this->drop_down_list( $prefix . 'meta['.$prefix.'icon]',
																		$this->get_field( $data_meta, 'icon' ),
																		$icons,
																		array('class'=>'slz-select2') ) );?>
						</td>
					</tr>
					<tr class="last">
						<th scope="row" colspan="2">
							<label><?php esc_html_e( 'Small Images', 'slz-core' );?></label>
							<p class="description"><?php esc_html_e( 'Images should have minimum size: 200x200. Bigger size images will be cropped automatically. Image will be show at list of service has image.', 'slz-core' );?></p>
						</th>
					</tr>
					<tr class="last">
						<td colspan="2">
							<?php echo ( $this->single_image( $prefix .'meta['. $prefix .'small_image]',
									$this->get_field( $data_meta, 'small_image' ),
									array( 'id'=> $prefix .'small_image_id',
										'data-rel' => $prefix .'small_image' ) ) );?>
						</td>
					</tr>
				</table>
			</div>

			<!-- Gallery -->
			<div id="slz-tab-gallery" class="tab-content">
				<table class="form-table">
					<tr class="last">
						<th scope="row" colspan="2">
							<label><?php esc_html_e( 'Gallery Images', 'slz-core' );?></label>
							<p class="description"><?php esc_html_e( 'Images should have minimum size: 750x500. Bigger size images will be cropped automatically.', 'slz-core' );?></p>
						</th>
					</tr>
					<tr class="">
						<td colspan="2">
							<?php $this->gallery( $prefix . 'meta['. $prefix .'gallery_image]', $data_meta['gallery_image'] ); ?>
						</td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>

</div>