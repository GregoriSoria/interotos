<?php $prefix='medicplus_team_'; ?>
<div class="tab-panel">
	<ul class="tab-list">
		<li class="active">
			<a href="slz-tab-team-general"><?php esc_html_e( 'General', 'slz-core' );?></a>
		</li>
		<li class="">
			<a href="slz-tab-team-social"><?php esc_html_e( 'Social', 'slz-core' );?></a>
		</li>
	</ul>
	<div class="tab-container">
		<div class="tab-wrapper slz-page-meta">
			<!-- General -->
			<div id="slz-tab-team-general" class="tab-content active">
				<table class="form-table">
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Information', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enter Team Information.', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_area( $prefix .'meta['.$prefix.'information]',
														$this->get_field( $data_meta, 'information' ),
														array('class'=>'slz-block','rows' => '6') ) );?>
						</td>
					</tr>
					<!-- Department Head -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Select Department', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose department for Team. Hold down the Ctrl key and left-click to select multiple.', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php
							$params = array('empty' => esc_html__( '-- None --', 'slz-core' ) );
							$args = array('post_type' => 'medicplus_dept');
							$arr_accommodation = Medicplus_Core_Com::get_post_id2title( $args, $params );
							echo ( $this->list_box( $prefix .'meta['. $prefix .'department]',
												$this->get_field( $data_meta, 'department' ),
												$arr_accommodation,
												array('class' => 'slz-block-half f-left', 'size' => '10', 'multiple' => true) ) );
							$new_link = 'post-new.php?post_type=medicplus_dept';
							printf('<a class="btn_plus" href="%1$s" title="%2$s" target="_blank">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</a>',
									esc_attr( $new_link ),
									esc_html__( 'Add new Department', 'slz-core' )
								);
							?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Position', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enter Position of Him (or Her).', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( $prefix .'meta['.$prefix.'position]',
														$this->get_field( $data_meta, 'position' ),
														array('class'=>'slz-block') ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Phone', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enter Phone Number to Contact.', 'slz-core' ) );?></span>

						</th>
						<td>
							<?php echo ( $this->text_field( $prefix .'meta['.$prefix.'phone]',
														$this->get_field( $data_meta, 'phone' ),
														array('class'=>'slz-block') ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Email', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enter Email to Contact.', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( $prefix .'meta['.$prefix.'email]',
														$this->get_field( $data_meta, 'email' ),
														array('class'=>'slz-block') ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Skype', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enter Skype Name being used.', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( $prefix .'meta['.$prefix.'skype]',
														$this->get_field( $data_meta, 'skype' ),
														array('class'=>'slz-block') ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Signature 1', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Upload signature transparent image for "SLZ Team Simple - Style 1" shortcode. Max Size is 183x149 px', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->single_image( $prefix .'meta['. $prefix .'signature]',
										$this->get_field( $data_meta, 'signature' ),
										array( 'id'=> $prefix .'signature_id',
											'data-rel' => $prefix .'signature' ) ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Signature 2', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Upload signature transparent image for "SLZ Team Simple - Style 2" shortcode. Max Size is 101x83 px', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->single_image( $prefix .'meta['. $prefix .'signature2]',
										$this->get_field( $data_meta, 'signature2' ),
										array( 'id'=> $prefix .'signature2_id',
											'data-rel' => $prefix .'signature2' ) ) );?>
						</td>
					</tr>
				</table>
			</div>

			<!-- Social-->
			<div id="slz-tab-team-social" class="tab-content">
				<table class="form-table">
					<?php $social_group = Medicplus_Core_Params::get( 'teammbox-social');
						foreach( $social_group as $social => $social_text ):
							$fieldname = 'medicplus_team_meta['.$prefix.$social.']';
						?>
						<tr>
							<th scope="row">
								<label><?php echo esc_attr( $social_text );?></label>
							</th>
							<td>
								<?php echo ( $this->text_field( $fieldname,
																$this->get_field( $data_meta, $social ),
																array( 'class' => 'slz-block' ) ) );?>
							</td>
						</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>
</div>