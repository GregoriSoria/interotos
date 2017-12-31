<?php
$category = Medicplus_Core_Com::get_category2slug_array();
$tag = Medicplus_Core_Com::get_tax_options2slug( 'post_tag', array('empty' => esc_html__( '-All tags-', 'slz-core' ) ) );
$author = Medicplus_Core_Com::get_user_login2id(array(), array('empty' => esc_html__( '-All authors-', 'slz-core' ) ) );
$orderby = Medicplus_Core_Params::get('sort-blog');

$style = array(
	esc_html__('Style 1', 'slz-core') => 'news_carousel_1',
	esc_html__('Style 2', 'slz-core') => 'news_carousel_2',
);
$params = array(
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Style', 'slz-core' ),
		'param_name'  => 'style',
		'value'       => $style,
		'std'         => 'news_carousel_1',
		'description' => esc_html__( 'Choose style to display WP Posts.', 'slz-core' )
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Excerpt Length', 'slz-core' ),
		'param_name'  => 'excerpt_length',
		'value'       => '15',
		'description' => esc_html__( 'Enter limit of text will be truncated. If it is empty, the default is not cut. It will trim word', 'slz-core' ),
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( 'news_carousel_1' ),
		),
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Limit Posts', 'slz-core' ),
		'param_name'  => 'limit_post',
		'value'       => 6,
		'description' => esc_html__( 'Enter limit of posts per page. If it blank the limit posts will be the number from Wordpress settings -> Reading. If you want show all, enter "-1".', 'slz-core' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Offset Posts', 'slz-core' ),
		'param_name'  => 'offset_post',
		'value'       => '',
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
				'value'       => $category,
				'description' => esc_html__( 'Choose special category to filter', 'slz-core'  )
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Default no filter by category.', 'slz-core' ),
		'group'       => esc_html__( 'Filter', 'slz-core' ),
	),
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Tag', 'slz-core' ),
		'param_name' => 'tag_list',
		'params'     => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add Tag', 'slz-core' ),
				'param_name'  => 'tag_slug',
				'value'       => $tag,
				'description' => esc_html__( 'Choose special tag to filter', 'slz-core'  )
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Default no filter by tag.', 'slz-core' ),
		'group'       => esc_html__( 'Filter', 'slz-core' ),
	),
	
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Author', 'slz-core' ),
		'param_name' => 'author_list',
		'params'     => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add Author', 'slz-core' ),
				'param_name'  => 'author',
				'value'       => $author,
				'description' => esc_html__( 'Choose special author to filter', 'slz-core'  )
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Default no filter by author.', 'slz-core' ),
		'group'       => esc_html__( 'Filter', 'slz-core' ),
	),
);
vc_map(array(
	'name'            => esc_html__( 'SLZ News Carousel', 'slz-core' ),
	'base'            => 'slzcore_news_carousel_sc',
	'class'           => 'slzcore-sc',
	'icon'            => 'icon-slzcore_news_carousel_sc',
	'category'        => SLZCORE_SC_CATEGORY,
	'description'     => esc_html__( 'List WP Posts in carousel.', 'slz-core' ),
	'params'          => $params
	)
);