<?php
$style = array(
	esc_html__('Style 1', 'slz-core') => '1',
	esc_html__('Style 2', 'slz-core') => '2',
	esc_html__('Style 3', 'slz-core') => '3',
	esc_html__('Style 4', 'slz-core') => '4',
	esc_html__('Style 5', 'slz-core') => '5',
);
$icon_type = Medicplus_Core_Params::get('icon_type');
$icon_ex   = Medicplus_Core_Params::get('font_medic');
$admin_icon_url = '<a href="'.esc_url(admin_url( 'admin.php?page='.SLZCORE_THEME_PREFIX.'_icon' )).'" target="_blank">'.esc_html__('MedicPlus Icons','slz-core').'</a>';

$params = array(
	array(
		'type'           => 'dropdown',
		
		'heading'        => esc_html__( 'Style', 'slz-core' ),
		'param_name'     => 'style_icon',
		'value'          => $style,
		'description'    => esc_html__( 'Choose style to display.', 'slz-core' ),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Icon Color', 'slz-core' ),
		'param_name'      => 'color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for icon.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style_icon',
			'value'    => array( '1', '2', '3','4', '5'),
		),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Icon Background Color', 'slz-core' ),
		'param_name'      => 'color_icon',
		'value'           => '',
		'description'     => esc_html__( 'Select background color for icon.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style_icon',
			'value'    => array( '1', '2'),
		),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Hover Background Color', 'slz-core' ),
		'param_name'      => 'color_hover',
		'value'           => '',
		'description'     => esc_html__( 'Select hover background color for box.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style_icon',
			'value'    => array('2'),
		),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		
		'heading'         => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'      => 'title_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for title.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style_icon',
			'value'    => array('1', '2', '3', '4', '5'),
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
			'element'  => 'style_icon',
			'value'    => array('2', '3', '4', '5'),
		),
		'group'        => esc_html__('Options', 'slz-core'),
	),
	array(
		"type"        => "dropdown",
		"class"       => "",
		"value"       => array( 
							esc_html__( 'Left', 'slz-core' )   => 'left', 
							esc_html__( 'Center', 'slz-core' ) => 'center', 
							esc_html__( 'Right', 'slz-core' )  => 'right' 
		),
		"heading"     => esc_html__( "Text Alignment", 'slz-core' ),
		"param_name"  => "alignment",
		"description" => esc_html__( "Select text alignment.", 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style_icon',
			'value'    => array('5'),
		),
	),
	array(
		'type'           => 'dropdown',
		'heading'        => esc_html__( 'Choose Type of Icon', 'slz-core' ),
		'param_name'     => 'icon_type',
		'value'          => $icon_type,
		'description'    => esc_html__( 'Choose style to display block.', 'slz-core' )
	),
	array(
		'type'           => 'iconpicker',
		'heading'        => esc_html__( 'Choose Icon', 'slz-core' ),
		'param_name'     => 'icon_fw',
		'dependency'     => array(
			'element'  => 'icon_type',
			'value'    => array('02')),
		'description'    => esc_html__( 'Choose icon to display in box.', 'slz-core' )
	),
	array(
		'type'           => 'dropdown',
		'heading'        => esc_html__( 'Choose Icon', 'slz-core' ),
		'param_name'     => 'icon_ex',
		'value'          => $icon_ex,
		'dependency'     => array(
			'element'  => 'icon_type',
			'value'    => array('')),
		'description'    => sprintf(__( 'Please go on "%s" to reference about icons of our theme.', 'slz-core' ), $admin_icon_url )
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
		'dependency'     => array(
			'element'  => 'style_icon',
			'value'    => array( '2', '3', '4', '5'),
		),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'    => 'extra_class',
		'description'   => esc_html__( 'Enter extra class name.', 'slz-core' )
	),

);
vc_map(array(
	'name'               => esc_html__( 'SLZ Icon Box', 'slz-core' ),
	'base'               => 'slzcore_icon_box_sc',
	'class'              => 'slzcore-sc',
	'icon'               => 'icon-slzcore_icon_box_sc',
	'category'           => SLZCORE_SC_CATEGORY,
	'description'        => esc_html__( 'Add icon box with custom options', 'slz-core' ),
	'params'             => $params
));
