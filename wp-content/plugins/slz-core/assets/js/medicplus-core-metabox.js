jQuery(document).ready(function($) {
	"use strict";
	var slzAddSection = $(".slz-add-section"),
		slzRemoveSectionRow = $(".slz-row-remove") ;
	
	slzAddSection.live("click", function(){
		var divCont, regEx, regExIcon, objClone, objName, objNameIcon, item, objSecName, objSecNameIcon;
		divCont  = $(this).attr("data-container");
		item     = $(this).attr("data-item");
		objName  = $(this).attr("data-name");
		objNameIcon  = $(this).attr("data-name-icon");

		if( divCont == undefined ) return;

		objSecName = objName + "[" + item + "]";
		objSecNameIcon = objNameIcon + "[" + item + "]";
		// add section
		objClone = $(".slz-section-clone").html();
		regExIcon = new RegExp("section_name_icon","g");
		objClone = objClone.replace( regExIcon, objSecNameIcon );
		regEx = new RegExp("section_name","g");
		objClone = objClone.replace( regEx, objSecName );
		
		$(divCont + " .content").append(objClone);
		item = jQuery.fn.slzCom.cnvInt( item ) + 1;
		$(this).attr("data-item", item);
	});
	slzRemoveSectionRow.live("click", function(){
		$(this).parent().remove();
	});
});