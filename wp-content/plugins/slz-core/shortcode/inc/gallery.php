<?php
$style = array(
	esc_html__( 'Grid', 'slz-core' )			=> '1',
	esc_html__( 'Masonry', 'slz-core' )			=> '2',
);
$column = array(
	esc_html__( 'One', 'slz-core' )            	=> '1',
	esc_html__( 'Two', 'slz-core' )            	=> '2',
	esc_html__( 'Three', 'slz-core' )          	=> '3',
	esc_html__( 'Four', 'slz-core' )            => '4',
);
$yesno = array(
	esc_html__( 'Yes', 'slz-core' )            	=> 'yes',
	esc_html__( 'No', 'slz-core' )            	=> '',
);
$sort_by = Medicplus_Core_Params::get('sort-gallery');
$taxonomy = 'medicplus_gallery_cat';
$params_cat = array('empty'   => esc_html__( '-All Gallery Categories-', 'slz-core' ) );
$categories = Medicplus_Core_Com::get_tax_options2slug( $taxonomy, $params_cat );

$params = array(
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Gallery', 'slz-core' ),
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
		'description' 	=> esc_html__( 'Choose number column will be displayed.', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( '1' ),
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
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Show filter ?', 'slz-core' ),
		'param_name'  	=> 'show_filter',
		'value'       	=> $yesno,
		'std'      		=> 'yes',
		'description' 	=> esc_html__( 'Choose YES to show filter.', 'slz-core' )
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Title All', 'slz-core' ),
		'param_name'     => 'title_all',
		'description'    => esc_html__( 'Enter text of link all posts.', 'slz-core' ),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Button', 'slz-core' ),
		'param_name'     => 'title_button',
		'description'    => esc_html__( 'Enter text of button load more.', 'slz-core' ),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'     => 'extra_class',
		'description'    => esc_html__( 'Enter extra class name.', 'slz-core' ),
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
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Filter Title Color', 'slz-core' ),
		'param_name'      => 'color_filter',
		'description'     => esc_html__( 'Choose color for navigation title.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Filter Title Color Hover', 'slz-core' ),
		'param_name'      => 'color_filter_hv',
		'description'     => esc_html__( 'Choose color for navigation title when hover.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Filter Title Line Color', 'slz-core' ),
		'param_name'      => 'color_filter_line',
		'description'     => esc_html__( 'Choose color for navigation title line.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Item Background', 'slz-core' ),
		'param_name'      => 'background_item',
		'description'     => esc_html__( 'Choose color for item background.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Text Item Color', 'slz-core' ),
		'param_name'      => 'color_item_text',
		'description'     => esc_html__( 'Choose color for text item.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Background', 'slz-core' ),
		'param_name'      => 'background_button',
		'description'     => esc_html__( 'Choose color for button background.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Background Hover', 'slz-core' ),
		'param_name'      => 'background_button_hv',
		'description'     => esc_html__( 'Choose color for button background when hover.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Text Color', 'slz-core' ),
		'param_name'      => 'color_button',
		'description'     => esc_html__( 'Choose color for button text.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Button Text Color Hover', 'slz-core' ),
		'param_name'      => 'color_button_hv',
		'description'     => esc_html__( 'Choose color for button text when hover.', 'slz-core' ),
		'group'           => esc_html__('Custom', 'slz-core'),
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Gallery', 'slz-core' ),
	'base'        => 'slzcore_gallery_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_gallery_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'List of gallery.', 'slz-core' ),
	'params'      => $params
));