<?php
$style  = array(
	esc_html__('Style 1', 'slz-core') 	=> '1',
	esc_html__('Style 2', 'slz-core')	=> '2',
);
$params = array(
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Style', 'slz-core' ),
		'param_name'  => 'style',
		'value'       => $style,
		'description' => esc_html__( 'Choose style to display.', 'slz-core' )
	),
	array(
		"type"        => "textfield",
		"class"       => "",
		"heading"     => esc_html__( 'Title', 'slz-core' ),
		"param_name"  => "title",
		"description" => esc_html__( 'Enter title here. The title can not be empty !', 'slz-core' )
	),
	array(
		"type"        => "textarea_html",
		"class"       => "",
		"heading"     => esc_html__( "Description", 'slz-core' ),
		"param_name"  => "content",
		"description" => esc_html__( "Enter the banner description", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		"type"        => "attach_image",
		"class"       => "",
		"heading"     => esc_html__( 'Image', 'slz-core' ),
		"param_name"  => "image",
		"description" => esc_html__( 'Upload the banner image. Set empty to remove it.', 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		"type"        => "textfield",
		"class"       => "",
		"heading"     => esc_html__( 'Image Height', 'slz-core' ),
		"param_name"  => "image_height",
		"description" => esc_html__( 'Enter image height here. Example: 500px', 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		"type"        => "attach_image",
		"class"       => "",
		"heading"     => esc_html__( "Background Image", 'slz-core' ),
		"param_name"  => "background",
		"description" => esc_html__( "Upload the background image. Leave empty to remove it.", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"heading"     => esc_html__( "Background Color", 'slz-core' ),
		"param_name"  => "background_color",
		"description" => esc_html__( "Choose the background color.", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'Button', 'slz-core' ),
		'param_name'      => 'array_button',
		'params'          => array(
			array(
				'type'        => 'textfield',
				'admin_label' => true,
				'heading'     => esc_html__( 'Button title', 'slz-core' ),
				'param_name'  => 'title',
				'description' => esc_html__( 'Enter text on the button',  'slz-core'  )
			),
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'URL (Link)', 'slz-core' ),
				'param_name'  => 'url',
				'description' => esc_html__( 'Add link to button.',  'slz-core'  )
			),
			array(
				'type'            => 'checkbox',
				'heading'         => esc_html__( 'Button Transparent', 'slz-core' ),
				'param_name'      => 'btn_transparent',
				'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
				'description'     => esc_html__( 'Checked to background button transparent.', 'slz-core' ),
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Button Color', 'slz-core' ),
				'param_name' 	=> 'color',
				'description' 	=> esc_html__( 'Select button color.', 'slz-core' ),
				'value' 		=> ''
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Button Color Hover', 'slz-core' ),
				'param_name' 	=> 'color_hover',
				'description' 	=> esc_html__( 'Select button color when hover.', 'slz-core' ),
				'value' 		=> ''
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Button Text Color', 'slz-core' ),
				'param_name' 	=> 'text_color',
				'description' 	=> esc_html__( 'Select button text color.', 'slz-core' ),
				'value' 		=> ''
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Button Text Color Hover', 'slz-core' ),
				'param_name' 	=> 'text_color_hover',
				'description' 	=> esc_html__( 'Select button text color when hover.', 'slz-core' ),
				'value' 		=> ''
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Button Border Color', 'slz-core' ),
				'param_name' 	=> 'border_color',
				'description' 	=> esc_html__( 'Select button text color.', 'slz-core' ),
				'value' 		=> ''
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Button Border Color Hover', 'slz-core' ),
				'param_name' 	=> 'border_color_hover',
				'description' 	=> esc_html__( 'Select button border color when hover.', 'slz-core' ),
				'value' 		=> ''
			),
		),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		'type'        => 'textfield',
		'admin_label' => true,
		'heading'     => esc_html__( 'Button Text', 'slz-core' ),
		'param_name'  => 'btn_text',
		'description' => esc_html__( 'Enter text on the button',  'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		'type'        => 'vc_link',
		'heading'     => esc_html__( 'URL (Link)', 'slz-core' ),
		'param_name'  => 'btn_url',
		'description' => esc_html__( 'Add link to button.',  'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		"type"        => "colorpicker",
		"value"		  => "",
		"heading"     => esc_html__( "Button Text Color", 'slz-core' ),
		"param_name"  => "text_color",
		"description" => esc_html__( "Choose color for button text", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		"type"        => "colorpicker",
		"value"		  => "",
		"heading"     => esc_html__( "Button Border Color", 'slz-core' ),
		"param_name"  => "border_color",
		"description" => esc_html__( "Choose color for button border", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Button Transparent', 'slz-core' ),
		'param_name'      => 'bg_transparent',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'description'     => esc_html__( 'Checked to background button transparent.', 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		"type"        => "colorpicker",
		"value"		  => "",
		"heading"     => esc_html__( "Button Background Color", 'slz-core' ),
		"param_name"  => "bg_color",
		"description" => esc_html__( "Choose color for button background", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		"type"        => "colorpicker",
		"value"		  => "",
		"heading"     => esc_html__( "Button Text Hover Color", 'slz-core' ),
		"param_name"  => "text_hov_color",
		"description" => esc_html__( "Choose hover color for button text", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		"type"        => "colorpicker",
		"value"		  => "",
		"heading"     => esc_html__( "Button Border Hover Color", 'slz-core' ),
		"param_name"  => "border_hov_color",
		"description" => esc_html__( "Choose hover color for button border", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		"type"        => "colorpicker",
		"value"		  => "",
		"heading"     => esc_html__( "Button Background Hover Color", 'slz-core' ),
		"param_name"  => "bg_hov_color",
		"description" => esc_html__( "Choose hover color for button background", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '2' )
		)
	),
	array(
		"type"        => "checkbox",
		"class"       => "",
		"value"		  => '',
		"std"		  => 'false',
		"heading"     => esc_html__( "Full Width ?", 'slz-core' ),
		"param_name"  => "full_width",
		"description" => esc_html__( "Show banner full width", 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'      => 'title_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for title.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array('1','2'),
		),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Description Color', 'slz-core' ),
		'param_name'      => 'description_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for description.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array('1'),
		),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'  => 'extra_class',
		'description' => esc_html__( 'Enter extra class.', 'slz-core' )
	)
);

vc_map(
	array(
		"name"			=> esc_html__( 'SLZ Banner', 'slz-core' ),
		"base"			=> "slzcore_banner_sc",
		"class"			=> "slzcore-sc",
		"category"		=> SLZCORE_SC_CATEGORY,
		'icon'			=> 'icon-slzcore_banner_sc',
		"description"	=> esc_html__( 'Easy to create your banner.', 'slz-core' ),
		"params"		=> $params
	)
);
