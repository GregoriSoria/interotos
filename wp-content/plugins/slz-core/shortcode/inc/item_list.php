<?php

$params = array(
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'Add Item', 'slz-core' ),
		'param_name'      => 'array_content',
		'params'          => array(
			array(
				'type'        => 'textfield',
				'admin_label' => true,
				'heading'     => esc_html__( 'Content', 'slz-core' ),
				'param_name'  => 'content',
				'description' => esc_html__( 'Enter content of item',  'slz-core'  )
			)
		)
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Text Color", 'slz-core' ),
		"param_name"  => "text_color",
		"description" => esc_html__( "Choose color for text", 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"class"       => "",
		"value"		  => '',
		"heading"     => esc_html__( "Icon Color", 'slz-core' ),
		"param_name"  => "icon_color",
		"description" => esc_html__( "Choose color for icon", 'slz-core' )
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
		"name"			=> esc_html__( 'SLZ Item List', 'slz-core' ),
		"base"			=> "slzcore_item_list_sc",
		"class"			=> "slzcore-sc",
		"category"		=> SLZCORE_SC_CATEGORY,
		'icon'			=> 'icon-slzcore_item_list_sc',
		"description"	=> esc_html__( 'Help you to create item list.', 'slz-core' ),
		"params"		=> $params
	)
);
