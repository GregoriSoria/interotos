<?php
$params = array(
	array(
		'type'           => 'attach_image',
		'heading'        => esc_html__( 'Add Image', 'slz-core' ),
		'param_name'     => 'image',
		'description'    => esc_html__( 'Choose image to add.', 'slz-core' ),
	),
	array(
		'type'           => 'textfield',
		'holder'         => 'div',
		'heading'        => esc_html__( 'Title', 'slz-core' ),
		'param_name'     => 'title',
		'description'    => esc_html__( 'Enter title.', 'slz-core' ),
	),
	array(
		'type'           => 'textarea',
		'heading'        => esc_html__( 'Description', 'slz-core' ),
		'param_name'     => 'description',
		'description'    => esc_html__( 'Enter description.', 'slz-core' ),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Button Content', 'slz-core' ),
		'param_name'    => 'button_txt',
		'description'   => esc_html__( 'Enter button text.', 'slz-core' ),
	),
	array(
		'type'            => 'vc_link',
		'heading'         => esc_html__( 'URL (Link)', 'slz-core' ),
		'param_name'      => 'url_btn',
		'value'           => '',
		'description'     => esc_html__( 'Add link to button.', 'slz-core' )
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'      => 'title_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for title.', 'slz-core' ),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Description Color', 'slz-core' ),
		'param_name'      => 'description_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for description.', 'slz-core' ),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Buttom color', 'slz-core' ),
		'param_name'      => 'color_buttom',
		'value'           => '',
		'description'     => esc_html__( 'Select color for buttom.', 'slz-core' ),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Buttom Hover color', 'slz-core' ),
		'param_name'      => 'color_buttom_hover',
		'value'           => '',
		'description'     => esc_html__( 'Select color for hover buttom.', 'slz-core' ),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'    => 'extra_class',
		'description'   => esc_html__( 'Enter extra class name.', 'slz-core' )
	),		
);
vc_map(array(
	'name'               => esc_html__( 'SLZ Image Box', 'slz-core' ),
	'base'               => 'slzcore_image_box_sc',
	'class'              => 'slzcore-sc',
	'icon'               => 'icon-slzcore_image_box_sc',
	'category'           => SLZCORE_SC_CATEGORY,
	'description'        => esc_html__( 'Add image box with custom options', 'slz-core' ),
	'params'             => $params
));
