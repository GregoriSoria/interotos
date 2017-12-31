jQuery(document).ready(function($) {
	"use strict";
	//-------------posttype slider----------------
	jQuery.fn.slzCom.slzcore_slider();
	//------------------tool tip------------------------
	jQuery.fn.slzCom.slzcore_tooltip();
	//--------------Page template & mbox------------------
	//Set link for page
	jQuery.fn.slzCom.slzcore_link();
	// Show or hide metabox
	
	var slzPageTemplate = $("#page_template"),
		slzMboxes = $(".slz-mbox"),
		slzTabMboxes = $(".slz-tab-mbox"),
		slzCurrent,
		slzTpValues = [];
	
	function slzShow(selected) {
		var tab_active = "", active = ".slz-mbox-active-all";
		if (selected) {
			tab_active = ".slz-tab-template-"+selected;
			active += ",.slz-mbox-active-"+selected;
		}
		slzMboxes.parents(".postbox").hide();
		slzMboxes.filter(active).parents(".postbox").show();
		$(".slz-tab-mbox .slz-tab-template").addClass('hide');
		$(".slz-tab-mbox " + tab_active ).removeClass('hide');
		$(".slz-tab-mbox .slz-tab").removeClass('active');
		$(".slz-tab-mbox .tab-content").hide();
		if( selected != 'default' && $(tab_active).length > 0 ) {
			$(".slz-tab-mbox " + tab_active ).addClass('active');
			$(".slz-tab-mbox " + tab_active ).show();
		} else {
			$(".slz-tab-general").addClass('active');
			$(".slz-tab-general").show();
		}
	}
	function slzGetTpClass(template) {
		template = template.replace("page-templates/","");;
		return template.replace(".php","");
	}
	function slzGetTpValue(idx,el) {
		slzTpValues[idx]=slzGetTpClass($(el).attr("value"));
	}
	function slzTpChange(el) {
		var selected = slzGetTpClass(slzPageTemplate.val());
		if (selected != slzCurrent) {
			slzCurrent = selected;
			slzShow(selected);
		}
	}
	if (slzPageTemplate.length > 0) {
		slzPageTemplate
			.find("option")
			.each(slzGetTpValue)
			.end()
			.change(slzTpChange)
			.triggerHandler("change");
	}
	$(".slz-mbox-blog-column").change(function() {
		if( $(this).val() != '1') {
			$(".slz-mbox-blog-grid").show();
		} else {
			$(".slz-mbox-blog-grid").hide();
		}
		
	}).triggerHandler("change");
	
	//Select radio (image format)
	$('.slz-mbox-radio-row label').click(function() {
		$(this).parent().find('label').removeClass('slz-image-select-selected');
		$(this).addClass('slz-image-select-selected');
	});
	$('.slz-mbox-radio-row input').change(function() {
		if ($(this).is(':checked')) {
			$('label[for="' + $(this).attr('id') + '"]').click();
		}
	});
	// images in label ie fix
	$(document).on('click', 'label img', function() {
		$('#' + $(this).parents('label').attr('for')).click();
	});
	//Check box
	$('.slz-mbox-custom-bg-row input[type=checkbox]').click(function() {
		var divcolor = $(this).parent().parent().find('div');
		if ($(this).is(':checked')) {
			divcolor.removeClass('hide');
		} else {
			divcolor.addClass('hide');
		}
	});
	
	if(0 == $("#post-body-content > *").length) {
		$("#post-body-content").hide();
	}

	//  Tab Panel in page option
	$('.tab-list a').on('click', function(e){
		e.preventDefault();
		var tab_id = $(this).attr('href');
		var tab_content = $(this).parents('.tab-panel').find('.tab-container ' + '#' + tab_id);

		$(this).parents('.tab-list').find('li').removeClass('active');
		$(this).parent().addClass('active');

		$(this).parents('.tab-panel').find('.tab-container .tab-content.active').hide();
		tab_content.fadeIn().addClass('active');
	});
	// display / hide when default setting checkbox checked
	$('.slz-footer-option').live('click', function(){
		if ($(this).is(':checked')) {
			$("#div_slz_footer_option").addClass('hide');
		} else {
			$("#div_slz_footer_option").removeClass('hide');
		}
	});
	$('.slz-sidebar-option').live('click', function(){
		if ($(this).is(':checked')) {
			$("#div_slz_sidebar_option").addClass('hide');
		} else {
			$("#div_slz_sidebar_option").removeClass('hide');
		}
	});
	$('.slz-general-option').live('click', function(){
		if ($(this).is(':checked')) {
			$("#div_slz_general_option").addClass('hide');
		} else {
			$("#div_slz_general_option").removeClass('hide');
		}
	});
	$('.slz-header-option').live('click', function(){
		if ($(this).is(':checked')) {
			$("#div_slz_header_option").addClass('hide');
		} else {
			$("#div_slz_header_option").removeClass('hide');
		}
	});
	$('.slz-page-title-option').live('click', function(){
		if ($(this).is(':checked')) {
			$("#div_slz_page_title_option").addClass('hide');
		} else {
			$("#div_slz_page_title_option").removeClass('hide');
		}
	});
	$('.slz-page-title-type-display').live('change', function(){
		if ($(this).val() != '') {
			$("#div_page_title_type_display").removeClass('hide');
		} else {
			$("#div_page_title_type_display").addClass('hide');
			$("#div_page_title_type_display").find('input.title_custom_content').val('');
		}
	});
	//--------------End page template & mbox------- 
	//--------------Pricing Table << ------------------
	var slzPricingTable     = $(".slz-pricing-table"),
		slzPricingItemDel   = $(".slz-custom-meta .pricing-item-remove"),
		slzPricingItemAdd   = $(".slz-custom-meta .pricing-item-add"),
		slzPricingItemClone = $(".slz-pricing-item-clone"),
		slzPricingAddRow    = $(".slz-custom-meta .pricing-row-add"),
		slzPricingDelRow    = $(".slz-custom-meta .pricing-row-remove"),
		slzPricingRowClone  = $(".slz-pricing-row-clone"),
		slzHidPricingItem   = $("#slz_hid_pricing_item");
	
	// Del Pricing Item
	slzPricingItemDel.live('click', function() {
		$(this).parent().remove();
	});
	// Add Pricing Item
	slzPricingItemAdd.live('click', function() {
		var regEx  = new RegExp("pricing_item","g"),
			itemID,
			itemName,
			newItem;
		itemID = jQuery.fn.slzCom.cnvInt( $(this).attr("data-item") ) + 1;
		// change item name
		newItem = slzPricingItemClone.html().replace( regEx, itemID );
		// change item id
		regEx = new RegExp("slz_pricing_meta_id","g");
		newItem = newItem.replace( regEx, "slz_pricing_meta_"+itemID );
		slzPricingTable.append(newItem);
		$(this).attr("data-item", itemID);
		// reload meta color
		slzPricingTable.find(".slz-color").addClass( jQuery.fn.slzCom.colorCss );
		jQuery.fn.slzCom.reloadMetaColor();
		
	});
	// Add Pricing Feature Row
	slzPricingAddRow.live('click', function() {
		var regEx    = new RegExp("pricing_item","g"),
			itemId = $(this).attr("data-item"),
			rowId = jQuery.fn.slzCom.cnvInt( $(this).attr("data-row") ) + 1,
			newRow;
		// change item name
		newRow = slzPricingRowClone.html().replace( regEx, itemId );
		// change row id
		regEx = new RegExp("feature_row","g");
		newRow = newRow.replace( regEx, rowId );
		$(this).attr("data-row", rowId);
		$(this).parent().find( '.slz-pricing-content' ).append( newRow );
	});
	// Del Pricing Feature Row
	slzPricingDelRow.live('click', function() {
		$(this).parent().remove();
	});
	$('.slz-pricing-icon label').live('click', function() {
		$(this).parent().find('label').removeClass('slz-icon-selected');
		$(this).addClass('slz-icon-selected');
	});
	$('.slz-pricing-icon input').live('change', function() {
		if ($(this).is(':checked')) {
			$('label[for="' + $(this).attr('id') + '"]').click();
		}
	});
	//--------------Pricing Table >> ------------------
	//video post type
	$("#slzcore_mbox_video_type").change(function(){
		if ( $(this).val() === 'vimeo'){
			$(this).parents('.slz-video-meta').find('.vimeo-id').addClass('active');
			$(this).parents('.slz-video-meta').find('.video_upload').removeClass('active');
			$(this).parents('.slz-video-meta').find('.youtube-id').removeClass('active');
			$(this).parents('.slz-video-meta').find('.video-option').addClass('active');
			$(this).parents('.slz-video-meta').find('.video-option').find('.hide-control').addClass('hide');
		}
		else if ( $(this).val() === 'youtube'){
			$(this).parents('.slz-video-meta').find('.youtube-id').addClass('active');
			$(this).parents('.slz-video-meta').find('.video_upload').removeClass('active');
			$(this).parents('.slz-video-meta').find('.vimeo-id').removeClass('active');
			$(this).parents('.slz-video-meta').find('.video-option').addClass('active');
			$(this).parents('.slz-video-meta').find('.video-option').find('.hide-control').removeClass('hide');
		}
		else if( $(this).val() === 'video-upload'){
			$(this).parents('.slz-video-meta').find('.video_upload').addClass('active');
			$(this).parents('.slz-video-meta').find('.vimeo-id').removeClass('active');
			$(this).parents('.slz-video-meta').find('.youtube-id').removeClass('active');
			$(this).parents('.slz-video-meta').find('.video-option').addClass('active');
		}
		else{
			$(this).parents('.slz-video-meta').find('.vimeo-id').removeClass('active');
			$(this).parents('.slz-video-meta').find('.youtube-id').removeClass('active');
			$(this).parents('.slz-video-meta').find('.video_upload').removeClass('active');
			$(this).parents('.slz-video-meta').find('.video-option').removeClass('active');
		}
	})
	
	if($('.slz_upload_button').length ) {
		window.uploadfield = '';
		$('.slz_upload_button').live('click', function() {
			window.uploadfield = $('.textbox-url-video', $(this).parents( '.upload' ));
			tb_show('Upload', 'media-upload.php?type=image&TB_iframe=true', false);
			return false;
		});
		window.send_to_editor_backup = window.send_to_editor;
		window.send_to_editor = function(html) {
			if(window.uploadfield) {
				if($('img', html).length >= 1) {
					var image_url = $('img', html).attr('src');
				} else {
					var image_url = $($(html)[0]).attr('href');
				}
				$(window.uploadfield).val(image_url);
				window.uploadfield = '';
				tb_remove();
			} else {
				window.send_to_editor_backup(html);
			}
		}
	}
	//upload video in post and post type video
	if ( $('#slzcore_mbox_video_type').val() === 'video-upload' ){
		$('.slz-video-meta').find('.video_upload').addClass('active');
	}

	$(document).ready(function() {
		$(".slz-select2").select2();
	});
});