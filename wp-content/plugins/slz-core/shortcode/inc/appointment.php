<?php
$style  = array(
	esc_html__('Style 1', 'slz-core')		=> '1',
	esc_html__('Style 2', 'slz-core')		=> '2',
	esc_html__('Style 3', 'slz-core')		=> '3',
	esc_html__('Style 4. New update.', 'slz-core')		=> '4',
);
$contact_form_arr = array(esc_html__( '-None-', 'slz-core' ) => '');
$args = array (
			'post_type'        => 'wpcf7_contact_form',
			'post_per_page'    => -1,
			'status'           => 'publish',
			'suppress_filters' => false,
		);
$post_arr = get_posts( $args );
foreach( $post_arr as $post ){
	$k = ( !empty( $post->post_title ) )? $post->post_title : $post->post_name;
	$contact_form_arr[$k] =  $post->ID ;
}

$params = array(
	array(
		'type'            => 'dropdown',
		"holder"		  => "div",
		'heading'         => esc_html__( 'Style', 'slz-core' ),
		'param_name'      => 'style',
		'value'           => $style,
		'description'     => esc_html__( 'Select style will be displayed.', 'slz-core' ),
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Insert Container', 'slz-core' ),
		'param_name'      => 'is_container',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'description' => esc_html__( 'Checked to insert container for full width.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '4' ),
		),
	),
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Contact Form', 'slz-core' ),
		'param_name'      => 'contact_form',
		'value'           => $contact_form_arr,
		'description'     => esc_html__( 'Select contact form to display.', 'slz-core' ),
	),
	array(
		'type'        	=> 'textfield',
		"holder"		  => "div",
		'heading'     	=> esc_html__( 'Box Title', 'slz-core' ),
		'param_name'  	=> 'title_box',
		'value'       	=> '',
		'description' 	=> esc_html__( 'Enter title of box.', 'slz-core' ),
	),
	array(
		'type'        	=> 'textfield',
		'heading'     	=> esc_html__( 'Title', 'slz-core' ),
		'param_name'  	=> 'title',
		'value'       	=> '',
		'description' 	=> esc_html__( 'Enter title of form.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'        	=> 'textarea',
		'heading'     	=> esc_html__( 'Descrition', 'slz-core' ),
		'param_name'  	=> 'description',
		'value'       	=> '',
		'description' 	=> esc_html__( 'Enter descrition of form.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'     => 'extra_class',
		'description'    => esc_html__( 'Enter extra class name.', 'slz-core' ),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Error Color', 'slz-core' ),
		'param_name'      => 'color_error',
		'description'     => esc_html__( 'Choose color for error filed, notification response box.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Box Background', 'slz-core' ),
		'param_name'      => 'background_box',
		'description'     => esc_html__( 'Choose color for box background.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Box Border', 'slz-core' ),
		'param_name'      => 'border_box',
		'description'     => esc_html__( 'Choose color for box border.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Head Box Background', 'slz-core' ),
		'param_name'      => 'background_head',
		'description'     => esc_html__( 'Choose color for head head box background.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '1', '2', '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Head Box Title Color', 'slz-core' ),
		'param_name'      => 'color_text_head',
		'description'     => esc_html__( 'Choose color for head box title color.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Box Head Line Title Color', 'slz-core' ),
		'param_name'      => 'color_line_head',
		'description'     => esc_html__( 'Choose color for box head line title.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Inner Title Color', 'slz-core' ),
		'param_name'      => 'color_title',
		'description'     => esc_html__( 'Choose color for inner title.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Input Color', 'slz-core' ),
		'param_name'      => 'color_input',
		'description'     => esc_html__( 'Choose color for input.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Input Line Color', 'slz-core' ),
		'param_name'      => 'color_input_line',
		'description'     => esc_html__( 'Choose color for input line.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Text Color', 'slz-core' ),
		'param_name'      => 'color_text_button',
		'description'     => esc_html__( 'Choose color for button text.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Text Color Hover', 'slz-core' ),
		'param_name'      => 'color_text_button_hv',
		'description'     => esc_html__( 'Choose color for text button when hover.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Background', 'slz-core' ),
		'param_name'      => 'background_button',
		'description'     => esc_html__( 'Choose color for button background.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Background Hover', 'slz-core' ),
		'param_name'      => 'background_button_hv',
		'description'     => esc_html__( 'Choose color for button background when hover.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Border Color', 'slz-core' ),
		'param_name'      => 'border_button',
		'description'     => esc_html__( 'Choose color for button border.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button  Border Color Hover', 'slz-core' ),
		'param_name'      => 'border_button_hv',
		'description'     => esc_html__( 'Choose color for button border when hover.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Appointment', 'slz-core' ),
	'base'        => 'slzcore_appointment_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_appointment_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'Form appointment.', 'slz-core' ),
	'params'      => $params
));