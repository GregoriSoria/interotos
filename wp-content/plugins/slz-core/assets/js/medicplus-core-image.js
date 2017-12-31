jQuery(document).ready(function($) {
	"use strict";
	// Instantiates the variable that holds the media library frame.
	var slz_upload_frame;
	var slz_btn_upload;

	// Runs when the image button is clicked.
	$('.slz-btn-upload').live('click', function(e){

		// Prevents the default action from occuring.
		e.preventDefault();

		slz_btn_upload = $(this);
		// If the frame already exists, re-open it.
		if ( slz_upload_frame ) {
			slz_upload_frame.open();
			return;
		}

		// Sets up the media library frame
		slz_upload_frame = wp.media.frames.meta_image_frame = wp.media({
			title: slz_meta_image.title,
			button: { text:  slz_meta_image.button },
			library: { type: 'image' },
		});

		// Runs when an image is selected.
		slz_upload_frame.on('select', function(){

			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = slz_upload_frame.state().get('selection').first().toJSON();

			// Container
			var rel = slz_btn_upload.attr('data-rel');
			var self_parent = slz_btn_upload.parent();
			// Sends the attachment URL to our custom image input field.
			var med_url = media_attachment.sizes && media_attachment.sizes.medium ? media_attachment.sizes.medium.url : media_attachment.url;
			$('#' + rel + '_name').val(media_attachment.url);
			$('#' + rel + '_id').val(media_attachment.id);
			self_parent.find('img').attr('src', med_url);
			self_parent.find('div').removeClass('hide');
			slz_btn_upload.next().removeClass('hide');
		});

		// Opens the media library frame.
		slz_upload_frame.open();
	});
	$('.slz-btn-remove').live('click', function(e) {
		// Prevents the default action from occuring.
		e.preventDefault();

		var self = $(this);
		var rel = self.attr('data-rel');
		var self_parent = self.parent();

		$('#' + rel + '_name').val('');
		$('#' + rel + '_id').val('');
		self_parent.find('div').addClass('hide');
		self.addClass('hide');
	});

	/*
	* Upload gallery image
	*/
	
	var slzcore_gallery_frame;
	var slzcore_gallery_image_ids = $( '#slzcore_gallery_image_ids' );
	var slzcore_gallery_images    = $( '#slzcore_gallery_container' ).find( 'ul.gallery_images' );
	var slzcore_btn_add_images;
	
	// Runs when the gallery link is clicked.
	$('.btn-open-gallery').live('click', function(e){

		// Prevents the default action from occuring.
		e.preventDefault();

		slzcore_btn_add_images = $(this);
		// If the frame already exists, re-open it.
		if ( slzcore_gallery_frame ) {
			slzcore_gallery_frame.open();
			return;
		}

		// Sets up the media library frame
		slzcore_gallery_frame = wp.media.frames.meta_image_frame = wp.media({
			title: slzcore_btn_add_images.data( 'title' ),
			button: { text:  slzcore_btn_add_images.data( 'btn-text' ) },
			library: { type: 'image' },
			multiple: true
		});

		// Runs when an image is selected.
		slzcore_gallery_frame.on('select', function(){

			// Grabs the attachment selection and creates a JSON representation of the model.
			var selection = slzcore_gallery_frame.state().get('selection');
			var attachment_ids = slzcore_gallery_image_ids.val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if ( attachment.id ) {
					attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
					var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

					slzcore_gallery_images.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="#" class="delete" title="' + slzcore_btn_add_images.data('delete') + '">&times;</a></li></ul></li>' );
				}
			});

			slzcore_gallery_image_ids.val( attachment_ids );
		});

		// Opens the media library frame.
		slzcore_gallery_frame.open();
	});
	
	// Remove images
	$( '#slzcore_gallery_container ul.gallery_images' ).on( 'click', 'a.delete', function() {
		$( this ).closest( 'li.image' ).remove();

		var attachment_ids = '';

		$( '#slzcore_gallery_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
			var attachment_id = jQuery( this ).attr( 'data-attachment_id' );
			attachment_ids = attachment_ids + attachment_id + ',';
		});

		slzcore_gallery_image_ids.val( attachment_ids );

		return false;
	});
	
	// Image ordering
	slzcore_gallery_images.sortable({
		items: 'li.image',
		cursor: 'move',
		scrollSensitivity: 40,
		forcePlaceholderSize: true,
		forceHelperSize: false,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'wc-metabox-sortable-placeholder',
		start: function( event, ui ) {
			ui.item.css( 'background-color', '#f6f6f6' );
		},
		stop: function( event, ui ) {
			ui.item.removeAttr( 'style' );
		},
		update: function() {
			var attachment_ids = '';

			$( '#slzcore_gallery_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
				var attachment_id = jQuery( this ).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			slzcore_gallery_image_ids.val( attachment_ids );
		}
	});
	
	
	/*
	* Upload attachment image
	*/
	
	var slzcore_attachment_frame;
	var slzcore_attachment_ids = $( '#slzcore_attachment_image_ids' );
	var slzcore_attachments    = $( '#slzcore_attachment_container' ).find( 'ul.attachment_images' );
	var slzcore_btn_add_attachment;
	
	// Runs when the gallery link is clicked.
	$('.btn-open-attachment').live('click', function(e){

		// Prevents the default action from occuring.
		e.preventDefault();

		slzcore_btn_add_attachment = $(this);
		// If the frame already exists, re-open it.
		if ( slzcore_attachment_frame ) {
			slzcore_attachment_frame.open();
			return;
		}

		// Sets up the media library frame
		slzcore_attachment_frame = wp.media.frames.meta_image_frame = wp.media({
			title: slzcore_btn_add_attachment.data( 'title' ),
			button: { text:  slzcore_btn_add_attachment.data( 'btn-text' ) },
			library: { type: '' },
			multiple: true
		});

		// Runs when an image is selected.
		slzcore_attachment_frame.on('select', function(){

			// Grabs the attachment selection and creates a JSON representation of the model.
			var selection = slzcore_attachment_frame.state().get('selection');
			var attachment_ids = slzcore_attachment_ids.val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if ( attachment.id ) {
					attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
					var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
					if(attachment.type != 'image') {
						attachment_image = attachment.icon;
					}

					slzcore_attachments.append( '<li class="image" data-attachment_id="' + attachment.id + '"><div class="media-left"><img src="' + attachment_image + '" alt="" /></div><div class="media-right"><a href="' + attachment.url + '" class="title" title="' + attachment.title + '">' + attachment.title + '</a><div class="attachment_type">' + attachment.mime + '</div><a href="#" class="delete" title=""><i class="fa fa-times"></i>' + slzcore_btn_add_attachment.data('delete') + '</a></div></li>' );
				}
			});

			slzcore_attachment_ids.val( attachment_ids );
		});

		// Opens the media library frame.
		slzcore_attachment_frame.open();
	});
	
	// Remove images
	slzcore_attachments.on( 'click', 'a.delete', function() {
		$( this ).closest( 'li.image' ).remove();

		var attachment_ids = '';

		$( '#slzcore_attachment_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
			var attachment_id = jQuery( this ).attr( 'data-attachment_id' );
			attachment_ids = attachment_ids + attachment_id + ',';
		});

		slzcore_attachment_ids.val( attachment_ids );

		return false;
	});
	
	// Attachment ordering
	slzcore_attachments.sortable({
		items: 'li.image',
		cursor: 'move',
		scrollSensitivity: 40,
		forcePlaceholderSize: true,
		forceHelperSize: false,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'wc-metabox-sortable-placeholder',
		start: function( event, ui ) {
			ui.item.css( 'background-color', '#f6f6f6' );
		},
		stop: function( event, ui ) {
			ui.item.removeAttr( 'style' );
		},
		update: function() {
			var attachment_ids = '';

			$( '#slzcore_attachment_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
				var attachment_id = jQuery( this ).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			slzcore_attachment_ids.val( attachment_ids );
		}
	});

});