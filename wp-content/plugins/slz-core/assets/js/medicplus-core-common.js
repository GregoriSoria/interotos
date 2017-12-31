;(function($) {
	"use strict";
	$.fn.slzCom = function(){};
	var $this = $.fn.slzCom;
	$.fn.slzCom.colorCss = "slzcore-meta-color";
	// convert to int
	$.fn.slzCom.cnvInt = function( obj ) {
		var iVal = obj;
		if ( typeof iVal !== 'undefined' ) {
			iVal = parseInt( iVal, 10 );
		}
		if(isNaN(iVal)) {
			iVal = 0
		}
		return iVal;
	};
	$.fn.slzCom.reloadMetaColor = function( cls ) {
		if ( typeof cls == 'undefined' ) {
			cls = $.fn.slzCom.colorCss;
		}
		$("." + cls ).wpColorPicker();
	}
	
	//slider post type
	$.fn.slzCom.slzcore_slider = function () {
		$('#slider-show-button').change(function (){
			
			if($(this).val() == 'yes'){
				$(this).parents('.slz-meta-row').next('.button-option').addClass('open');
			}else{
				$(this).parents('.slz-meta-row').next('.button-option').removeClass('open');
			}
		})
	};
	$.fn.slzCom.slzcore_tooltip = function () {
		jQuery('.slzcore-tooltip').each(function() {
			var position = jQuery(this).data('position');
			var contentAsHTML = Boolean(jQuery(this).data('content-as-html'));
			jQuery(this).tooltipster({
				contentAsHTML: contentAsHTML,
				position: position,
				offsetX:5,
				offsetY:5,
				maxWidth:500,
				interactive:true,
				//autoClose:false
			});
		});
	};
	$.fn.slzCom.slzcore_link = function () {
		$( '.slz-link-build').click( function ( e ) {
			var $block,
				$input,
				$url_label,
				$title_label,
				value_object,
				$link_submit,
				$slz_link_submit,
				dialog;
			e.preventDefault();
			$block = $( this ).closest( '.slz-link' );
			$input = $block.find( '.wpb_slz_param_value' );
			$url_label = $block.find( '.url-label' );
			$title_label = $block.find( '.title-label' );
			value_object = $input.data( 'json' );
			$link_submit = $( '#wp-link-submit' );
			$slz_link_submit = $( '<input type="submit" name="slz-link-submit" id="slz-link-submit" class="button-primary" value="Set Link">' );
			$link_submit.hide();
			$( "#slz-link-submit" ).remove();
			$slz_link_submit.insertBefore( $link_submit );
			if ( ! window.wpLink && $.fn.wpdialog && $( '#wp-link' ).length ) {
				dialog = {
					$link: false,
					open: function () {
						this.$link = $( '#wp-link' ).wpdialog( {
							title: wpLinkL10n.title,
							width: 480,
							height: 'auto',
							modal: true,
							dialogClass: 'wp-dialog',
							zIndex: 300000
						} );
					},
					close: function () {
						this.$link.wpdialog( 'close' );
					}
				};
			} else {
				dialog = window.wpLink;
			}
			dialog.open( 'content' );
			console.log(typeof dialog);
			if ( _.isString( value_object.url ) ) {

				$( '#wp-link-url' ).length ? $( '#wp-link-url' ).val( value_object.url ) : $( '#url-field' ).val( value_object.url );
			}
			if ( _.isString( value_object.title ) ) {
				$( '#wp-link-text' ).length ? $( '#wp-link-text' ).val( value_object.title ) : $( '#link-title-field' ).val( value_object.title );
			}
			if ( $( '#wp-link-target' ).length ) {
				$( '#wp-link-target' ).prop( 'checked', ! _.isEmpty( value_object.target ) );
			} else {
				$( '#link-target-checkbox' ).prop( 'checked', ! _.isEmpty( value_object.target ) );
			}
			$slz-link_submit.unbind( 'click.slzLink' ).bind( 'click.slzLink', function ( e ) {
				e.preventDefault();
				e.stopImmediatePropagation();
				var options = {},
					string;
				options.url = $( '#wp-link-url' ).length ? $( '#wp-link-url' ).val() : $( '#url-field' ).val();
				options.title = $( '#wp-link-text' ).length ? $( '#wp-link-text' ).val() : $( '#link-title-field' ).val();
				var $checkbox = $( '#wp-link-target' ).length ? $( '#wp-link-target' ) : $( '#link-target-checkbox' );
				options.target = $checkbox[0].checked ? ' _blank' : '';
				string = _.map( options, function ( value, key ) {
					if ( _.isString( value ) && 0 < value.length ) {
						return key + ':' + encodeURIComponent( value );
					}
				} ).join( '|' );
				$input.val( string );
				$input.data( 'json', options );
				$url_label.attr( 'value', options.url + options.target );
				$title_label.attr( 'value',options.title );

				dialog.close();
				$link_submit.show();
				$slz-link_submit.unbind( 'click.slzLink' );
				$slz-link_submit.remove();
				// remove slz-link hooks for wpLink
				$( '#wp-link-cancel' ).unbind( 'click.slzLink' );
				window.wpLink.textarea = '';
				$checkbox.attr( 'checked', false );
				return false;
			} );
			$( '#wp-link-cancel' ).unbind( 'click.slzLink' ).bind( 'click.slzLink', function ( e ) {
				e.preventDefault();
				dialog.close();
				// remove slz-link hooks for wpLink
				$slz-link_submit.unbind( 'click.slzLink' );
				$slz-link_submit.remove();
				// remove slz-link hooks for wpLink
				$( '#wp-link-cancel' ).unbind( 'click.slzLink' );
				window.wpLink.textarea = '';
			} );
		} );
	};

	/* Demo Importer */
	$.fn.slzCom.slzProgressStep = function( step_to_percent ) {
		if (step_to_percent >= 100) {
			jQuery('#title_loading').hide();
			jQuery('#progress_loading').hide();
			jQuery('#content_loading').hide();

			jQuery('#title_success').show();
			jQuery('#content_success').show();
			jQuery('.td-progress-show-details').show();
			jQuery('.td-return-dashboard').show();
		} else {
			jQuery('.td_progress_bar div').css('width', step_to_percent + '%');
		}
	}
	$.fn.slzCom.slzProgressError = function( ) {
		jQuery('#title_loading').hide();
		jQuery('#progress_bar').hide();
		jQuery('#title_error').show();
		jQuery('div.td-demo-msg').show();
	}
	$.fn.slzCom.slzProgress_show_details = function( ) {
		jQuery('.td-progress-show-details').click(function(){
			var textShow = jQuery(this).data('text-show');
			var textHide = jQuery(this).data('text-hide');
			if ( jQuery(this).hasClass('opened') == true ) {
				jQuery('div.td-demo-msg').hide();
				jQuery(this).removeClass('opened').text(textShow);
			} else {
				jQuery('div.td-demo-msg').show();
				jQuery(this).addClass('opened').text(textHide);
			}
		});
	}
	$.fn.slzCom.slzProgressImportAjax = function() {
		$('.btn-import-data').on('click', function() {
			if ($(this).hasClass('processing') == true) {
				return false;
			}
			var text_confirm = "Are you sure to install this content ?";
			if ( $(this).data('text-confirm') != '' ) {
				text_confirm = $(this).data('text-confirm');
			}
			var cf = confirm(text_confirm);
			if (cf == false) {
				return false;
			}

			var name = $(this).data('name');
			var text_importing = $(this).data('text-importing');
			var text_imported = $(this).data('text-imported');
			var text_importer = $(this).data('text-importer');		

			var box_loader = $(this).parent('.theme-actions').parent('.theme').find('.slz-box-loader');
			box_loader.removeClass('hide');
			$('.slz-fixed-bg').removeClass('hide');
			$('.btn-import-data').addClass('processing');
			if (typeof text_importing !== 'undefined') {
				$(this).text(text_importing);
			}

			var url = ['importer.DemoImporterPlugin', 'ajaxImporting'];
			var data = {"name":name };
			$.fn.Form.ajax(url, data, function(res) {
				$('.slz-content-importer').html(res);

				$('.slz-fixed-bg').addClass('hide');
				$.fn.slzCom.slzProgress_show_details();

	            $('html, body').animate({
	                scrollTop: $('.slz-tab-style .nav-tab-wrapper').offset().top
	            }, 1000);
			});

		});
	}

})(jQuery);

jQuery( document ).ready( function() {
	jQuery.fn.slzCom.slzProgressImportAjax();
	jQuery.fn.slzCom.slzProgress_show_details();
});