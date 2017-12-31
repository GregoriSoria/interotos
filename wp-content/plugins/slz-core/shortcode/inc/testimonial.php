<?php
$style  = array(
	esc_html__('Style 1', 'slz-core')		=> '1',
	esc_html__('Style 2', 'slz-core')		=> '2',
);
$yes_no  = array(
	esc_html__('No', 'slz-core')			=> '',
	esc_html__('Yes', 'slz-core')			=> 'yes',
);
$column  = array(
	esc_html__('One', 'slz-core')			=> '1',
	esc_html__('Two', 'slz-core')			=> '2',
	esc_html__('Three', 'slz-core')			=> '3',
);
$sort_by = Medicplus_Core_Params::get('sort-other');
// get Testimonial categories
$taxonomy = 'medicplus_testi_cat';
$params_cat = array('empty'   => esc_html__( '-All Testimonial Categories-', 'slz-core' ) );
$categories = Medicplus_Core_Com::get_tax_options2slug( $taxonomy, $params_cat );

$params = array(
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Style', 'slz-core' ),
		'param_name'      => 'style',
		'value'           => $style,
		'description'     => esc_html__( 'Select style will be displayed. ***New updates: style 2.', 'slz-core' ),
	),
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Image Dot Circle', 'slz-core' ),
		'param_name'      => 'image_circle',
		'value'           => $yes_no,
		'description'     => esc_html__( 'Choose "YES" to show image dot circle.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '1' ),
		),
	),
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Column', 'slz-core' ),
		'param_name'  	=> 'column',
		'value'       	=> $column,
		'std'      		=> '2',
		'description' 	=> esc_html__( 'Choose number column will be displayed.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '2' ),
		),
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
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'     => 'extra_class',
		'description'    => esc_html__( 'Enter extra class name.', 'slz-core' ),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Icon Color', 'slz-core' ),
		'param_name'      => 'icon_color',
		'description'     => esc_html__( 'Choose color for icon.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Navigation Color', 'slz-core' ),
		'param_name'      => 'nav_color',
		'description'     => esc_html__( 'Choose color for navigation.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '2' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Line Title Color', 'slz-core' ),
		'param_name'      => 'line_color',
		'description'     => esc_html__( 'Choose color for line title.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '1' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Border Color', 'slz-core' ),
		'param_name'      => 'border_color',
		'description'     => esc_html__( 'Choose color for border box.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '2' ),
		),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Name Color', 'slz-core' ),
		'param_name'      => 'name_color',
		'description'     => esc_html__( 'Choose color for name.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Text Color', 'slz-core' ),
		'param_name'      => 'text_color',
		'description'     => esc_html__( 'Choose color for text.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'        	=> 'textfield',
		'heading'     	=> esc_html__( 'Auto Play Speed', 'slz-core' ),
		'param_name'  	=> 'auto_speed',
		'value'       	=> '5000',
		'description' 	=> esc_html__( 'Slide will automatic play if enter the number greater than 0. This number is also the time that the slide switch turns. Unit is milliseconds.', 'slz-core' ),
		'group'       	=> esc_html__('Carousel', 'slz-core'),
	),
	array(
		'type'        	=> 'textfield',
		'heading'     	=> esc_html__( 'Speed', 'slz-core' ),
		'param_name'  	=> 'speed',
		'value'       	=> '',
		'description' 	=> esc_html__( 'Set the speed of a turn. Unit is milliseconds', 'slz-core' ),
		'group'       	=> esc_html__('Carousel', 'slz-core'),
	),
	
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Testimonial', 'slz-core' ),
	'base'        => 'slzcore_testimonial_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_testimonial_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'List of testimonials.', 'slz-core' ),
	'params'      => $params
));