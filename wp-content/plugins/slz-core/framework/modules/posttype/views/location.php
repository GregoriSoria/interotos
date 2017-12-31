<?php 
$prefix='medicplus_locate_';
$sh_icons = Medicplus_Core_Params::get('font_medic');
$awesome_icons = Medicplus_Core_Params::get('font_awesome');
$icons = array_merge( $sh_icons, $awesome_icons );
$admin_icon_url = '<a href="'.esc_url(admin_url( 'admin.php?page='.SLZCORE_THEME_PREFIX.'_icon' )).'" target="_blank">'.esc_html('Icons','slz-core').'</a>';

$data_features = Medicplus_Core::get_value( $data_meta, 'features');
$section_count = 0;
$section_format = '
	<div class="slz-section section-%1$s">
		<a href="javascript:void(0);" class="slz-section-remove slz-row-remove">&#10005' . esc_html__( 'Delete Section', 'slz-core' ) .'</a>
		<br/>
		<div class="slz-custom-meta">
			<div class="slz-meta-row" >
				<div class="slz-desc">
					<span>'. esc_html__( 'Features', 'slz-core' ) .'</span>
				</div>
				<div class="slz-field">
					%2$s
				</div>
			</div>
			<div class="slz-meta-row" >
				<div class="slz-desc">
					<span>'. esc_html__( 'Features Icon', 'slz-core' ) .'</span>
					<p>'. esc_html__( 'Please go on "MedicPlus->', 'slz-core' ).sprintf( "%s", $admin_icon_url ). esc_html__( ' to referentce about icons of our theme.', 'slz-core' ) .'</p>
				</div>
				<div class="slz-field">
					%3$s
				</div>
			</div>
		</div>
	</div>
';
$section_output = '';
if( $data_features ) {
	foreach( $data_features as $key => $row ) {
		$section_count = $key+1;
		$field_features = $this->text_field( $prefix . 'meta['. $prefix .'features]['.$key.']',
																		$this->get_field( $data_meta['features'], $key ),
																		array( 'class' => 'slz-block' ) );
		$field_features_icon = $this->drop_down_list( $prefix . 'meta['.$prefix.'features_icon]['.$key.']',
														$this->get_field( $data_meta['features_icon'], $key ),
														$icons,
														array('class'=>'') );
		$section_output .= sprintf( $section_format, $key, $field_features, $field_features_icon );
	}
}

?>
<!-- Address -->
<div class="slz-custom-meta slzcore-map-metabox" >
	<div class="slz-meta-row" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Address', 'slz-core' );?></span>
			<p><?php esc_html_e( 'Address of location.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php echo ( $this->text_field( $prefix . 'meta['. $prefix .'address]',
											$this->get_field( $data_meta, 'address' ),
											array( 'class' => 'slz-block slzcore-map-address ui-autocomplete-input' ) ) );?>
			<?php echo ( $this->hidden_field( $prefix . 'meta['. $prefix .'position]',
											$this->get_field( $data_meta, 'position' ),
											array( 'class' => 'slz-block slzcore-map-location' ) ) );?>
			<?php echo ( $this->button_field( 'find_location',
											esc_html( 'Find', 'slz-core' ),
											array( 'class'=>'find-address slzcore-find-address-button') ) );?>
		</div>
	</div>
	<div class="slz-meta-row" >
		<div class="slzcore_map_area"></div>
	</div>
	<div class="slz-meta-row" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Address Icon', 'slz-core' );?></span>
			<p><?php esc_html_e( 'Please go on "MedicPlus->', 'slz-core' ).printf( "%s", $admin_icon_url ). esc_html_e( ' to referentce about icons of our theme.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php echo ( $this->drop_down_list( $prefix . 'meta['.$prefix.'address_icon]',
														$this->get_field( $data_meta, 'address_icon' ),
														$icons,
														array('class'=>'') ) );?>
		</div>
	</div>
</div>

<!-- Go To Map -->
<div class="slz-custom-meta" >
	<div class="slz-meta-row" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Go To Map', 'slz-core' );?></span>
			<p><?php esc_html_e( 'Go To Map Text of location.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php echo ( $this->text_field( $prefix . 'meta['. $prefix .'go_to_map]',
																$this->get_field( $data_meta, 'go_to_map' ),
																array( 'class' => 'slz-block' ) ) );?>
		</div>
	</div>
	<div class="slz-meta-row" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Go To Map Icon', 'slz-core' );?></span>
			<p><?php esc_html_e( 'Please go on "MedicPlus->', 'slz-core' ).printf( "%s", $admin_icon_url ). esc_html_e( ' to referentce about icons of our theme.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php echo ( $this->drop_down_list( $prefix . 'meta['.$prefix.'go_to_map_icon]',
														$this->get_field( $data_meta, 'go_to_map_icon' ),
														$icons,
														array('class'=>'') ) );?>
		</div>
	</div>
</div>

<!-- Direction -->
<div class="slz-custom-meta" >
	<div class="slz-meta-row" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Direction', 'slz-core' );?></span>
			<p><?php esc_html_e( 'Direction text of location.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php echo ( $this->text_field( $prefix . 'meta['. $prefix .'direction]',
																$this->get_field( $data_meta, 'direction' ),
																array( 'class' => 'slz-block' ) ) );?>
		</div>
	</div>
	<div class="slz-meta-row" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Direction Icon', 'slz-core' );?></span>
			<p><?php esc_html_e( 'Please go on "MedicPlus->', 'slz-core' ).printf( "%s", $admin_icon_url ). esc_html_e( ' to referentce about icons of our theme.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php echo ( $this->drop_down_list( $prefix . 'meta['.$prefix.'direction_icon]',
														$this->get_field( $data_meta, 'direction_icon' ),
														$icons,
														array('class'=>'') ) );?>
		</div>
	</div>
</div>

<!-- Phone -->
<div class="slz-custom-meta" >
	<div class="slz-meta-row" >
		<div class="slz-desc">
			<span><?php esc_html_e( 'Phone', 'slz-core' );?></span>
			<p><?php esc_html_e( 'Phone of location.', 'slz-core' );?></p>
		</div>
		<div class="slz-field">
			<?php echo ( $this->text_field( $prefix . 'meta['. $prefix .'phone]',
																$this->get_field( $data_meta, 'phone' ),
																array( 'class' => 'slz-block' ) ) );?>
		</div>
	</div>
</div>

<!-- Features -->
<div class="slz-custom-meta" >
	<table class="form-table">
		<tr>
			<th scope="row">
				<h3><?php esc_html_e( 'Features', 'slz-core' );?></h3>
			</th>
			<td>
				<input type="button" class="button button-primary slz-add-section" data-item="<?php echo esc_attr($section_count)?>" data-name="<?php echo esc_attr( $prefix .'meta['. $prefix .'features]' )?>" data-name-icon="<?php echo esc_attr( $prefix .'meta['. $prefix .'features_icon]' )?>" data-container=".slz-section-container" value="<?php esc_html_e( 'Add Section', 'slz-core' );?>" />
			</td>
		</tr>
		<tr>
			<td scope="row" colspan="2" >
				<div class="slz-section-container postbox-container">
						<?php
							printf( '<div class="inside content">%s</div>', $section_output );
						?>
				</div>
			</td>
		</tr>
	</table>
</div>



<div class="slz-section-clone hide">
	<div class="slz-section">
		<a href="javascript:void(0);" class="slz-section-remove slz-row-remove"><?php echo '&#10005' . esc_html__( 'Delete Section', 'slz-core' );?></a>
		<br/>
		<div class="slz-custom-meta" >
			<div class="slz-meta-row" >
				<div class="slz-desc">
					<span><?php esc_html_e( 'Features', 'slz-core' );?></span>
				</div>
				<div class="slz-field">
					<?php echo ( $this->text_field( 'section_name',
																		'',
																		array( 'class' => 'slz-block' ) ) );?>
				</div>
			</div>
			<div class="slz-meta-row" >
				<div class="slz-desc">
					<span><?php esc_html_e( 'Features Icon', 'slz-core' );?></span>
					<p><?php esc_html_e( 'Please go on "MedicPlus->', 'slz-core' ).printf( "%s", $admin_icon_url ). esc_html_e( ' to referentce about icons of our theme.', 'slz-core' );?></p>
				</div>
				<div class="slz-field">
					<?php echo ( $this->drop_down_list( 'section_name_icon',
																'',
																$icons,
																array('class'=>'') ) );?>
				</div>
			</div>
		</div>
	</div>
</div>