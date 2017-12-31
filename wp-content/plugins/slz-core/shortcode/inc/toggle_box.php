<?php
$params = array(
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Toggle Content', 'slz-core' ),
		'param_name' => 'toggle_content',
		'params'     => array(
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				'admin_label' => true,
				"heading"     => esc_html__( 'Title', 'slz-core' ),
				"param_name"  => "title",
				"description" => esc_html__( 'Enter title here', 'slz-core' )
			),
			array(
				"type"        => "textarea",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__( "Content", 'slz-core' ),
				"param_name"  => "content",
				"description" => esc_html__( "Enter content here", 'slz-core' )
			)
		)
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"heading"     => esc_html__( "Active Color", 'slz-core' ),
		"param_name"  => "active_color",
		"description" => esc_html__( "Choose the active color.", 'slz-core' ),
		'group'       => esc_html__('Options', 'slz-core'),
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"heading"     => esc_html__( "Inactive Color", 'slz-core' ),
		"param_name"  => "inactive_color",
		"description" => esc_html__( "Choose the inactive color.", 'slz-core' ),
		'group'       => esc_html__('Options', 'slz-core'),
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"heading"     => esc_html__( "Title Color", 'slz-core' ),
		"param_name"  => "title_color",
		"description" => esc_html__( "Choose the title color.", 'slz-core' ),
		'group'       => esc_html__('Options', 'slz-core'),
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"heading"     => esc_html__( "Title Hover Color", 'slz-core' ),
		"param_name"  => "title_color_hover",
		"description" => esc_html__( "Choose the title hover color.", 'slz-core' ),
		'group'       => esc_html__('Options', 'slz-core'),
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"heading"     => esc_html__( "Content Color", 'slz-core' ),
		"param_name"  => "content_color",
		"description" => esc_html__( "Choose the content color.", 'slz-core' ),
		'group'       => esc_html__('Options', 'slz-core'),
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
		"name"			=> esc_html__( 'SLZ Toggle Box', 'slz-core' ),
		"base"			=> "slzcore_toggle_box_sc",
		"class"			=> "slzcore-sc",
		"category"		=> SLZCORE_SC_CATEGORY,
		'icon'			=> 'icon-slzcore_toggle_box_sc',
		"description"	=> esc_html__( 'Toggle Box.', 'slz-core' ),
		"params"		=> $params
	)
);
