<?php
$sort_by = Medicplus_Core_Params::get('sort-other');

$args = array('post_type'     => 'medicplus_faq');
$options = array('empty'      => esc_html__( '-All FAQ-', 'slz-core' ) );
$faq = Medicplus_Core_Com::get_post_title2id( $args, $options );

$method = array(
	esc_html__( 'Category', 'slz-core' )           => 'cat',
	esc_html__( 'FAQ', 'slz-core' )            	   => 'faq'
);

// get service categories
$taxonomy = 'medicplus_faq_cat';
$params_cat = array('empty'   => esc_html__( '-All FAQ Categories-', 'slz-core' ) );
$categories = Medicplus_Core_Com::get_tax_options2slug( $taxonomy, $params_cat );

$params = array(
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
		'type'			  => 'dropdown',
		'heading'		  => esc_html__( 'Display By', 'slz-core' ),
		'param_name'	  => 'method',
		'value'			  => $method,
		'description'	  => esc_html__( 'Choose FAQ category or special FAQ to display', 'slz-core' ),
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'FAQ', 'slz-core' ),
		'param_name'      => 'list_faq',
		'params'          => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add FAQ', 'slz-core' ),
				'param_name'  => 'faq',
				'value'       => $faq,
				'description' => esc_html__( 'Choose special FAQ to show',  'slz-core'  )
			),
			
		),
		'value'           => '',
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'faq' )
		),
		'description'     => esc_html__( 'Default display all FAQ if no FAQ is selected and Number FAQ is empty.', 'slz-core' )
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'FAQ Category', 'slz-core' ),
		'param_name'      => 'list_cat',
		'params'          => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add Category', 'slz-core' ),
				'param_name'  => 'faq_category',
				'value'       => $categories,
				'description' => esc_html__( 'Choose special FAQ category to show',  'slz-core'  )
			),
			
		),
		'value'           => '',
		'dependency'  => array(
			'element'   => 'method',
			'value'     => array( 'cat' )
		),
		'description'     => esc_html__( 'Default display all FAQ if no FAQ is selected and Number FAQ is empty.', 'slz-core' )
	),
	array(
		"type"        => "colorpicker",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_html__( "Active Color", 'slz-core' ),
		"param_name"  => "active_color",
		"description" => esc_html__( "Choose the active color.", 'slz-core' )
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'      => 'extra_class',
		'description'     => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'slz-core' )
	)
);
vc_map(array(
	'name'        => esc_html__( 'SLZ FAQ', 'slz-core' ),
	'base'        => 'slzcore_faqs_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_faqs_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'List of FAQ.', 'slz-core' ),
	'params'      => $params
));