<?php
$alignment    = Medicplus_Core_Params::get('align');
$args         = array( 'post_type' => 'wpcf7_contact_form' );
$option       = array( 'empty' => esc_html__( '-- Choose contact form --',  'slz-core' ) );
$contact_form = Medicplus_Core_Com::get_post_title2id( $args, $option );

$params = array(
	array(
		'type'        => 'textfield',
		"holder"      => "div",
		"class"       => "",
		'heading'     => esc_html__( 'Button Text', 'slz-core' ),
		'param_name'  => 'title',
		'description' => esc_html__( 'Enter text on the button',  'slz-core'  )
	),
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Alignment', 'slz-core' ),
		'param_name'      => 'alignment',
		'value'           => $alignment,
		'description'     => esc_html__( 'Select alignment to display.', 'slz-core' ),
	),
	array(
		'type'        => 'vc_link',
		"class"       => "",
		'heading'     => esc_html__( 'URL (Link)', 'slz-core' ),
		'param_name'  => 'url',
		'description' => esc_html__( 'Add link to button.',  'slz-core'  )
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Show Contact Form', 'slz-core' ),
		'param_name'      => 'open_form',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'description'     => esc_html__( 'Checked to show contact form when click on button.', 'slz-core' ),
	),
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Choose Contact Form', 'slz-core' ),
		'param_name'      => 'contact_form',
		'value'           => $contact_form,
		'description'     => esc_html__( 'Choose contact form that will be displayed when click on button.', 'slz-core' ),
		'dependency' => array(
			'element' => 'open_form',
			'value'   => array( 'yes' )
		)
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Background Transparent', 'slz-core' ),
		'param_name'      => 'bg_transparent',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'description' => esc_html__( 'Checked to background button transparent.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Color', 'slz-core' ),
		'param_name'      => 'button_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for button.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Color Hover', 'slz-core' ),
		'param_name'      => 'button_color_hover',
		'value'           => '',
		'description'     => esc_html__( 'Select color for button.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Text Color', 'slz-core' ),
		'param_name'      => 'text_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for button text.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Text Color Hover', 'slz-core' ),
		'param_name'      => 'text_color_hover',
		'value'           => '',
		'description'     => esc_html__( 'Select color for button text when hover.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Button Color', 'slz-core' ),
		'param_name'      => 'border_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for border button color.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Button Color Hover', 'slz-core' ),
		'param_name'      => 'border_color_hover',
		'value'           => '',
		'description'     => esc_html__( 'Select color for border button when hover.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'      => 'extra_class',
		'description'     => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'slz-core' )
	)
);

vc_map(
	array(
		"name"			=> esc_html__( 'SLZ Button', 'slz-core' ),
		"base"			=> "slzcore_button_sc",
		"class"			=> "slzcore-sc",
		"category"		=> SLZCORE_SC_CATEGORY,
		'icon'			=> 'icon-slzcore_button_sc',
		"description"	=> esc_html__( 'Easy to create your button.', 'slz-core' ),
		"params"		=> $params
	)
);
