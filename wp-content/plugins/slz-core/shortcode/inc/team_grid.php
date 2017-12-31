<?php
$column = array(
	esc_html__( 'One', 'slz-core' )				=> '1',
	esc_html__( 'Two', 'slz-core' )				=> '2',
	esc_html__( 'Three', 'slz-core' )			=> '3',
	esc_html__( 'Four', 'slz-core' )			=> '4',
);

$sort_by = Medicplus_Core_Params::get('sort-other');

$method = array(
	esc_html__( 'Category', 'slz-core' )   		=> 'cat',
	esc_html__( 'Teams', 'slz-core' )      		=> 'team'
);
// get all teams
$args = array('post_type'     => 'medicplus_team');
$options = array('empty'      => esc_html__( '-All Teams-', 'slz-core' ) );
$teams = Medicplus_Core_Com::get_post_title2id( $args, $options );
// get team categories
$taxonomy = 'medicplus_team_cat';
$params_cat = array('empty'   => esc_html__( '-All Teams Categories-', 'slz-core' ) );
$categories = Medicplus_Core_Com::get_tax_options2slug( $taxonomy, $params_cat );

$params = array(
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Column', 'slz-core' ),
		'param_name'  	=> 'column',
		'value'       	=> $column,
		'std'      		=> '4',
		'description' 	=> esc_html__( 'Choose column number will be displayed.', 'slz-core' )
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Limit Posts', 'slz-core' ),
		'param_name'      => 'limit_post',
		'description'     => esc_html__( 'Enter team numbers will be displayed.', 'slz-core' )
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Offset Posts', 'slz-core' ),
		'param_name'  => 'offset_post',
		'value'       => '0',
		'description' => esc_html__( 'Enter offset to pass over posts. If you want to start on record 6, using offset 5.', 'slz-core' )
	),
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Sort By', 'slz-core' ),
		'param_name'      => 'sort_by',
		'value'           => $sort_by,
		'description'     => esc_html__( 'Select order to display list properties.', 'slz-core' ),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Display By', 'slz-core' ),
		'param_name'  => 'method',
		'value'       => $method,
		'description' => esc_html__( 'Choose team category or special teams to display', 'slz-core' ),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'        => 'param_group',
		'heading'     => esc_html__( 'Category', 'slz-core' ),
		'param_name'  => 'category_list',
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
		'description' => esc_html__( 'Choose team category.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'cat' )
		),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'Teams', 'slz-core' ),
		'param_name'      => 'team_list',
		'params'          => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add Team', 'slz-core' ),
				'param_name'  => 'team',
				'value'       => $teams,
				'description' => esc_html__( 'Choose special team to show',  'slz-core'  )
			),
			
		),
		'value'           => '',
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'team' )
		),
		'callbacks'       => array(
			'after_add'   => 'vcChartParamAfterAddCallback'
		),
		'description'     => esc_html__( 'Default display all teams if no tean is selected and Number team is empty.', 'slz-core' ),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'      => 'extra_class',
		'description'     => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'slz-core' )
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'      => 'title_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color title for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Hover Color', 'slz-core' ),
		'param_name'      => 'title_hv_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color title for block when hover.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Position Color', 'slz-core' ),
		'param_name'      => 'position_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color position for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Icon Hover Color', 'slz-core' ),
		'param_name'      => 'icon_hv_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color icon for block when hover.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Color', 'slz-core' ),
		'param_name'      => 'border_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color border for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Hover Color', 'slz-core' ),
		'param_name'      => 'border_hv_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color border for block when hover.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Panel Color', 'slz-core' ),
		'param_name'      => 'panel_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color background for panel title.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Panel Hover Color', 'slz-core' ),
		'param_name'      => 'panel_hv_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color background for panel title when hover.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Team Grid', 'slz-core' ),
	'base'        => 'slzcore_team_grid_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_team_grid_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'Grid team a list.', 'slz-core' ),
	'params'      => $params
	)
);