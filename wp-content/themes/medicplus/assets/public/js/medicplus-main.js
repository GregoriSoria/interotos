jQuery(function($){
	"use strict";
	var medicplus_fn = window.medicplus_fn || {};
	
	medicplus_fn.mainFunction = function(){
		// account on top header
		$('.account').hover(function(){
			$(this).find('.dropdown-account').removeClass('hide');
		},function(){
			$(this).find('.dropdown-account').addClass('hide');
		});
		// focus search when load page
		$('.nav-search-2').find('.searchbox').focus();
		// Show - hide box search on menu
		$('.header-main .button-search').on('click', function () {
			var header = $(this).parents('.header-main');
			if(header.hasClass('header-2') ){
				if (header.hasClass('header-fixed')){
					$('.nav-search').css({"right": '0'});
				}else{
					var wrapper_search = $('header .header-main-wrapper').width();
					var navigation_width = $('header .navigation').width();
					var right_search = (wrapper_search - navigation_width) / 2;
					$('.nav-search',header).css({"right": right_search});
				}
			}
			header.find('.nav-search').toggleClass('hide').find('.searchbox').focus();

			if ($('body').hasClass('searchbar-type-2')) {
				var width_search;
				width_search = $('header .header-main-wrapper').width() - 90;
				if( header.hasClass('header-dental-care') ){
					var btn_width = $(this).parent().find('.btn-wrapper').width();
					if(btn_width  != 'null'){
						width_search = $('header .header-main-wrapper').width() - (90 + btn_width);
					}
					var nav_search_width = $('header .medicplus-menu').width()
					$('.nav-search',header).css({"width": nav_search_width}).focus();  
				}
				$('.nav-search',header).find('input').css({"width": width_search}).focus();
				$(this).find('.fa').toggleClass('fa-close');
				$(this).parents('header').toggleClass('search-open');

			}else{
				$(this).find('.fa').toggleClass('fa-close');
			}
		});
		if ($('.back-to-top').length) {
			var scrollTrigger = 100; // px
			var backToTop = function() {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					$('.back-to-top').addClass('show');
				} else {
					$('.back-to-top').removeClass('show');
				}
			};
			backToTop();
			$(window).on('scroll', function() {
				backToTop();
			});
			$('.back-to-top').on('click', function(e) {
				e.preventDefault();
				$('html,body').animate({
					scrollTop: 0
				}, 700);
			});
		}
		//landing page
		$('.main-menu').on('click', function(e) {
			if($(this).attr('title') == 'landing-link'){
				e.preventDefault();
				var href = $(this).attr('href');
				$('html,body').animate({
					scrollTop: $(href).offset().top
				}, 700);
			}
		});
		if ($(window).width() > 991) {
			// Add class fixed for menu when scroll
			var window_height = $(window).height();
			var lastScroll = 50;
			$(window).on('scroll load', function(event) {
				var st = $(this).scrollTop();
				if ($(window).scrollTop() > window_height) {
					$(".sticky-enable .header-main").addClass('header-fixed');
				} else {
					$(".sticky-enable .header-main").removeClass('header-fixed');
				}

				if (st > lastScroll) {
					$('.sticky-enable .header-main').addClass('hide-menu');
				} else if (st < lastScroll) {
					$('.sticky-enable .header-main').removeClass('hide-menu');
				}

				if ($(window).scrollTop() <= 200) {
					$('.sticky-enable .header-main').removeClass('.header-fixed').removeClass('hide-menu');
				}

				lastScroll = st;
			});
			// header with absolute position
			$('header .header-dermatology, header .header-psychology, header .header-ent-center, header .header-nutrition, header .header-landing-page').addClass('absolute');
			
		}
		// V-ticker - effect for topbar
		
		$('.ticker-news').find('ul li').addClass('show');
		if($('.ticker-news').length) {
			$('.ticker-news').vTicker();
		}
		
		if ($(window).width() <= 991 && $('.topbar-right').hasClass('ticker-info')) {
			$('.ticker-info').vTicker();
		}
		//form comment
		$('.form-md-line-input.form-md-floating-label input, .form-md-line-input.form-md-floating-label select, .form-md-line-input.form-md-floating-label textarea').on('blur', function() {
			if (!$(this).val()) {
				$(this).removeClass('edited');
			} else {
				$(this).addClass('edited');
			}
		});

		// js show menu when screen < 1024px
		$('.hamburger-menu').on('click', function() {
			$('.hamburger-menu-wrapper').toggleClass('open');
			$('body').toggleClass('show-nav');
		});

		if ($(window).width() <= 991) {
			// show hide dropdown menu
			$('.menu-mobile>.nav-links>.menu-item-has-children>.main-menu>.icons-dropdown').on('click', function(e) {
				e.preventDefault();
				if ($(this).parents('.dropdown').find('.dropdown-menu').hasClass('dropdown-focus') === true) {
					$(this).parents('.dropdown').find('.dropdown-menu').removeClass('dropdown-focus');
					$(this).removeClass('active');
				} else {
					$('.icons-dropdown').removeClass('active');
					$(this).parents('.dropdown').find('.dropdown-menu:first').addClass('dropdown-focus');
					$(this).addClass('active');
				}
			});
			$('.dropdown-menu-1 .menu-item-has-children .icons-dropdown').on('click', function(e) {
				e.preventDefault();
				$(this).parents('.dropdown').find('.dropdown-menu-2:first').toggleClass('dropdown-focus');
				$(this).toggleClass('active');
			});
		}
		// mega menu -- mega menu tab
		$('.shw-tab-item').each(function(){
			var parent = $(this).parents('.dropdown-menu-03');
			var tabitem = $(this);
			var item_content = tabitem.find('.tab-pane');
			var data_column = item_content.data('column');
			item_content.find('.tab-content-item').children().addClass(data_column);
			var tab_content = parent.find('.tab-content');
			item_content.appendTo(tab_content);
		});
		$('.menu-tabs .tab-content').each(function(){
				$('.menu-tab-depth-2').each(function(){
					var parent_depth_2 = $(this).closest('li').find('a').attr('href');
					var tab_none_widget = $(this).parents('.dropdown-menu-03').find('.tab-content').find(parent_depth_2).find('.tab-content-item');
					$(this).children().appendTo(tab_none_widget);
				})
			$(this).children().first().addClass('active');
		});
		$('.menu-tabs .nav-tabs').each(function(){
			$(this).children().slice( 1, 2 ).addClass('active');
		});
		$('.dropdown-menu-03 .nav-tabs > li > a').hover(function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$(this).parents('.dropdown-menu-03').find('.tab-content .tab-pane').removeClass('active'); 
			$(this).parents('.dropdown-menu-03').find('.tab-content').find(href).addClass('active');
		});
		
		/* Act on the event */
		if ($('.howwedoit-inner').length > 0) {
			$('.howwedoit-inner').each(function(index, el) {
				$(this).find('.howwedoit-title').css('width', $(this)[0].getBoundingClientRect().width - 66);
			});
		}

		// keep wordpress admin bar
		if ( $( '#wpadminbar' ).length > 0) {
			var adminbar_style = '<style>html{margin-top:32px!important;} @media screen and (max-width:782px) {html{margin-top:46px!important;}}</style>';
			$('body').addClass('adminbar-on');
			$('head').prepend(adminbar_style);
		}
	
		// mega menu tab
		$('.shw-tab-item').each(function(){
			var parent = $(this).parents('.dropdown-menu-03');
			var tabitem = $(this);
			var item_content = tabitem.find('.tab-pane');
			var data_column = item_content.data('column');
			item_content.find('.tab-content-item').children().addClass(data_column);
			var tab_content = parent.find('.tab-content');
			item_content.appendTo(tab_content);
		});
		$('.menu-tabs .tab-content').each(function(){
				$('.menu-tab-depth-2').each(function(){
					var parent_depth_2 = $(this).closest('li').find('a').attr('href');
					var tab_none_widget = $(this).parents('.dropdown-menu-03').find('.tab-content').find(parent_depth_2).find('.tab-content-item');
					$(this).children().appendTo(tab_none_widget);
				})
			$(this).children().first().addClass('active');
		});
		$('.menu-tabs .nav-tabs').each(function(){
			$(this).children().slice( 1, 2 ).addClass('active');
		});
		$('.dropdown-menu-03 .nav-tabs > li > a').hover(function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$(this).parents('.dropdown-menu-03').find('.tab-content .tab-pane').removeClass('active'); 
			$(this).parents('.dropdown-menu-03').find('.tab-content').find(href).addClass('active');
		});

	};

	$(document).ready(function(){
		medicplus_fn.mainFunction();
	});
});