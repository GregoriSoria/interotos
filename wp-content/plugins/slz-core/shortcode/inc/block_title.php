<?php

$params = array(
	array(
		"type"        => "textfield",
		'holder'      => 'div',
		"class"       => "",
		"heading"     => esc_html__( 'Title', 'slz-core' ),
		"param_name"  => "title",
		"description" => esc_html__( 'Enter title here', 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Title Text Color", 'slz-core' ),
		"param_name"  => "title_color",
		"description" => esc_html__( "Choose text color for title", 'slz-core' )
	),
	array(
		"type"        => "textfield",
		"class"       => "",
		"heading"     => esc_html__( 'Header', 'slz-core' ),
		"param_name"  => "txt_content",
		"description" => esc_html__( 'Enter Header here', 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Header Text Color", 'slz-core' ),
		"param_name"  => "content_color",
		"description" => esc_html__( "Choose text color for Header", 'slz-core' )
	),
	array(
		"type"        => "dropdown",
		"class"       => "",
		"value"       => array( esc_html__( 'Left', 'slz-core' ) => 'left', esc_html__( 'Center', 'slz-core' ) => 'center', esc_html__( 'Right', 'slz-core' ) => 'right' ),
		"heading"     => esc_html__( "Text Alignment", 'slz-core' ),
		"param_name"  => "alignment",
		"description" => esc_html__( "Select text alignment.", 'slz-core' )
	),
	array(
		"type"        => "checkbox",
		"class"       => "",
		"value"		  => '',
		"std"		  => 'true',
		"heading"     => esc_html__( "Show Separator Line", 'slz-core' ),
		"param_name"  => "separator_line",
		"description" => esc_html__( "Show separator line", 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Separator Line Color", 'slz-core' ),
		"param_name"  => "separator_color",
		"description" => esc_html__( "Choose Separator line color", 'slz-core' ),
		"dependency"  => array(
			"element"   => "separator_line",
			"value"     => "true"
		),
	),
	array(
		'type' => 'textarea',
		'param_name' => 'description',
		'heading' => esc_html__( 'Block Description', 'slz-core' ),
		'description' => esc_html__( 'Enter block description. Set empty if you dont want to use description', 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Description Color", 'slz-core' ),
		"param_name"  => "description_color",
		"description" => esc_html__( "Choose text color for description", 'slz-core' )
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
		"name"			=> esc_html__( 'SLZ Block Title', 'slz-core' ),
		"base"			=> "slzcore_block_title_sc",
		"class"			=> "slzcore-sc",
		"category"		=> SLZCORE_SC_CATEGORY,
		'icon'			=> 'icon-slzcore_block_title_sc',
		"description"	=> esc_html__( 'Block Title.', 'slz-core' ),
		"params"		=> $params
	)
);
