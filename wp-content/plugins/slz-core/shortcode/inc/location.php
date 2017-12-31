<?php
$style = array(
	esc_html__( 'Style 1. Simple', 'slz-core' )				=> '1',
	esc_html__( 'Style 2. Grid', 'slz-core' )				=> '2',
);
$column = array(
	esc_html__( 'One', 'slz-core' )				=> '1',
	esc_html__( 'Two', 'slz-core' )				=> '2',
	esc_html__( 'Three', 'slz-core' )			=> '3',
	esc_html__( 'Four', 'slz-core' )			=> '4',
);

$sort_by = Medicplus_Core_Params::get('sort-other');

$method = array(
	esc_html__( 'Category', 'slz-core' )   		=> 'cat',
	esc_html__( 'Location', 'slz-core' )      	=> 'location'
);
// get all location
$args = array('post_type'     => 'medicplus_locate');
$options = array('empty'      => esc_html__( '-All Location-', 'slz-core' ) );
$location = Medicplus_Core_Com::get_post_title2id( $args, $options );
// get location categories
$taxonomy = 'medicplus_locate_cat';
$params_cat = array('empty'   => esc_html__( '-All Location Categories-', 'slz-core' ) );
$categories = Medicplus_Core_Com::get_tax_options2slug( $taxonomy, $params_cat );

$params = array(
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Style', 'slz-core' ),
		'param_name'  	=> 'style',
		'value'       	=> $style,
		'std'      		=> '1',
		'description' 	=> esc_html__( 'Choose style will be displayed.', 'slz-core' )
	),
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Column', 'slz-core' ),
		'param_name'  	=> 'column',
		'value'       	=> $column,
		'std'      		=> '2',
		'description' 	=> esc_html__( 'Choose column number will be displayed.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'style',
			'value'     => array( '2' )
		),
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Show direction', 'slz-core' ),
		'param_name'      => 'is_direction',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'std'			  => 'yes',
		'description' => esc_html__( 'Checked to Show direction feature on map. Note: This function should be used when SSL authentication website (https://). Because some browsers will not perform the function if no SSL website. Need to add an API key to use the map direction.', 'slz-core' ),
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Go To Marker', 'slz-core' ),
		'param_name'      => 'is_marker_map',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'std'			  => 'yes',
		'description' => esc_html__( 'Checked to click address go to marker on map.', 'slz-core' ),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Limit Posts', 'slz-core' ),
		'param_name'      => 'limit_post',
		'description'     => esc_html__( 'Enter location numbers will be displayed.', 'slz-core' )
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
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'      => 'extra_class',
		'description'     => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'slz-core' )
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Display By', 'slz-core' ),
		'param_name'  => 'method',
		'value'       => $method,
		'description' => esc_html__( 'Choose location category or special location to display', 'slz-core' ),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Group Title', 'slz-core' ),
		'param_name'      => 'title_group',
		'description'     => esc_html__( 'Enter groupd title will be displayed.', 'slz-core' ),
		'group'       	=> esc_html__('Filter', 'slz-core'),
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'location' )
		),
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
		'description' => esc_html__( 'Choose location category.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'cat' )
		),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'Location', 'slz-core' ),
		'param_name'      => 'location_list',
		'params'          => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add location', 'slz-core' ),
				'param_name'  => 'location',
				'value'       => $location,
				'description' => esc_html__( 'Choose special location to show',  'slz-core'  )
			),
			
		),
		'value'           => '',
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'location' )
		),
		'callbacks'       => array(
			'after_add'   => 'vcChartParamAfterAddCallback'
		),
		'description'     => esc_html__( 'Default display all location if no tean is selected and Number location is empty.', 'slz-core' ),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),

	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Group Color', 'slz-core' ),
		'param_name'      => 'color_title_group',
		'value'           => '',
		'description'     => esc_html__( 'Choose color title group for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'      => 'color_title',
		'value'           => '',
		'description'     => esc_html__( 'Choose color title for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Background Color', 'slz-core' ),
		'param_name'      => 'color_bg_title',
		'value'           => '',
		'description'     => esc_html__( 'Choose background color title for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Phone Color', 'slz-core' ),
		'param_name'      => 'color_phone',
		'value'           => '',
		'description'     => esc_html__( 'Choose color phone for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Text Color', 'slz-core' ),
		'param_name'      => 'color_text',
		'value'           => '',
		'description'     => esc_html__( 'Choose color text for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Color', 'slz-core' ),
		'param_name'      => 'color_border',
		'value'           => '',
		'description'     => esc_html__( 'Choose color border for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
		'dependency'  => array(
			'element'   => 'style',
			'value'     => array( '2' )
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Icon Color', 'slz-core' ),
		'param_name'      => 'color_icon',
		'value'           => '',
		'description'     => esc_html__( 'Choose color icon for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Link Color', 'slz-core' ),
		'param_name'      => 'color_link',
		'value'           => '',
		'description'     => esc_html__( 'Choose color link for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Link Color Hover', 'slz-core' ),
		'param_name'      => 'color_link_hv',
		'value'           => '',
		'description'     => esc_html__( 'Choose color link for block when hover.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Phone Box Background Color', 'slz-core' ),
		'param_name'      => 'color_bg_phonebox',
		'value'           => '',
		'description'     => esc_html__( 'Choose background color phone box for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Location List', 'slz-core' ),
	'base'        => 'slzcore_location_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_location_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'Location a list.', 'slz-core' ),
	'params'      => $params
	)
);