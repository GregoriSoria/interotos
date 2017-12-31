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
		'type'            => 'attach_images',
		'heading'         => esc_html__( 'Images', 'slz-core' ),
		'param_name'      => 'images',
		'description'     => esc_html__( 'Add images.', 'slz-core' )
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Set Background', 'slz-core' ),
		'param_name'      => 'background',
		'description'     => esc_html__( 'Check it if you want to background replace for image.', 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Carousel Height', 'slz-core' ),
		'param_name'      => 'height',
		'description'     => esc_html__( 'Enter height for carousel block. Example : 500px.', 'slz-core' ),
		'dependency' => array(
			'element' => 'style',
			'value'   => array( '1' )
		)
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'  => 'extra_class',
		'description' => esc_html__( 'Enter extra class.', 'slz-core' )
	),
);
vc_map(array(
	'name'            => esc_html__( 'SLZ Carousel', 'slz-core' ),
	'base'            => 'slzcore_carousel_sc',
	'class'           => 'slzcore-sc',
	'icon'            => 'icon-slzcore_carousel_sc',
	'category'        => SLZCORE_SC_CATEGORY,
	'description'     => esc_html__( 'Display Image Carousel.', 'slz-core' ),
	'params'          => $params
	)
);