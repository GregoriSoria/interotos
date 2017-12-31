<?php

$params = array(
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_html__( 'Title', 'slz-core' ),
		"param_name"  => "title",
		"description" => esc_html__( 'Enter title here', 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"holder"      => "div",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Title Color", 'slz-core' ),
		"param_name"  => "title_color",
		"description" => esc_html__( "Choose color for title", 'slz-core' )
	),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_html__( "Counter", 'slz-core' ),
		"param_name"  => "counter",
		"description" => esc_html__( "Enter counter here", 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"holder"      => "div",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Number Color", 'slz-core' ),
		"param_name"  => "number_color",
		"description" => esc_html__( "Choose color for counter number", 'slz-core' )
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
		"name"			=> esc_html__( 'SLZ Number Factor', 'slz-core' ),
		"base"			=> "slzcore_number_factor_sc",
		"class"			=> "slzcore-sc",
		"category"		=> SLZCORE_SC_CATEGORY,
		'icon'			=> 'icon-slzcore_number_factor_sc',
		"description"	=> esc_html__( 'Number Factor and Counter.', 'slz-core' ),
		"params"		=> $params
	)
);
