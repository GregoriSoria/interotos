<?php
	$prefix = 'medicplus_appoint_';
?>
<div class="tab-panel">

	<ul class="tab-list">
		<li class="active">
			<a href="slz-tab-general"><?php esc_html_e( 'General', 'slz-core' );?></a>
		</li>
		<li class="">
			<a href="slz-tab-customer"><?php esc_html_e( 'Customer Info', 'slz-core' );?></a>
		</li>
	</ul>
	<div class="tab-container">
		<div class="tab-wrapper slz-page-meta">
			<!-- Group General -->
			<div id="slz-tab-general" class="tab-content active">
				<table class="form-table">
					<!-- Status -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Status', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose appointment status.', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php
							$params = array('empty' => esc_html__( '-- None --', 'slz-core' ) );
							$args = array('hide_empty' => false);
							$tour_status = Medicplus_Core_Com::get_tax_options_id2name( 'medicplus_appoint_status', 
																					$params, $args );
							echo ( $this->drop_down_list( $prefix.'meta['. $prefix .'status]',
												$this->get_field( $data_meta, 'status' ),
												$tour_status,
												array('class' => 'slz-block-half f-left') ) );
							$new_link = 'edit-tags.php?taxonomy=medicplus_appoint_status&post_type=medicplus_appoint';
							printf('<a class="btn_plus" href="%1$s" title="%2$s" target="_blank">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</a>',
									esc_attr( $new_link ),
									esc_html__( 'Add new status', 'slz-core' )
								);
							?>
						</td>
					</tr>
					<!-- Description -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Description', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Short description for appointment.', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_area( $prefix .'meta['. $prefix .'description]',
																$this->get_field( $data_meta, 'description' ),
																array( 'class' => 'slz-block' ,'rows' => '6') ) );?>
						</td>
					</tr>
				</table>
			</div>

			<!-- Team Information-->
			<div id="slz-tab-customer" class="tab-content">
				<table class="form-table">
					<!-- Name -->
					<?php
					$fields = $this->get_field( $data_meta, 'fields' );
					if ( !empty($fields) ) {
						foreach ($fields as $key => $value) {
					?>
						<tr>
							<th scope="row">
								<label><?php printf( '%s', esc_html( $key ) ) ?></label>
							</th>
							<td>
								<?php echo ( $this->text_field( $prefix .'meta['. $prefix . $key .']', get_post_meta( get_the_ID(), $prefix . $key, true ), array( 'class' => 'slz-block' ) ) );?>
							</td>
						</tr>
					<?php
						}
					} else {
						printf( '<p>%s</p>', esc_html__( 'No content', 'slz-core' ) );
					}

					$meta = $this->get_field( $data_meta, 'meta' );
					if ( !empty($meta) ) {
						foreach ($meta as $key => $value) {
					?>
						<tr>
							<th scope="row">
								<label><?php printf( '%s', esc_html( $key ) ) ?></label>
							</th>
							<td>
								<?php printf( '%s', esc_html( $value ) ) ?>
							</td>
						</tr>
					<?php
						}
					}
					?>
				</table>
				
			</div>
		</div>
	</div>

</div>
