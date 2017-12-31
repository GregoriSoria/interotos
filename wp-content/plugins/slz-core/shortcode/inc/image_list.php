<?php
$style = array(
	esc_html__('Style 1', 'slz-core') => '1',
	esc_html__('Style 2', 'slz-core') => '2',
);

$params = array(
	array(
		'type'           => 'dropdown',
		'heading'        => esc_html__( 'Style', 'slz-core' ),
		'param_name'     => 'style_image',
		'value'          => $style,
		'description'    => esc_html__( 'Choose style to display.', 'slz-core' ),
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'Choose Image and Link to image', 'slz-core' ),
		'param_name'      => 'array_image',
		'dependency'     => array(
			'element'  => 'style_image',
			'value'    => array( '2'),
		),
		'params'          => array(
			array(
				'type'           => 'attach_image',
				'heading'        => esc_html__( 'Add Image', 'slz-core' ),
				'param_name'     => 'image_link',
				'description'    => esc_html__( 'Choose image to add.', 'slz-core' ),
			),
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'URL (Link)', 'slz-core' ),
				'param_name'  => 'url',
				'description' => esc_html__( 'Add link to image.',  'slz-core'  )
			),
		)
	),

	array(
		'type'           => 'attach_images',
		'heading'        => esc_html__( 'Add Image', 'slz-core' ),
		'param_name'     => 'images',
		'description'    => esc_html__( 'Choose image to add.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style_image',
			'value'    => array( '1'),
		),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'    => 'extra_class',
		'description'   => esc_html__( 'Enter extra class name.', 'slz-core' )
	)
);
vc_map(array(
	'name'               => esc_html__( 'SLZ Image List', 'slz-core' ),
	'base'               => 'slzcore_image_list_sc',
	'class'              => 'slzcore-sc',
	'icon'               => 'icon-slzcore_image_list_sc',
	'category'           => SLZCORE_SC_CATEGORY,
	'description'        => esc_html__( 'Add Image List with custom options', 'slz-core' ),
	'params'             => $params
));