<?php
// get Department categories
$taxonomy = 'medicplus_dept_cat';
$params_cat = array('empty'   => esc_html__( '-All Department Categories-', 'slz-core' ) );
$categories = Medicplus_Core_Com::get_tax_options2slug( $taxonomy, $params_cat );

$orderby = Medicplus_Core_Params::get('sort-testimonial');
$yes_no  = array(
	esc_html__('No', 'slz-core') => '',
	esc_html__('Yes', 'slz-core')=> 'yes',
);
$params = array(
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Limit Posts', 'slz-core' ),
		'param_name'  => 'limit_post',
		'value'       => '',
		'description' => esc_html__( 'Enter limit of posts per page. If it blank the limit posts will be the number from Wordpress settings -> Reading. If you want show all, enter "-1".', 'slz-core' )
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Offset Posts', 'slz-core' ),
		'param_name'  => 'offset_post',
		'value'       => '0',
		'description' => esc_html__( 'Enter offset to pass over posts. If you want to start on record 6, using offset 5.', 'slz-core' )
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Sort By', 'slz-core' ),
		'param_name'  => 'sort_by',
		'value'       => $orderby,
		'description' => esc_html__( 'Choose criteria to display.', 'slz-core' )
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Pagination', 'slz-core' ),
		'param_name'  => 'pagination',
		'value'       => $yes_no,
		'std'         => 'yes',
		'description' => esc_html__( 'Show Pagination.', 'slz-core' ),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Show Department Head?', 'slz-core' ),
		'param_name'  => 'show_dep_head',
		'value'       => $yes_no,
		'std'         => 'yes',
		'description' => esc_html__( 'Choose YES to show department head.', 'slz-core' ),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Show Department Head Information?', 'slz-core' ),
		'param_name'  => 'show_dep_head_info',
		'value'       => $yes_no,
		'std'         => 'yes',
		'description' => esc_html__( 'Choose YES to show department head information.', 'slz-core' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'  => 'extra_class',
		'description' => esc_html__( 'Enter extra class.', 'slz-core' )
	),
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Category', 'slz-core' ),
		'param_name' => 'category_list',
		'params'     => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add Category', 'slz-core' ),
				'param_name'  => 'category_slug',
				'value'       => $categories,
				'description' => esc_html__( 'Choose special category to filter', 'slz-core'  )
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Default no filter by category.', 'slz-core' ),
		'group'       => 'Filter'
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Button Text', 'slz-core' ),
		'param_name'  => 'button_text',
		'group'       => 'Custom',
		'description' => esc_html__( 'Set empty If you do not show button.', 'slz-core' )
	),
	array(
		'type'        => 'colorpicker',
		'heading'     => esc_html__( 'Main Color', 'slz-core' ),
		'param_name'  => 'main_color',
		'value'       => '',
		'group'       =>'Custom',
		'description' => esc_html__( 'Enter color for button, title, border, icon social.', 'slz-core' )
	),
	array(
		'type'        => 'colorpicker',
		'heading'     => esc_html__( 'Line Title Color', 'slz-core' ),
		'param_name'  => 'line_color',
		'value'       => '',
		'group'       =>'Custom',
		'description' => esc_html__( 'Enter color for line title.', 'slz-core' )
	),
);
vc_map(array(
	'name'            => esc_html__( 'SLZ Department', 'slz-core' ),
	'base'            => 'slzcore_department_sc',
	'class'           => 'slzcore-sc',
	'icon'            => 'icon-slzcore_department_sc',
	'category'        => SLZCORE_SC_CATEGORY,
	'description'     => esc_html__( 'A list department will be displayed.', 'slz-core' ),
	'params'          => $params
	)
);