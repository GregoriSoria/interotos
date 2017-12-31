<?php
$icon_type = Medicplus_Core_Params::get('icon_type');
$icon_ex   = Medicplus_Core_Params::get('font_medic');
$admin_icon_url = '<a href="'.esc_url(admin_url( 'admin.php?page='.SLZCORE_THEME_PREFIX.'_icon' )).'" target="_blank">'.esc_html__('MedicPlus Icons','slz-core').'</a>';
$style = array(
	esc_html__('Style 1', 'slz-core')	=> '1',
	esc_html__('Style 2', 'slz-core')	=> '2',
	esc_html__('Style 3', 'slz-core')	=> '3',
	esc_html__('Style 4', 'slz-core')	=> '4',
	esc_html__('Style 5', 'slz-core')	=> '5'
);
$number_item = array(
	esc_html__('One', 'slz-core')		=> '1',
	esc_html__('Two', 'slz-core')		=> '2',
	esc_html__('Three', 'slz-core')		=> '3',
	esc_html__('Four', 'slz-core')		=> '4'
);
$params = array(
	array(
		'type'           => 'dropdown',
		'heading'        => esc_html__( 'Choose Type of Icon', 'slz-core' ),
		'param_name'     => 'icon_type',
		'value'          => $icon_type,
		'description'    => esc_html__( 'Choose type of icon to display on block.', 'slz-core' )
	),
	array(
		'type'           => 'iconpicker',
		'heading'        => esc_html__( 'Choose Icon', 'slz-core' ),
		'param_name'     => 'icon_fw',
		'dependency'     => array(
			'element'    => 'icon_type',
			'value'      => array('02')),
		'description'    => esc_html__( 'Choose icon to display in box.', 'slz-core' )
	),
	array(
		'type'           => 'dropdown',
		'heading'        => esc_html__( 'Choose Icon', 'slz-core' ),
		'param_name'     => 'icon_ex',
		'value'          => $icon_ex,
		'dependency'     => array(
			'element'    => 'icon_type',
			'value'      => array('')),
		'description'    => sprintf(__( 'Please go on "%s" to reference about icons of our theme.', 'slz-core' ), $admin_icon_url )
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Title', 'slz-core' ),
		'param_name'     => 'title',
		'description'    => esc_html__( 'Enter title for block.', 'slz-core' ),
	),
	array(
		'type'           => 'textarea',
		'heading'        => esc_html__( 'Description', 'slz-core' ),
		'param_name'     => 'description',
		'description'    => esc_html__( 'Enter description.', 'slz-core' ),
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Icon Color', 'slz-core' ),
		'param_name'     => 'icon_color',
		'value'          => '',
		'description'    => esc_html__( 'Select color for icon.', 'slz-core' )
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'     => 'title_color',
		'value'          => '',
		'description'    => esc_html__( 'Select color for title.', 'slz-core' )
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Description Color', 'slz-core' ),
		'param_name'     => 'description_color',
		'value'          => '',
		'description'    => esc_html__( 'Select color for description.', 'slz-core' )
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Background Color', 'slz-core' ),
		'param_name'     => 'backg_color',
		'value'          => '',
		'description'    => esc_html__( 'Select background color for block.', 'slz-core' )
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Background Hover Color', 'slz-core' ),
		'param_name'     => 'hover_color',
		'value'          => '',
		'description'    => esc_html__( 'Select background hover color for box.', 'slz-core' )
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Text Hover Color', 'slz-core' ),
		'param_name'     => 'text_hover_color',
		'value'          => '',
		'description'    => esc_html__( 'Select hover color for title and description.', 'slz-core' )
	),
);
$param_group = array(
	array(
		'type'           => 'dropdown',
		'heading'        => esc_html__( 'Style', 'slz-core' ),
		'param_name'     => 'style',
		'value'          => $style,
		'std'            => '1',
		'description'    => esc_html__( 'Choose style to display.', 'slz-core' )
	),
	array(
		'type'           => 'param_group',
		'heading'        => esc_html__( 'Items', 'slz-core' ),
		'param_name'     => 'feature_list',
		'params'         => $params,
		'value'          => '',
		'callbacks'      => array(
			'after_add'  => 'vcChartParamAfterAddCallback'
		)
	),
	array(
		'type'           => 'dropdown',
		'heading'        => esc_html__( 'Items Per Row', 'slz-core' ),
		'param_name'     => 'number_item',
		'value'          => $number_item,
		'description'    => esc_html__( 'Choose number of items per row.', 'slz-core' ),
		'std'            => '4',
		'dependency'     => array(
			'element'              => 'style',
			'value_not_equal_to'   => array( '5' )
		)
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Line Color', 'slz-core' ),
		'param_name'     => 'line_color',
		'value'          => '',
		'description'    => esc_html__( 'Select color for line below icon.', 'slz-core' ),
		'dependency'     => array(
			'element'    => 'style',
			'value'      => array( '3' )
		)
	),
	array(
		'type'           => 'colorpicker',
		'heading'        => esc_html__( 'Line Hover Color', 'slz-core' ),
		'param_name'     => 'line_hover_color',
		'value'          => '',
		'description'    => esc_html__( 'Select hover color for line below icon.', 'slz-core' ),
		'dependency'     => array(
			'element'    => 'style',
			'value'      => array( '3' )
		)
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'     => 'extra_class',
		'description'    => esc_html__( 'Enter extra class.', 'slz-core' )
	),
);
vc_map(array(
	'name'               => esc_html__( 'SLZ Feature Item', 'slz-core' ),
	'base'               => 'slzcore_feature_item_sc',
	'class'              => 'slzcore-sc',
	'icon'               => 'icon-slzcore_feature_item_sc',
	'category'           => SLZCORE_SC_CATEGORY,
	'description'        => esc_html__( 'Add feature item with custom options', 'slz-core' ),
	'params'             => $param_group
));