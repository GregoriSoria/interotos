<?php
$style  = array(
	esc_html__('Style 1', 'slz-core')		=> '1',
	esc_html__('Style 2', 'slz-core')		=> '2',
	esc_html__('Style 3', 'slz-core')		=> '3',
);
$column = array(
	esc_html__( 'One', 'slz-core' )   		=> '1',
	esc_html__( 'Two', 'slz-core' )   		=> '2',
	esc_html__( 'Three', 'slz-core' ) 		=> '3',
	esc_html__( 'Four', 'slz-core' )  		=> '4',
);
$align  = array(
	esc_html__('Left', 'slz-core')			=> 'left',
	esc_html__('Right', 'slz-core')			=> 'right',
	esc_html__('Center', 'slz-core')		=> 'center',
);
$align_2  = array(
	esc_html__('Left', 'slz-core')			=> 'left',
	esc_html__('Right', 'slz-core')			=> 'right',
);
$method = array(
	esc_html__( 'Category', 'slz-core' )	=> 'cat',
	esc_html__( 'Service', 'slz-core' ) 	=> 'service'
);
$sort_by = Medicplus_Core_Params::get('sort-other');

// get all services
$args = array('post_type'     => 'medicplus_service');
$options = array('empty'      => esc_html__( '-All Services-', 'slz-core' ) );
$services = Medicplus_Core_Com::get_post_title2id( $args, $options );

// get service categories
$taxonomy = 'medicplus_service_cat';
$params_cat = array('empty'   => esc_html__( '-All Service Categories-', 'slz-core' ) );
$categories = Medicplus_Core_Com::get_tax_options2slug( $taxonomy, $params_cat );

$params = array(
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Style', 'slz-core' ),
		'param_name'  	=> 'style',
		'value'       	=> $style,
		'std'      		=> '1',
		'description' 	=> esc_html__( 'Choose number column will be displayed.', 'slz-core' )
	),
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Column', 'slz-core' ),
		'param_name'  	=> 'column',
		'value'       	=> $column,
		'std'      		=> '4',
		'description' 	=> esc_html__( 'Choose number column will be displayed.', 'slz-core' )
	),
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Text Align', 'slz-core' ),
		'param_name'  	=> 'align',
		'value'       	=> $align,
		'std'      		=> 'left',
		'description' 	=> esc_html__( 'Choose text align will be displayed.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '2' ),
		),
	),
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Text Align', 'slz-core' ),
		'param_name'  	=> 'align_2',
		'value'       	=> $align_2,
		'std'      		=> 'left',
		'description' 	=> esc_html__( 'Choose text align will be displayed.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Button Text', 'slz-core' ),
		'param_name'      => 'btn_readmore',
		'value'           => 'Read more',
		'description'     => esc_html__( 'Set empty If you do not show button.', 'slz-core' )
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Limit Posts', 'slz-core' ),
		'param_name'      => 'limit_post',
		'value'           => '',
		'description'     => esc_html__( 'Add limit posts per page. Set -1 or empty to show all.', 'slz-core' )
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Offset Posts', 'slz-core' ),
		'param_name'      => 'offset_post',
		'value'           => '0',
		'description'     => esc_html__( 'Enter offset to pass over posts. If you want to start on record 6, using offset 5', 'slz-core' )
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
		'description' => esc_html__( 'Choose service category or special services to display', 'slz-core' ),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'        => 'param_group',
		'heading'     => esc_html__( 'Category', 'slz-core' ),
		'param_name'  => 'category',
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
		'description' => esc_html__( 'Choose service category.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'cat' )
		),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'Services', 'slz-core' ),
		'param_name'      => 'list_service',
		'params'          => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add service', 'slz-core' ),
				'param_name'  => 'service',
				'value'       => $services,
				'description' => esc_html__( 'Choose special service to show',  'slz-core'  )
			),
			
		),
		'value'           => '',
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'service' )
		),
		'callbacks'       => array(
			'after_add'   => 'vcChartParamAfterAddCallback'
		),
		'description'     => esc_html__( 'Default display all services if no service is selected and Number service is empty.', 'slz-core' ),
		'group'       	=> esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Icon Color', 'slz-core' ),
		'param_name'      => 'color_icon',
		'value'           => '',
		'description'     => esc_html__( 'Choose color icon for block.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '1' ),
		),
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'Color Multi', 'slz-core' ),
		'param_name'      => 'color_icon_multi',
		'params'          => array(
			array(
				'type'        => 'colorpicker',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add color', 'slz-core' ),
				'param_name'  => 'color_multi',
				'value'       => '',
				'description' => esc_html__( 'Choose a color icon.',  'slz-core'  )
			),
			
		),
		'value'           => '',
		'callbacks'       => array(
			'after_add'   => 'vcChartParamAfterAddCallback'
		),
		'description'     => esc_html__( 'Choose the color that corresponds to the order of the post. It will repeat the previous color if color was selected amount less than the amount posted.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
		'dependency'  => array(
			'element'   => 'style',
			'value'     => array( '2' )
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Line Color', 'slz-core' ),
		'param_name'      => 'color_line',
		'value'           => '',
		'description'     => esc_html__( 'Choose color line for block.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '1' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'      => 'color_title',
		'value'           => '',
		'description'     => esc_html__( 'Choose color title for block.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Color Hover', 'slz-core' ),
		'param_name'      => 'color_title_hv',
		'value'           => '',
		'description'     => esc_html__( 'Choose color title for block when hover.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '1' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Text Color', 'slz-core' ),
		'param_name'      => 'color_text',
		'value'           => '',
		'description'     => esc_html__( 'Choose color text for block.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Text Color Hover', 'slz-core' ),
		'param_name'      => 'color_text_hv',
		'value'           => '',
		'description'     => esc_html__( 'Choose color text for block when hover.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '1' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button color', 'slz-core' ),
		'param_name'      => 'color_readmore',
		'value'           => '',
		'description'     => esc_html__( 'Choose color text for button.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Color Hover', 'slz-core' ),
		'param_name'      => 'color_readmore_hv',
		'value'           => '',
		'description'     => esc_html__( 'Choose color text for button when hover.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Color', 'slz-core' ),
		'param_name'      => 'color_border',
		'value'           => '',
		'description'     => esc_html__( 'Choose color border for block.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '1', '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Color Hover', 'slz-core' ),
		'param_name'      => 'color_border_hv',
		'value'           => '',
		'description'     => esc_html__( 'Choose color border for block when hover.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '3' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Background Color', 'slz-core' ),
		'param_name'      => 'color_background',
		'value'           => '',
		'description'     => esc_html__( 'Choose color background for block.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
		'dependency'      => array(
			'element'  => 'style',
			'value'    => array( '1' ),
		),
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Services', 'slz-core' ),
	'base'        => 'slzcore_service_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_service_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'List of services.', 'slz-core' ),
	'params'      => $params
	)
);