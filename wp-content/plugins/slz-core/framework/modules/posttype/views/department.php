<?php
	$prefix = 'medicplus_dept_';
?>
<div class="tab-panel">

	<ul class="tab-list">
		<li class="active">
			<a href="slz-tab-general"><?php esc_html_e( 'General', 'slz-core' );?></a>
		</li>
		<li class="">
			<a href="slz-tab-member"><?php esc_html_e( 'Member', 'slz-core' );?></a>
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
					<!-- Department Information -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Department Information', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Department information', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_area( $prefix .'meta['. $prefix .'department_info]',
																$this->get_field( $data_meta, 'department_info' ),
																array( 'class' => 'slz-block' ,'rows' => '6') ) );?>
						</td>
					</tr>
					<!-- Department Head -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Department Head', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose team for Department Head.', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php
							$params = array('empty' => esc_html__( '-- None --', 'slz-core' ) );
							$args = array('post_type' => 'medicplus_team');
							$arr_accommodation = Medicplus_Core_Com::get_post_id2title( $args, $params );
							echo ( $this->drop_down_list( $prefix .'meta['. $prefix .'department_head]',
												$this->get_field( $data_meta, 'department_head' ),
												$arr_accommodation,
												array('class' => 'slz-block-half f-left') ) );
							$new_link = 'post-new.php?post_type=medicplus_team';
							printf('<a class="btn_plus" href="%1$s" title="%2$s" target="_blank">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</a>',
									esc_attr( $new_link ),
									esc_html__( 'Add new Team', 'slz-core' )
								);
							?>
						</td>
					</tr>
					<!-- Department Head Information -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Department Head Information', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Department Head information', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_area( $prefix .'meta['. $prefix .'department_head_info]',
																$this->get_field( $data_meta, 'department_head_info' ),
																array( 'class' => 'slz-block' ,'rows' => '6') ) );?>
						</td>
					</tr>
				</table>
			</div>

			<!-- Team Member -->
			<div id="slz-tab-member" class="tab-content">
				<table class="form-table">
					<!-- Show Member box? -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Show Member Box?', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose SHOW to show member box', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php 
							$arr_show_none = array(
									'yes'  => esc_html__( 'Show', 'slz-core' ),
									'no'   => esc_html__( 'None', 'slz-core' ),
								);
							echo ( $this->drop_down_list( $prefix .'meta['. $prefix .'show_member_box]',
												$this->get_field( $data_meta, 'show_member_box' ),
												$arr_show_none,
												array('class' => 'slz-block-half') ) );
							?>
						</td>
					</tr>
					<!-- Box title -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Box Title', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Title of member box', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( $prefix .'meta['. $prefix .'box_title]',
																$this->get_field( $data_meta, 'box_title' ),
																array( 'class' => 'slz-block' ) ) );?>
						</td>
					</tr>
					<!-- Information -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Information', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Information of member box', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_area( $prefix .'meta['. $prefix .'information_member]',
																$this->get_field( $data_meta, 'information_member' ),
																array( 'class' => 'slz-block' ,'rows' => '6') ) );?>
						</td>
					</tr>
				</table>
				
			</div>

			<!-- Gallery -->
			<div id="slz-tab-gallery" class="tab-content">
				<table class="form-table">
					<!-- Show Gallery? -->
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Show Gallery?', 'slz-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose SHOW to show gallery box', 'slz-core' ) );?></span>
						</th>
						<td>
							<?php 
							$arr_show_none = array(
									'yes' => esc_html__( 'Show', 'slz-core' ),
									'no'  => esc_html__( 'None', 'slz-core' ),
								);
							echo ( $this->drop_down_list( $prefix .'meta['. $prefix .'show_gallery]',
												$this->get_field( $data_meta, 'show_gallery' ),
												$arr_show_none,
												array('class' => 'slz-block-half') ) );
							?>
						</td>
					</tr>
					<tr class="last">
						<th scope="row" colspan="2">
							<label><?php esc_html_e( 'Gallery Images', 'slz-core' );?></label>
							<p class="description"><?php esc_html_e( 'Images should have minimum size: 720x429. Bigger size images will be cropped automatically.', 'slz-core' );?></p>
						</th>
					</tr>
					<tr class="last">
						<td colspan="2">
							<?php $this->gallery( $prefix . 'meta['. $prefix .'gallery_image]', $data_meta['gallery_image'] ); ?>
						</td>
					</tr>					
				</table>
				
			</div>
		</div>
	</div>

</div>
