<?php
	// Slider Revolution
	global $wpdb;
	$revolution_sliders = array( '' => esc_html('No Slider', 'medicplus') );
	if( MEDICPLUS_REVSLIDER_ACTIVE ) {
		$db_revslider = $wpdb->get_results( $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'revslider_sliders %', '')  );
		if ( $db_revslider ) {
			foreach ( $db_revslider as $slider ) {
				$revolution_sliders[$slider->alias] = $slider->title;
			}
		}
	}

	// post
	$image_uri = get_template_directory_uri() . '/assets/admin/images/';
	$img_options = array( 'class' => 'slz-block-9' );
	$header_layout = Medicplus_Params::get( 'header_layout');
	$header_layout = $this->radio_image_label( $header_layout, $image_uri, $img_options );
	$html_options = array(
		'separator'    => '',
		'class'        => 'slz-w190 hide',
		'labelOptions' => array(
			'class'          => ' slz-image-select ',
			'selected_class' => ' slz-image-select-selected ',
		)
	);
	//sidebar
	$sidebar_layout = 'sidebar_layout';
	$sidebar_layout_id = 'sidebar_id';
	$screen = get_current_screen();
	$sidebar_screen = array(
		'post' => 'sidebar_post_layout',
	);
	$pt_bg_image_show = true;
	$pt_bg_prefix = 'pt_';
	$is_page = false;
	if( $screen ) {
		$screen_type = $screen->post_type;
		switch( $screen_type ) {
			case 'page':
				$is_page = true;
				break;
			case 'post':
				$sidebar_layout = 'sidebar_post_layout';
				$sidebar_layout_id = 'sidebar_post_id';
				break;
			case 'product':
				$sidebar_layout = 'sidebar_shop_layout';
				$sidebar_layout_id = 'sidebar_shop_id';
				break;
			case 'medicplus_dept':
				$sidebar_layout = 'sidebar_department_layout';
				$sidebar_layout_id = 'sidebar_department_id';
				break;
			case 'medicplus_service':
				$sidebar_layout = 'sidebar_service_layout';
				$sidebar_layout_id = 'sidebar_service_id';
				break;
		}
	}
	$footer_style = $this->get_field( $page_options, 'footer_style', $defaults );
	if( empty($footer_style)) {
		$footer_style = 'dark';
	}
?>
<div class="tab-panel slz-tab-mbox">
	<ul class="tab-list">
		<li class="slz-tab active slz-tab-general">
			<a href="slz-tab-page-general"><?php esc_html_e( 'General', 'medicplus' );?></a>
		</li>
		<li class="slz-tab">
			<a href="slz-tab-page-header"><?php esc_html_e( 'Header', 'medicplus' );?></a>
		</li>
		<li class="slz-tab">
			<a href="slz-tab-page-pagetitle"><?php esc_html_e( 'Page Title', 'medicplus' );?></a>
		</li>
		<li class="slz-tab">
			<a href="slz-tab-page-sidebar"><?php esc_html_e( 'Sidebar', 'medicplus' );?></a>
		</li>
		<li class="slz-tab">
			<a href="slz-tab-page-footer"><?php esc_html_e( 'Footer', 'medicplus' );?></a>
		</li>
	</ul>
	<div class="tab-container">
		<div class="tab-wrapper slz-page-meta">
			<!-- General -->
			<div id="slz-tab-page-general" class="tab-content active slz-tab-general">
				<table class="form-table">
					<?php if( $is_page ):?>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Header Shortcode', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Please use Visual Composer to edit shortcode after that copy and paste here. Ex: [slzcore_appointment_sc contact_form="1718"].', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_area( 'medicplus_page_options[sc_appointment]',
																	$this->get_field( $page_options, 'sc_appointment' ),
																	array( 'class' => 'slz-block' ) ) );?>
						</td>
					</tr>
					<?php endif;?>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Choose Slider', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( wp_kses(esc_html__( 'Display or not slider in the page.<br/> Default no display slider in the page. To add new slider, please go to .', 'medicplus' ), array('br') ) .'<a href="'.esc_url(admin_url( 'revslider.php' )).'" >Slider Revolutions</a>' );?></span>
						</th>
						<td>
							<?php echo ( $this->drop_down_list( 'medicplus_page_options[revolution_slider]',
																	$this->get_field( $page_options, 'revolution_slider', $defaults ),
																	$revolution_sliders,
																	array( 'class' => 'slz-w190' ) ) );?>
							
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Hide Header', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide header.', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->drop_down_list( 'medicplus_page_options[slider-header-fixed]',
																	$this->get_field( $page_options, 'slider-header-fixed' ),
																	$params['show_header'],
																	array( 'class' => 'slz-w190' ) ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Body Extra Class', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Add custom class if you want to change style of your site.', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[body_extra_class]',
																$this->get_field( $page_options, 'body_extra_class' ),
																array() ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enter content top/bottom padding (px)', 'medicplus' ) );?></span>
							<label><?php wp_kses(_e( 'Content Padding <br/> (Top/Bottom)', 'medicplus' ), array('br' => array()));?></label>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[ct_padding_top]',
																$this->get_field( $page_options, 'ct_padding_top' ),
																array( 'class' => '' ) ) );?>
							<?php echo ( $this->text_field( 'medicplus_page_options[ct_padding_bottom]',
																$this->get_field( $page_options, 'ct_padding_bottom' ),
																array( 'class' => '' ) ) );?>
						</td>
					</tr>
					<!-- Default -->
					<tr>
						<th scope="row">
							<label><?php echo ( $this->check_box( 'medicplus_page_options[general_default]',
																	$this->get_field( $page_options, 'general_default', 1 ),
																	array( 'class' => 'slz-general-option' ) ) );
									esc_html_e( 'Default Setting', 'medicplus' )?></label>
							<span class="f-right"><?php $this->tooltip_html(esc_html__( 'Using setting of theme options. All below setting will NOT be allowed. Uncheck to change setting this page.', 'medicplus' ) );?></span>
						</th>
						<td></td>
					</tr>
				</table>
				<table id="div_slz_general_option" class="form-table <?php echo ( $this->get_field( $page_options, 'general_default', 1 )? 'hide' : '' ); ?>">
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Body Background', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html(esc_html__( 'Setting background in the page.', 'medicplus' ) .'<br/>background-color <br/>background-repeat, background-size <br/>background-attachment, background-position <br/>background-image' );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[background_color]',
																$this->get_field( $page_options, 'background_color', $defaults ),
																array('class' => 'slzcore-meta-color') ) );?>
							<span class="valign-top">
								<?php echo (  $this->check_box( 'medicplus_page_options[background_transparent]',
																	$this->get_field( $page_options, 'background_transparent', $defaults ),
																	array( 'id'=>'background_transparent_id' ,'value' => 'transparent') ) );
									esc_html_e( 'Transparent', 'medicplus' );?>
							</span>
							<br/>
							<div><?php echo ( $this->drop_down_list( 'medicplus_page_options[background_repeat]',
																		$this->get_field( $page_options, 'background_repeat', $defaults ),
																		$params['background-repeat'],
																		array( 'class' => 'slz-w200' ) ) );?>
								<?php echo ( $this->drop_down_list( 'medicplus_page_options[background_size]',
																		$this->get_field( $page_options, 'background_size', $defaults ),
																		$params['background-size'],
																		array( 'class' => 'slz-w200' ) ) );?>
								
							</div>
							<br/>
							<div>
								<?php echo ( $this->drop_down_list( 'medicplus_page_options[background_attachment]',
																		$this->get_field( $page_options, 'background_attachment', $defaults ),
																		$params['background-attachment'],
																		array( 'class' => 'slz-w200' ) ) );?>
								<?php echo ( $this->drop_down_list( 'medicplus_page_options[background_position]',
																		$this->get_field( $page_options, 'background_position', $defaults ),
																		$params['background-position'],
																		array( 'class' => 'slz-w200' ) ) ); ?>
								
							</div>
							<br/>
							<div class="bg-image">
								<?php echo ( $this->text_field( 'medicplus_page_options[background_image]',
																	esc_attr( $params['bg_image']['url'] ),
																	array( 'id' => 'slz_bg_image_name', 'readonly'=>'readonly', 'class'=> 'slz-block') ) );?>
								<input type="hidden" name="medicplus_page_options[background_image_id]" id="slz_bg_image_id" value="<?php echo esc_attr( $params['bg_image']['id'] ); ?>" />
								<div class="screenshot <?php echo esc_attr( $params['bg_image']['class'] );?>" >
									<img src="<?php echo esc_url( $params['bg_image']['url'] ); ?>" />
								</div>
								<br/>
								<input type="button" data-rel="slz_bg_image" class="button slz-btn-upload" value="<?php esc_html_e( 'Upload Image', 'medicplus' )?>" />
								<input type="button" data-rel="slz_bg_image" class="button slz-btn-remove <?php echo esc_attr( $params['bg_image']['class'] );?>" value="<?php esc_html_e( 'Remove', 'medicplus' )?>" />
							</div>
						</td>
					</tr>
				</table>
			</div>
			<!-- Header -->
			<div id="slz-tab-page-header" class="tab-content">
				<table class="form-table">
					<tr>
						<th scope="row">
							<label><?php echo ( $this->check_box( 'medicplus_page_options[header_default]',
																	$this->get_field( $page_options, 'header_default', 1 ),
																	array( 'class' => 'slz-header-option' ) ) );
									esc_html_e( 'Default Setting', 'medicplus' )?></label>
							<span class="f-right"><?php $this->tooltip_html(esc_html__( 'Using setting of theme options. All below setting will NOT be allowed. Uncheck to change setting this page.', 'medicplus' ) );?></span>
						</th>
						<td></td>
					</tr>
				</table>
				<table id="div_slz_header_option" class="form-table <?php echo ($this->get_field( $page_options, 'header_default', 1 )? 'hide' : '');?>">
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Header Sticky', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enable/Disable fixed header when scroll', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[header_sticky_enable]',
																	$this->get_field( $page_options, 'header_sticky_enable', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Enable', 'medicplus' )?></label>
						</td>
					</tr>
				</table>
			</div>
			<!-- Page Title -->
			<div id="slz-tab-page-pagetitle" class="tab-content">
				<table class="form-table">
					<tr>
						<th scope="row">
							<label><?php echo ( $this->check_box( 'medicplus_page_options[page_title_default]',
																	$this->get_field( $page_options, 'page_title_default', 1 ),
																	array( 'class' => 'slz-page-title-option' ) ) );
									esc_html_e( 'Default Setting', 'medicplus' )?></label>
							<span class="f-right"><?php $this->tooltip_html(esc_html__( 'Using setting of theme options. All below setting will NOT be allowed. Uncheck to change setting this page.', 'medicplus' ) );?></span>
						</th>
						<td></td>
					</tr>
				</table>
				<table id="div_slz_page_title_option" class="form-table <?php echo ($this->get_field( $page_options, 'page_title_default', 1 )? 'hide' : '');?>">
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Show Page Title', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide page title in the page', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[page_title_show]',
																	$this->get_field( $page_options, 'page_title_show', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Background Style', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html(esc_html__( 'Setting background of page title in the page.', 'medicplus' ) .'<br/>background-color <br/>background-repeat, background-size <br/>background-attachment, background-position <br/>background-image' );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options['.$pt_bg_prefix.'background_color]',
																$this->get_field( $page_options, $pt_bg_prefix.'background_color', $defaults ),
																array('class' => 'slzcore-meta-color') ) );?>
							<span class="valign-top">
								<?php echo ( $this->check_box( 'medicplus_page_options['.$pt_bg_prefix.'background_transparent]',
																	$this->get_field( $page_options, $pt_bg_prefix.'background_transparent', $defaults ),
																	array( 'class' => '', 'value' => 'transparent' ) ) );
									esc_html_e( 'Transparent', 'medicplus' )?>
							</span>
							<br/>
							<div><?php echo ( $this->drop_down_list( 'medicplus_page_options['.$pt_bg_prefix.'background_repeat]',
																		$this->get_field( $page_options, $pt_bg_prefix.'background_repeat', $defaults ),
																		$params['background-repeat'],
																		array( 'class' => 'slz-w200' ) ) );?>
								<?php echo ( $this->drop_down_list( 'medicplus_page_options['.$pt_bg_prefix.'background_size]',
																		$this->get_field( $page_options, $pt_bg_prefix.'background_size', $defaults ),
																		$params['background-size'],
																		array( 'class' => 'slz-w200' ) ) );?>
								
							</div>
							<br/>
							<div>
								<?php echo ( $this->drop_down_list( 'medicplus_page_options['.$pt_bg_prefix.'background_attachment]',
																		$this->get_field( $page_options, $pt_bg_prefix.'background_attachment', $defaults ),
																		$params['background-attachment'],
																		array( 'class' => 'slz-w200' ) ) );?>
								<?php echo ( $this->drop_down_list( 'medicplus_page_options['.$pt_bg_prefix.'background_position]',
																		$this->get_field( $page_options, $pt_bg_prefix.'background_position', $defaults ),
																		$params['background-position'],
																		array( 'class' => 'slz-w200' ) ) ); ?>
							</div>
							<br/>
							<?php if( $pt_bg_image_show ) :?>
							<div class="bg-image">
								<?php echo ( $this->text_field( 'medicplus_page_options[pt_background_image]',
																	esc_attr( $params['pt_bg_image']['url'] ),
																	array( 'id' => 'slz_pt_bg_image_name', 'readonly'=>'readonly', 'class' => 'slz-block' ) ) );?>
								<input type="hidden" name="medicplus_page_options[pt_background_image_id]" id="slz_pt_bg_image_id" value="<?php echo esc_attr( $params['pt_bg_image']['id'] ); ?>" />
								<div class="screenshot <?php echo esc_attr( $params['pt_bg_image']['class'] );?>" >
									<img src="<?php echo esc_url( $params['pt_bg_image']['url'] ); ?>" />
								</div>
								<br/>
								<input type="button" data-rel="slz_pt_bg_image" class="button slz-btn-upload" value="<?php esc_html_e( 'Upload Image', 'medicplus' )?>" />
								<input type="button" data-rel="slz_pt_bg_image" class="button slz-btn-remove <?php echo esc_attr( $params['pt_bg_image']['class'] );?>" value="<?php esc_html_e( 'Remove', 'medicplus' )?>" />
							</div>
							<?php endif;?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Insert page title height (px)', 'medicplus' ) );?></span>
							<label><?php esc_html_e( 'Height', 'medicplus' );?></label>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[pt_height]',
																$this->get_field( $page_options, 'pt_height', $defaults ),
																array( 'class' => '' ) ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Show Title', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide title in page title', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[title_show]',
																	$this->get_field( $page_options, 'title_show', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Type Page Title', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose type default Page Title will be display. Choose "Post Title" to show post title if it at page have post title. Choose "Level Title" to show label of the level  if it at page of archive, taxonomy or page has hierarchical', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->drop_down_list( 'medicplus_page_options[page_title_type_display]',
																	$this->get_field( $page_options, 'page_title_type_display' ),
																	array(
																		'' => esc_html__( '-None-', 'medicplus' ),
																		'post' => esc_html__( 'Post Title', 'medicplus' ),
																		'level' => esc_html__( 'Level Title', 'medicplus' )
																	),
																	array( 'class' => 'slz-page-title-type-display' ) ) );?>
						</td>
					</tr>
					<tr id="div_page_title_type_display" >
						<th scope="row">
							<label><?php esc_html_e( 'Custom Title', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Enter custom title to display in page title.', 'medicplus' ) );?></span>
							<p class="description" ></p>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[title_custom_content]',
																$this->get_field( $page_options, 'title_custom_content' ),
																array('class' => 'slz-block title_custom_content') ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Title Color', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Set title color in page title.', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[title_color]',
																$this->get_field( $page_options, 'title_color' ),
																array('class' => 'slzcore-meta-color') ) );?>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Show Breadcrumb', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide breadcrumb', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[breadcrumb_show]',
																	$this->get_field( $page_options, 'breadcrumb_show', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Breadcrumb Path Color', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Set color to breadcrumb in the page.', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[breadcrumb_color]',
																$this->get_field( $page_options, 'breadcrumb_color' ),
																array('class' => 'slzcore-meta-color') ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Breadcrumb Text Color', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Set color to breadcrumb in the page.', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'medicplus_page_options[breadcrumb_text_color]',
																$this->get_field( $page_options, 'breadcrumb_text_color' ),
																array('class' => 'slzcore-meta-color') ) );?>
						</td>
					</tr>
				</table>
			</div>
			<!-- Sidebar -->
			<div id="slz-tab-page-sidebar" class="tab-content">
				<table class="form-table">
					<tr>
						<th scope="row">
							<label><?php echo ( $this->check_box( 'medicplus_page_options[sidebar_default]',
																	$this->get_field( $page_options, 'sidebar_default', 1 ),
																	array( 'class' => 'slz-sidebar-option' ) ) );
									esc_html_e( 'Default Setting', 'medicplus' )?></label>
							<span class="f-right"><?php $this->tooltip_html(esc_html__( 'Using setting of theme options. All below setting will NOT be allowed. Uncheck to change setting this page.', 'medicplus' ) );?></span>
						</th>
						<td></td>
					</tr>
				</table>
				<table id="div_slz_sidebar_option" class="form-table <?php echo ($this->get_field( $page_options, 'sidebar_default', 1 )? 'hide' : '');?>">
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Sidebar Layout', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose locate to display sidebar in the page.', 'medicplus' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->drop_down_list( 'medicplus_page_options['.$sidebar_layout.']',
																	$this->get_field( $page_options, $sidebar_layout, $defaults ),
																	$params['sidebar_layout'],
																	array( 'class' => 'slz-w200' ) ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Sidebar Name', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose sidebar to display in the page. To add new sidebar, please go to ', 'medicplus' ) .'<a href="'.esc_url(admin_url( 'widgets.php' )).'" >Appearance>Widgets</a>' );?></span>
						</th>
						<td>
							<?php echo ( $this->drop_down_list( 'medicplus_page_options['.$sidebar_layout_id.']',
																	$this->get_field( $page_options, $sidebar_layout_id, $defaults ),
																	$params['regist_sidebars'],
																	array( 'class' => 'slz-w200', 'prompt' => 'Default sidebar') ) );?>
						</td>
					</tr>
				</table>
			</div>
			<!-- Footer -->
			<div id="slz-tab-page-footer" class="tab-content">
				<table class="form-table">
					<tr>
						<th scope="row">
							
							<label><?php echo ( $this->check_box( 'medicplus_page_options[footer_default]',
																	$this->get_field( $page_options, 'footer_default', 1 ),
																	array( 'class' => 'slz-footer-option' ) ) );
									esc_html_e( 'Default Setting', 'medicplus' )?></label>
							<span class="f-right"><?php $this->tooltip_html(esc_html__( 'Using setting of theme options. All below setting will NOT be allowed. Uncheck to change setting this page.', 'medicplus' ) );?></span>
						</th>
						<td></td>
					</tr>
				</table>
				<table id="div_slz_footer_option" class="form-table <?php echo ($this->get_field( $page_options, 'footer_default', 1 )? 'hide' : '');?>">
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Footer Section', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide footer', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[footer_show]',
																	$this->get_field( $page_options, 'footer_show', $defaults ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Footer Main', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide footer main', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[footer_bt_main_show]',
																	$this->get_field( $page_options, 'footer_bt_main_show', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Footer Bottom', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide footer bottom', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[footer_bottom_show]',
																	$this->get_field( $page_options, 'footer_bottom_show', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Footer Contact Information', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide contact information in footer', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[footer_contact_show]',
																	$this->get_field( $page_options, 'footer_contact_show', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Footer Contact Map', 'medicplus' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Show/Hide contact map in footer', 'medicplus' ) );?></span>
						</th>
						<td>
							<label><?php echo ( $this->check_box( 'medicplus_page_options[footer_contact_map_show]',
																	$this->get_field( $page_options, 'footer_contact_map_show', 1 ),
																	array( 'class' => '' ) ) );
									esc_html_e( 'Show', 'medicplus' )?></label>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>