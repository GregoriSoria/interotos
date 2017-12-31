// JavaScript Document
(function($) {
	"use strict";
	/**
	 * Lastest tweets
	 */
	var medicplus_LastestTweet = function() {
		$('.slz-widget .latest-tweets ul li').prepend('<div class="media-left"><i class="fa fa-twitter"></i></div>');
		$('.slz-widget .latest-tweets ul li').addClass('recent-tweets-item media');
		$('.slz-widget .latest-tweets ul li .tweet-text').wrap('<div class="media-right"></div>');
		var date_time = $('.slz-widget .latest-tweets ul li .tweet-details').html();
		$('.slz-widget .latest-tweets ul li .media-right').append('<div class="datetime">'+date_time+'</div>');
		$('.slz-widget .latest-tweets ul li .tweet-details').remove();
	};

	//archive,category widget js
	var medicplus_Archive_Widget = function() {
		$('.widget_archive').each(function (){
			$(this).find('ul').addClass('remove');
			var remove = $(this).find('.remove');
			$(this).append('<ul class="archive-list list-unstyled"></ul>');
			var ul = $(this).find('.archive-list');	
			$('li',$(this)).each(function(){
				var a = $('a',$(this));
				a.append('<i class="fa fa-angle-right"></i>');
				var content = $($(this)).html();
				ul.append('<li class="archive">'+content+'</li>');
			});
			remove.remove();
			$('li a',$(this)).addClass('archive-link');
		});
		
	};
	//tag widget
	var medicplus_TagWidget = function() {
		$('.widget_tag_cloud').addClass('popular-widget');
		$('.widget_tag_cloud').find('.tagcloud').addClass('content-widget');
		$('.tagcloud').each(function (){
			$(this).find('a').addClass('tag-item').wrap('<li class="popular-group"></li>');
			var item = $(this).html();
			$(this).append('<ul class="tag-widget list-unstyled"></ul>');
			$('li',$(this)).remove();
			$(item).wrap('.tag-widget',$(this));
			$('.tag-widget',$(this)).replaceWith('<ul class="tag-widget list-unstyled">'+item+'</ul>');
		})
		$('.widget_tag_cloud').each(function(){
			$(this).addClass('tag-list');
			$('ul li',$(this)).addClass('tag');
			$('ul li a',$(this)).addClass('tag-link');
		});
	};
	//css for widget default
	var medicplus_custom_widget_default = function() {
		$('.slz-widget').find('ul').addClass('list-unstyled');
	};
	
	/**
	 * Comment
	 */
	var medicplus_comment = function() {
		$("#submit",$("#commentform")).click(function () {
			var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
			var urlPattern = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
			var isError	= false;
			var focusEle   = null; 
			$("#commentform .input-error-msg").addClass('hide');
			$("#commentform input, #commentform textarea").removeClass('input-error');
			if ( $("#author").length ){
				if($("#comment").val().trim() == '' ){
					$('#comment-err-required').removeClass('hide');
					$("#comment").addClass('input-error');
					isError  = true;
					focusEle = "#comment";
				}
				else if($("#author").val().trim() == '' ) {
						$('#author-err-required').removeClass('hide');
						$("#author").addClass('input-error');
						isError  = true;
						focusEle = "#author";
					}
				else if($("#email").val().trim() == '' ){
					$('#email-err-required').removeClass('hide');
					$("#email").addClass('input-error');
					isError  = true;
					focusEle = "#email";
				}
				else if(!$("#email").val().match(emailRegex)){
					$('#email-err-valid').removeClass('hide');
					$("#email").addClass('input-error');
					isError  = true;
					focusEle = "#email";
				}
			}else{
				if($("#comment").val().trim() == '' ){
					$('#comment-err-required').removeClass('hide');
					$("#comment").addClass('input-error');
					isError  = true;
					focusEle = "#comment";
				}
			}
			if(isError){
				$(focusEle).focus();
				return false;
			}
			return true;
		});
		$('.entry-comment .comment-field').each(function(){
			if ($(this).val()){
				$(this).addClass('edited');
			}
		})
	}; // end comment func
	
	/**
	 * Initial Script
	 */
	$(document).ready(function() {
		medicplus_TagWidget();
		medicplus_LastestTweet();
		medicplus_Archive_Widget ();
		medicplus_custom_widget_default();
		medicplus_comment();
	});
})(jQuery);