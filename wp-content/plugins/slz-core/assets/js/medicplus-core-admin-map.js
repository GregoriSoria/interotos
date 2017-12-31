;(function($) {
	"use strict";
	$.slzcore_autocomplete_address = function () {
		//autocomplete address
		$(".slzcore-map-address").geocomplete().bind("geocode:result", function () {
			var address = $(this).val();
			if ( address ){
				$(this).gmap3({
					getlatlng:{
						address:address,
						callback:function(r){
							if(!r){
								return false;
							}
							var location = r[0].geometry.location;
							$(this).next(".slzcore-map-location").val( location.lat()+','+location.lng());
							$(this).parents('.slzcore-map-metabox').find(".slzcore_map_area").gmap3({
								get:{
									name:"marker",
									callback:function(m){
										m.setPosition(location);
										$(this).parents('.slzcore-map-metabox').find(".slzcore_map_area").gmap3({map:{options:{center:location}}});
									}
								}
							});
							
						}
						
					}
				});
			}
		});
		//event chang address
		$(".slzcore-map-address").focusout(function() {
			var address = $(this).val();
			if ( address ){
				$(this).gmap3({
					getlatlng:{
						address:address,
						callback:function(r){
							if(!r){
								return false;
							}
							var location = r[0].geometry.location;
							$(this).next(".slzcore-map-location").val( location.lat()+','+location.lng());
						}						
					}
				});
			}
		});
	};
	$.slzcore_get_location = function () {
		$(".slzcore-map-address").each(function (){
			var input_map_location = $(this).next(".slzcore-map-location");
			var str = input_map_location.val();
			var position;
			if(str){
				var res = str.split(",");
				position = new google.maps.LatLng( res[0], res[1] );
			}else{
				position = new google.maps.LatLng(51.5073509, -0.12775829999998223);
			}
			var option = {
				map:{ options:{zoom:14} },
				marker:{
					options:{ draggable:true },
					events:{
						dragend:function(m){
							var mark = m.getPosition();
							input_map_location.val( mark.lat()+','+mark.lng() );
						}
					}
				}
			};
			option.map.options.center = position;
			option.marker.values = [{ latLng: position }];
			$(".slzcore_map_area").css("height", 300).gmap3(option);
		});
		//get position of address
		$("body").on("keyup", ".slzcore-map-address", function(e){
			e.preventDefault();
			if(e.keyCode == 13)
				$(".slzcore-map-address").trigger("click");
			return false;
			}).parent().find(".find-address").on("click", function(){
				var address = $(this).parents('.slzcore-map-metabox').find(".slzcore-map-address").val();
				$(this).parents('.slzcore-map-metabox').find(".slzcore_map_area").gmap3({
					getlatlng:{
						address:address,
						callback:function(r){
							if(!r){
								return false;
							}
							var location = r[0].geometry.location;
							$(this).parents('.slzcore-map-metabox').find(".slzcore-map-location").val( location.lat()+','+location.lng());
							$(this).parents('.slzcore-map-metabox').find(".slzcore_map_area").gmap3({
								get:{
									name:"marker",
									callback:function(m){
										m.setPosition(location);
										$(this).parents('.slzcore-map-metabox').find(".slzcore_map_area").gmap3({map:{options:{center:location}}});
									}
								}
							});
						}
					}
				});
			});
	};
})(jQuery);

jQuery( document ).ready( function() {
	jQuery.slzcore_get_location();
	jQuery.slzcore_autocomplete_address();
});