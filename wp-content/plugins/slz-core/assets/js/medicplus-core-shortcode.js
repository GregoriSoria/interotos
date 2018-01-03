(function($) {
	"use strict";

	$.medicplus_testimonials = function(){

		$('.slz-shortcode.sc_testimonials .testimonials').find('.slider-testimonials').each(function() {
			var attr_autospeed = '', attr_speed = '', attr_number = '', block_id = '';
			var autoplay = false;
			var speed = 1000;
			var loop = false;
			var id = $(this).attr('id');
			if (id != '') {
			    var block_id = '#' + id;
			}
			var testimonials = $(block_id + '.slider-testimonials');
			var attr_autospeed = testimonials.attr('data-autospeed');
			var attr_speed = testimonials.attr('data-speed');
			var attr_number = testimonials.attr('data-number');

			if (attr_autospeed != "" && attr_autospeed > 0) {
			    var autoplay = attr_autospeed;
			}
			if (attr_speed != "" && attr_speed > 0) {
			    var speed = attr_speed;
			}
			if (attr_number > 1) {
				var loop = true;
			}

			setTimeout(function() {
				testimonials.owlCarousel({
				autoplay: autoplay,
				autoplayHoverPause: true,
				autoplaySpeed: speed,
				margin: 0,
				loop: loop,
				nav: false,
				responsive: {
						0: {
							items: 1
						}
					}
				});
			}, 100);
			
		});

		$('.slz-shortcode.sc_testimonials').find('.testimonials-style-2').each(function() {
			var attr_autospeed = '', attr_speed = '', attr_number = '', attr_column = '', block_id = '';
			var autoplay = false;
			var speed = 1000;
			var loop = false;
			var column = 2;
			var id = $(this).attr('id');
			if (id != '') {
			    var block_id = '#' + id + ' ';
			}
			var testimonials_style_2 = $(block_id + '.slider-testimonials-style-2');
			var attr_autospeed = testimonials_style_2.attr('data-autospeed');
			var attr_speed = testimonials_style_2.attr('data-speed');
			var attr_number = testimonials_style_2.attr('data-number');
			var attr_column = testimonials_style_2.attr('data-column');

			if (attr_autospeed != "" && attr_autospeed > 0) {
			    var autoplay = attr_autospeed;
			}
			if (attr_speed != "" && attr_speed > 0) {
			    var speed = attr_speed;
			}
			if (attr_number > 1) {
				var loop = true;
			}
			if (attr_column >= 1) {
				var column = attr_column;
			}

			setTimeout(function() {
				testimonials_style_2.owlCarousel({
					autoplay: autoplay,
					autoplayHoverPause: true,
					autoplaySpeed: speed,
					margin: 30,
					loop: loop,
					nav: false,
					navText: ['&#10094;', '&#10095;'],
					responsive: {
						0: {
							items: 1
						},
						767: {
							items: column
						}
					}
				});
				$(block_id + '.nav-testimonial .nav-testimonial-inner-left').on('click', function() {
					testimonials_style_2.trigger('prev.owl.carousel');
				});
				$(block_id + '.nav-testimonial .nav-testimonial-inner-right').on('click', function() {
					testimonials_style_2.trigger('next.owl.carousel');
				});
			}, 100);

		});

	};

	$.medicplus_team = function(){
        var attr_autospeed;
        var attr_speed;
        var autoplay = false;
        var speed = 1000;
		var attr = '';
		var column;
		var col_lg = 4;
		var col_md = 3;
		var col_sm = 2;
		var col_xs = 1;
		var block_class = '';
		$(".slz-shortcode.sc_team_carousel").each(function() {
			var loop = false;
			attr = $(this).attr('data-carousel');
			if (attr != '') {
				block_class = '.' + attr + ' ';
			}
			var carousel = $(block_class + '.team-wrapper');
			column = carousel.data('column');
			if (column != '') {
				if (column == 4) {
					col_lg = column;
					col_md = column-1;
					col_sm = column-2;
					col_xs = column-3;
				} else if (column == 3) {
					col_lg = column;
					col_md = column-1;
					col_sm = column-2;
					col_xs = col_sm;
				} else if (column == 2) {
					col_lg = column;
					col_md = column-1;
					col_sm = col_md;
					col_xs = col_md;
				} else if (column == 1) {
					col_lg = column;
					col_md = col_lg;
					col_sm = col_lg;
					col_xs = col_lg;
				}
			}

			var attr_autospeed = carousel.data('autospeed');
			var attr_speed = carousel.data('speed');
			if (attr_autospeed != "" && attr_autospeed > 0) {
			    autoplay = attr_autospeed;
			}
			if (attr_speed != "" && attr_speed > 0) {
			    speed = attr_speed;
			}

			var count = carousel.data('count');
			if (count == 1 && column == 1) {
				loop = false;
			}
			var team_carousel = carousel.owlCarousel({
			    autoplayHoverPause: true,
			    autoplay: autoplay,
			    autoplaySpeed: speed,
			    loop: loop,
			    nav: false,
			    margin: 30,
			    responsive: {
			        0: {
			            items: col_xs
			        },
			        601: {
			            items: col_sm
			        },
			        768: {
			            items: col_md
			        },
			        1200: {
			            dots: false,
			            items: col_lg
			        }
			    }
			});
			$(block_class + '.nav-doctor-inner-left').click(function() {
			    team_carousel.trigger('prev.owl.carousel');
			});
			$(block_class + '.nav-doctor-inner-right').click(function() {
			    team_carousel.trigger('next.owl.carousel');
			});
		});
	};

	/* 
	 * Department paging ajax
	 * START
	 */
	$.medicplus_department_ajax_pagination_sc = function() {
		var link_paging = $('.sc_department nav.paging-ajax ul li a.pagi-link');
		link_paging.unbind("click");
		link_paging.on('click', function(e){
			e.preventDefault();
			var container  = $(this).closest('.result-department');
			$('#loader-wrapper', container).show().fadeIn();
			var page = $(this).attr('href');
			var atts = $(this).closest('.paging-ajax').parent().find('.pagination-json').attr('data-json');
			var data = {"page":page, "atts":jQuery.parseJSON(atts) };
			$.fn.Form.ajax(['top.Top_Controller', 'ajax_department_pagination'], data, function(res) {
				$(container).html(res);
				$('#loader-wrapper').show().fadeOut();
				$.medicplus_department_ajax_pagination_sc();
	            $('html, body').animate({
	                scrollTop: container.offset().top
	            }, 1000);
			});
		});
	};

	$.medicplus_contact = function() {
		$('.contact-form-inner form').addClass('appointment-form');
		$('.form-md-line-input.form-md-floating-label input, .form-md-line-input.form-md-floating-label textarea').blur(function() {
            if (!$(this).val()) {
                $(this).removeClass('edited');
            } else {
                $(this).addClass('edited');
            }
        });

        $('form.wpcf7-form').find('.wpcf7-response-output').each(function() {
        	$(this).before('<div class="clearfix"></div>');
        });
	};

	// toggle box
	$.medicplus_toggle = function() {
		$('.faq-group a').on('click', function() {
			$(this).parent().parent().parent().parent().find('.panel-heading.active').removeClass('active');
			if($(this).hasClass('collapsed')) {
				$(this).parent().parent().addClass('active');
			}
			else {
				$(this).parent().parent().removeClass('active');
			}

		});
	}

	$.medicplus_number_factor = function() {
		$('.counter-inner').text('0');
		setTimeout(function() {
			$('.progress-counter').appear(function() {
				$('.progress-counter').each(function() {
					var data_value = $(this).attr('data-value');
					$(this).find('.counter-inner').countTo({
						to: data_value,
						speed: 3000,
						refreshInterval: 100
					});
				});
			});
		}, 1000);
	}
	//news
	$.medicplus_recent_news = function() {
		// Isotope Recent News (Block)
		var isotope_grid = $('.recent-news-2');
		if( isotope_grid.length > 0 ) {
			isotope_grid.each(function() {
				var block = $(this).attr('data-item');
				if( block == undefined || block == '' ) return true;
				var isotope_grid_item = $(block + ' .recent-news-item');
				if( $(block + ' .recent-news-item' ).length > 0 ) {
					setTimeout(function() {
						if ($(window).width() > 768 && $(block + ' .grid').hasClass('grid-isotope')) {
							$(block + ' .grid-item:not(.height-2x)').each(function() {
								var recent_news_height = $(this).height(),
									recent_news_height_2x = $(this).parent().find('.grid-item.height-2x').height(),
									post_content_height = $(this).parent().find('.grid-item.height-2x .post-content').outerHeight();
								recent_news_height_2x += recent_news_height;
								$(this).parent().find('.grid-item.height-2x').css('height', recent_news_height_2x - post_content_height);
								$(this).parent().find('.grid-item.height-2x .post-image').css('height', recent_news_height_2x - post_content_height + 30);
							});
							
							$('.recent-news-wrapper .grid').isotope({
								itemSelector: '.grid-item'
							});
							
						}

						if ($(window).width() <= 768 && $(window).width() > 600) {
							var recent_news_height = $(block + ' .recent-news-2 .grid-item').height();
							$(block + ' .grid-item.height-2x .post-image').css('height', recent_news_height + 150);
							$(block + ' .grid-item.height-2x').css('height', recent_news_height + 150 + $(block + ' .grid-item.height-2x .post-content').outerHeight());
						}

						if ($(window).width() <= 600) {
							var recent_news_height = $(block + ' .grid-item').height();
							$(block + ' .grid-item.height-2x .post-image').css('height', recent_news_height);
							$(block + ' .grid-item.height-2x').css('height', recent_news_height + $(block + ' .grid-item.height-2x .post-content').outerHeight());
						}
					}, 500);
				}
			});
		}
		// Slide Recent News
		var slick_grid_item = $('.recent-news-wrapper .recent-news-list');
		if( slick_grid_item.length > 0) {
			slick_grid_item.slick({
				dots: true,
				infinite: false,
				slidesToShow: 2,
				slidesToScroll: 2,
				autoplay: false,
				speed: 500,
				responsive: [{
					breakpoint: 800,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}]
			});
		}
		//carousel
		var owl_slide_recent_news = $('.recent-post-wrapper.recent-slide .post-list');
		if( owl_slide_recent_news.length > 0) {
			var next_text = owl_slide_recent_news.attr('data-next');
			var next_prev = owl_slide_recent_news.attr('data-prev');
			owl_slide_recent_news.owlCarousel({
				autoplay: false,
				autoplayHoverPause: true,
				autoplaySpeed: 1000,
				loop: false,
				nav: true,
				navText: [next_prev, next_text],
				margin: 30,
				dots: false,
				callbacks: true,
				responsive: {
					0: {
						items: 1
					},
					700: {
						items: 2
					}
				}
			});

			$.medicplus_toggleArrows = function (){ 
				if(owl_slide_recent_news.find(".owl-item").last().hasClass('active') && owl_slide_recent_news.find(".owl-item.active").index() == owl_slide_recent_news.find(".owl-item").first().index()){                       
					owl_slide_recent_news.find('.owl-nav .owl-next').addClass("deactive");
					owl_slide_recent_news.find('.owl-nav .owl-prev').addClass("deactive"); 
				}
				/*disable next*/
				else if(owl_slide_recent_news.find(".owl-item").last().hasClass('active')){
					owl_slide_recent_news.find('.owl-nav .owl-next').addClass("deactive");
					owl_slide_recent_news.find('.owl-nav .owl-prev').removeClass("deactive"); 
				}
				/*disable previus*/
				else if(owl_slide_recent_news.find(".owl-item.active").index() == owl_slide_recent_news.find(".owl-item").first().index()) {
					owl_slide_recent_news.find('.owl-nav .owl-next').removeClass("deactive"); 
					owl_slide_recent_news.find('.owl-nav .owl-prev').addClass("deactive");
				} else {
					owl_slide_recent_news.find('.owl-nav .owl-next,.owl-nav .owl-prev').removeClass("deactive");  
				}
			}
			setTimeout(function() {
				jQuery.medicplus_toggleArrows();//toggleArrows
			}, 500);
			owl_slide_recent_news.on('translated.owl.carousel', function (event) {
				jQuery.medicplus_toggleArrows();//toggleArrows
			});
		}
	};
	$.medicplus_grid_news = function() {
		// mansory
		if($('.slz-shortcode.blog-wrapper .grid').length > 0) {
			$('.slz-shortcode.blog-wrapper .grid').isotope({
				itemSelector: '.grid-item',
				percentPosition: true
			});
		}		

	};

	$.medicplus_appoitment = function() {
		var cf7input = $( "form.appointment-form input.form-control, form.appointment-form textarea.form-control, form.appointment-form select" );
		cf7input.each(function() {
			if ( $(this).parent().is( "span.wpcf7-form-control-wrap" ) ) {
				var classSpan = $(this).parent().attr( "class" );
				$(this).unwrap();
				$(this).parent().wrapInner( '<span class="'+ classSpan +'"></div>' );
			}
		});
		if ($('form.appointment-form')) {
			$('form.appointment-form input[name=_wpcf7]').before('<input type="hidden" name="_wpcf7_slz_appointment_form" value="1">');
		}
		$('.appointment-datepicker').datepicker({format:"dd/mm/yyyy"}).on('changeDate', function(e){
			$(this).datepicker('hide');
			$(this).parent().find('label').addClass('focus');
		});
		$('.appointment-datepicker').keyup(function(){
			if ($(this).val() == '') {
				$(this).parent().find('label').removeClass('focus');
			}
		});
	};

	$.medicplus_gallery = function() {
		var galleryContent = '';
		var item = '';
		var block = '';
		if ( $('.sc_gallery .gallery-content') ) {
			setTimeout(function() {
				$('.galleryIsotope').isotope({
					itemSelector: '.alldepartment',
					layoutMode: 'masonry'
				});
			},100);
			
			var galleryContent = $('.sc_gallery .gallery-content');
			galleryContent.each(function() {
				item = $(this).attr('data-item');
				block = '.' + item + ' ';
				$(block + '.galleryContainer .alldepartment').each(function() {
					$(this).hoverdir();
				});

				$(block + ".link-gallery.fancybox").fancybox({
					pixelRatio	: 1,
					autoSize    : true,
					helpers 	: {
						title   : {
							type: 'outside'
						},
						thumbs  : {
							width   : 96,
							height  : 60
						},
						overlay	: {
							locked: false
						}
					}
				});
				
				$(block).on('click', function () {
					var _opened = $(block + ".gallery-inner .filter-button-group").hasClass("collapse in");
					if (_opened === true) {
						$(block + ".gallery-inner .btn-primary").on('click');
					}
				});

			});
			$(window).on('resize load', function () {
				if($(window).width() < 768) {
					$('.gallery-inner .filter-button-group').addClass('collapse');
				} else {
					$('.gallery-inner .filter-button-group').removeClass('collapse');
				}
			});

		}

		/*not use*/
		/*$('.gallery-inner .filter-button-group .btn').on('click', function() {
			var filterValue = $(this).attr('data-filter');
			$('#galleryContainer').isotope({
				filter: filterValue
			});
			console.log('filter-button-group');
			$('.gallery-inner .filter-button-group .btn').removeClass('active');
			$(this).addClass('active');
		});
		$('.gallery-inner #filters .btn').on('click', function() {
			var name_category = $(this).attr("data-category");
			$('.gallery-inner .btn.btn-primary span').html(name_category);
			$('.gallery-inner #filters').removeClass('in');
		});*/
	};

	$.medicplus_gallery_filter = function () {
		var galleryContent = '';
		var item = '';
		var block = '';
		if ( $('.sc_gallery .gallery-content') ) {
			var galleryContent = $('.sc_gallery .gallery-content');
			galleryContent.each(function() {
				item = $(this).attr('data-item');
				block = '.' + item + ' ';
				$(block + '.btn.gallery_filter_tab').unbind("click");
				$(block + '.btn.gallery_filter_tab').on('click', function(e){
					e.preventDefault();
					var filterBtn = $(this).parent();
					filterBtn.find('.btn').removeClass('active');
					$(this).addClass('active');
					var name_category = $(this).attr("data-category");
					var galleryInner = $(this).parent().parent();
					galleryInner.find('.btn-primary span').html(name_category);
					galleryInner.find('.filter-button-group').removeClass('in');			
					jQuery.medicplus_ajax_gallery(this, 'clear');
				});
			});
		}
	};

	$.medicplus_ajax_gallery_load_more = function() {
		var galleryContent = '';
		var item = '';
		var block = '';
		if ( $('.sc_gallery .gallery-content') ) {
			var galleryContent = $('.sc_gallery .gallery-content');
			galleryContent.each(function() {
				item = $(this).attr('data-item');
				block = '.' + item + ' ';
				$(block + '.btn.gallery_more').unbind("click");
				$(block + '.btn.gallery_more').on('click', function(e){
					e.preventDefault();
					jQuery.medicplus_ajax_gallery(this);
				});
			});
		}
	};

	$.medicplus_ajax_gallery = function(a, clear_clone) {
		var gallery_cont = $(a).parents('.gallery-content');
		gallery_cont.find('.loader-wrapper').show().fadeIn();
		if( clear_clone != undefined ) {
			gallery_cont.find('.grid-clone').html('');
		}
		gallery_cont.find('.load-more').show();
		var atts = jQuery.parseJSON($(a).attr('data-json'));
		$.fn.Form.ajax(['top.Top_Controller', 'ajax_get_more_gallery'], [atts], function(res) {
			gallery_cont.find('.grid-clone').append(res);
			gallery_cont.find('.grid-content').html("<div class='grid'>" + gallery_cont.find('.grid-clone').html() + "</div>");
			gallery_cont.find('.grid').height(gallery_cont.height());/*fix nhảy lên top gallery*/
			var gallery_atts_more = gallery_cont.find('.grid-clone .gallery_atts_more');
			var data_pages = gallery_atts_more.attr('data-pages');
			if( data_pages == '') {
				gallery_cont.find('.load-more').hide();
			}
			gallery_cont.find('.btn.gallery_more').attr('data-json', gallery_atts_more.attr('data-json'));
			gallery_atts_more.remove();
			jQuery.medicplus_ajax_gallery_load_more();
			setTimeout(function() {
				gallery_cont.find('.galleryIsotope').isotope('destroy').isotope({
					itemSelector: '.alldepartment',
					layoutMode: 'masonry'
				});
				gallery_cont.find('.loader-wrapper').fadeOut();
			}, 100);
		});
	};

	$.medicplus_carousel = function() {
		if ($('.service-content .post-slider')) {
			$('.service-content .post-slider').each(function() {
				var post_slider = $(this).owlCarousel({
					autoplay: true,
					autoplayTimeout: 3000,
					autoplaySpeed: 1200,
					mouseDrag : false,
					items: 1,
					smartSpeed: 800,
					nav: false,
					loop: true,
					dots: false
				});
				var service_content = $(this).closest('.service-content');
				$('.post-nav i.fa-angle-left', service_content).on('click', function() {
					post_slider.trigger('prev.owl.carousel');
				})
				$('.post-nav i.fa-angle-right', service_content).on('click', function() {
					post_slider.trigger('next.owl.carousel');
				});
			});
		}
		
		if ($('.slider-howwedo-wrapper')) {
			$('.slider-howwedo-wrapper').each(function() {
				var owl_department = $(this).owlCarousel({
					mouseDrag: false,
					animateIn: "fadeIn",
					animateOut: "fadeOut",
					autoplay: 3000,
					autoplayHoverPause: true,
					autoplaySpeed: 1000,
					margin: 0,
					loop: true,
					nav: false,
					URLhashListener: true,
					dots: false,
					lazyLoad : true,
					responsive: {
						0: {
							items: 1
						}
					}
				});
				var slider = $(this).closest('.slider-howwedo');
				var owl_department_thumb = $('.thumbs-howwedo', slider).owlCarousel({
					autoplay: 3000,
					autoplayHoverPause: true,
					autoplaySpeed: 1000,
					margin: 12.5,
					loop: true,
					nav: false,
					dots: false,
					lazyLoad : true,
					responsive: {
						0: {
							items: 3
						},
						400: {
							items: 4
						},
						600: {
							items: 5
						}
					}
				});
				owl_department.on('changed.owl.carousel', function(event) {
					var current = event.item.index;
					var datasrc = $(event.target).find('.owl-item').eq(current).find('.item').attr('data-item');
					$('.thumbs-howwedo .thumb-item', slider).removeClass('active');
					$('.thumbs-howwedo .thumb-item.' + datasrc, slider).addClass('active');
				});
				$('.nav-howwedo-left', slider).click(function() {
					owl_department.trigger('prev.owl.carousel');
					owl_department_thumb.trigger('prev.owl.carousel');
				});
				$('.nav-howwedo-right', slider).click(function() {
					owl_department.trigger('next.owl.carousel');
					owl_department_thumb.trigger('next.owl.carousel');
				});
				$('.thumbs-howwedo .thumb-item', slider).on('click', function(e){
					e.preventDefault();
					var index = $(this).data('item');
					owl_department.trigger('to.owl.carousel', [index, 1, true]);
				});
			});
		}
	};

	$.medicplus_feature_item = function() {
		if ($(window).width() < 1025) {
			// .whatwedo .services-wrapper - disable
			$(' .whatwedo-cancer-center .services-wrapper, .whatwedo-ent-center .services-wrapper').slick({
				slidesToShow: 3,
				slidesToScroll: 3,
				dots: true,
				arrows: false,
				infinite: false,
				responsive: [{
					breakpoint: 769,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}, {
					breakpoint: 481,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}]
			});
			$('.list-features:not(.dental-care)').slick({
				slidesToShow: 4,
				slidesToScroll: 4,
				infinite: false,
				dots: true,
				arrows: false,
				responsive: [{
					breakpoint: 991,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				}, {
					breakpoint: 678,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}, {
					breakpoint: 440,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}]
			});
		}
		// if ($(window).width() < 992) {
		// 	var owl_slide_6 = $('.team-wrapper-2').owlCarousel({
		// 		autoplayHoverPause: true,
		// 		autoplay: 3000,
		// 		autoplaySpeed: 1000,
		// 		loop: true,
		// 		nav: false,
		// 		margin: 0,
		// 		dots: true,
		// 		responsive: {
		// 			0: {
		// 				items: 1
		// 			},
		// 			601: {
		// 				items: 2
		// 			},
		// 			768: {
		// 				items: 3
		// 			}
		// 		}
		// 	});
		// }
		// carousel style 5
		if ($(window).width() > 1024) {
			$('.slz-shortcode .home-ophthalmology .list-features').owlCarousel({
				autoplay : 3000,
				autoplayHoverPause: true,
				autoplaySpeed: 1000,  
				margin: 0,
				loop: true,
				nav: true,
				dots: false,
				navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					768: {
						items: 3
					},
					992: {
						items: 4
					}
				}
			});
		}
		
	}
	$.medicplus_cf7_custom_error_message = function() {
		if( $('form.wpcf7-form').hasClass('invalid') ){
			$('form.wpcf7-form .form-group .wpcf7-not-valid-tip').each(function() {
				var message = $(this).html().replace( '[field_name]', $(this).parent().find('label').html() );
				$(this).html( message );
			});
		}
	}
	//count down
	$.medicplus_countdown = function() {
		var newYear = new Date(); 
		newYear = new Date($('#comming-soon').attr('data-date')); 
		$('#comming-soon').countdown({until: newYear}); 
	}
	//video
	$.medicplus_video = function() {
		if($(".video-embed").length) {
			var height_video = $('.video-button-play').parents('.post-image').height();
			$(window).resize(function() {
				height_video = $('.video-button-play').parents('.post-image').height();
			});

			/*video play*/
			$(".video-button-play ").on('click', function(event){
				reload_video_play();
				var parent = $(this).parent();
				var video_jele = parent.find('iframe.video-embed');
				if (video_jele.length) {
					var video_src = video_jele.attr('src');
					parent.find('.video-bg, .video-button-play').addClass('fadeOut hide-video').removeClass('fadeIn show-video');
					parent.find(".video-embed, .video-button-close").addClass('fadeIn show-video').removeClass('fadeOut hide-video');

					// video_jele.addClass('show-video');
					// parent.find('.video-button-close').addClass('show-video');
					video_jele.attr('src-ori', video_src);
					video_jele.attr('src', video_src + "&autoplay=1");
					event.preventDefault();
				}
			});

			/*video disable*/
			$(".video-button-close").on('click', function(event){
				reload_video_play();
				event.preventDefault();
			});

			/* disable video, reload src to original*/
			var reload_video_play = function () {
				$('.video-bg, .video-button-play').addClass('fadeIn show-video').removeClass('fadeOut hide-video');
				$(".video-embed, .video-button-close").addClass('fadeOut hide-video').removeClass('fadeIn show-video');
				$('.video-button-close').removeClass('show-video');
					
				// $('.video-button-close, iframe.video-embed').removeClass('show-video');
				$('.video-thumbnails').find('iframe.video-embed').each(function() {
					var video_src = $(this).attr('src'); 
					var video_src_ori = video_src.replace('&autoplay=1', '');
					$(this).attr('src', video_src_ori);
				});			
			}

		}
	}
	//image list
	$.medicplus_image_list = function() {
		//style 1
		if( $('.slz-shortcode .certificate-wrapper').length > 0 ){
			$('.slz-shortcode .certificate-wrapper').slick({
				slidesToShow: 6,
				slidesToScroll: 3,
				// infinite: true,
				dots: true,
				arrows: false,
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 5
						}
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 4
						}
					}, 
					{
						breakpoint: 769,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
						}
					}, 
					{
						breakpoint: 479,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 381,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		}
		// style 2
		if( $('.clients-wrapper').length > 0 ) {
			$('.clients-wrapper').owlCarousel({
				autoplay : 3000,
				autoplayHoverPause: true,
				autoplaySpeed: 1000,  
				margin: 25,
				loop: true,
				responsive: {
					0: {
						items: 2,
						margin: 10
					},
					480: {
						items: 3
					},
					768: {
						items: 4
					},
					1024: {
						items: 6
					}
				}
			});
		}
	}
	
	//button
	$.medicplus_button = function() {
		if( $('.slz-shortcode.button .btn.open_cf7_modal').length > 0 ){
			$('.slz-shortcode.button .btn.open_cf7_modal').on( 'click', function( e ){
				var cf7_js_uri = $(this).parent().find('.cf7_js_uri').html();
				if( cf7_js_uri ) {
					$(this).parent().find('.cf7-content .btn-wrapper img').remove();
					$.getScript( cf7_js_uri, function(){} );
				}
				var content = $(this).parent().find('.cf7-content').html();
				$('.slz_cf7_modal .modal-content').html( content );
				$.medicplus_contact();
				$.medicplus_appoitment();
			});
		}
	}
	
})(jQuery);

jQuery( document ).ready( function() {
	new WOW().init();
	jQuery.medicplus_testimonials();
	jQuery.medicplus_team();
	jQuery.medicplus_department_ajax_pagination_sc();
	jQuery.medicplus_contact();
	jQuery.medicplus_recent_news();
	jQuery.medicplus_number_factor();
	jQuery.medicplus_toggle();
	jQuery.medicplus_appoitment();
	jQuery.medicplus_gallery();
	// jQuery.medicplus_ajax_gallery();
	jQuery.medicplus_ajax_gallery_load_more();
	jQuery.medicplus_gallery_filter();
	jQuery.medicplus_feature_item();
	jQuery.medicplus_countdown();
	jQuery.medicplus_video();
	jQuery.medicplus_image_list();
	jQuery.medicplus_button();
});
jQuery( window ).load( function() {
	jQuery.medicplus_grid_news();
	jQuery.medicplus_carousel();
});