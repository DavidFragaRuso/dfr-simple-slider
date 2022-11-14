jQuery( function($){

    /**
     *  Add Color Picker to all inputs that have 'color-field' class.
     */
    
    
        $('.color-field').each( function() {
               $( this ).wpColorPicker(); 
        } );
    
    
    /**
     *  Manage CTPs upload image button.
     */

    $( 'body' ).on( 'click', '.dfr-img-upload', function( event ) {
        event.preventDefault(); // Prevent default click and page refresh

        const button = $(this);
        const imageId = button.next().next().val();
        
        const customUploader = wp.media( {
            title: 'Insert image', // Modal Window title
            library: {
                //  uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                type: 'image'
            },
            button: {
                text: 'Use this image' // Button label text
            },
            multiple: false

        } ).on( 'select', function() {
            const attachment = customUploader.state().get( 'selection' ).first().toJSON();
			button.removeClass( 'button' ).html( '<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
			button.next().show(); // show "Remove image" link
			button.next().next().val( attachment.id ); // Populate the hidden field with image ID
        } );

        // already selected images
		customUploader.on( 'open', function() {

			if( imageId ) {
			  const selection = customUploader.state().get( 'selection' )
			  attachment = wp.media.attachment( imageId );
			  attachment.fetch();
			  selection.add( attachment ? [attachment] : [] );
			}
			
		})

		customUploader.open();

    } );

    $( 'body' ).on( 'click', '.dfr-m-img-upload', function( event ) {
        event.preventDefault();

        const button = $(this);
        const imageId = button.next().next().val();
        
        const customUploader = wp.media( {
            title: 'Insert image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Use this image'
            },
            multiple: false

        } ).on( 'select', function() {
            const attachment = customUploader.state().get( 'selection' ).first().toJSON();
			button.removeClass( 'button' ).html( '<img src="' + attachment.url + '">');
			button.next().show();
			button.next().next().val( attachment.id );
        } );

		customUploader.on( 'open', function() {

			if( imageId ) {
			  const selection = customUploader.state().get( 'selection' )
			  attachment = wp.media.attachment( imageId );
			  attachment.fetch();
			  selection.add( attachment ? [attachment] : [] );
			}
			
		})

		customUploader.open();

    } );

    $( 'body' ).on( 'click', '.dfr-remove', function( event ){
		event.preventDefault();
		const button = $(this);
		button.next().val( '' ); // emptying the hidden field
		button.hide().prev().addClass( 'button' ).html( 'Upload image' ); // replace the image with text
	});

    $( 'body' ).on( 'click', '.dfr-m-remove', function( event ){
		event.preventDefault();
		const button = $(this);
		button.next().val( '' );
		button.hide().prev().addClass( 'button' ).html( 'Upload image' );
	});
    
    /**
     *  Manage repeater metaboxes.
     */

     $( '#add-row' ).click(function() { 
        var row = $('.slide-row.empty-row').clone(true);

        var rowCount = $('#repeatable-fieldset-one').find('.slide-row').size();

        //console.log( rowCount );

        row.find('.color-field').each(function() {
            
            $(this).wpColorPicker();
            console.log( 'Llega' );
        } );

        row.find( 'input, textarea, label' ).each( function() {

            //console.log( 'Aqui si' );

            if ( !! $(this).attr('id') )
                $(this).attr('id',  $(this).attr('id').replace('[%s]', '[' + rowCount + ']') );

            if ( !! $(this).attr('name') )
                $(this).attr('name',  $(this).attr('name').replace('[%s]', '[' + rowCount + ']') );

            if ( !! $(this).attr('for') )
                $(this).attr('for',  $(this).attr('for').replace('[%s]', '[' + rowCount + ']') );
        } );

        row.removeClass( 'empty-row' ).css( 'display', 'block' );
        row.insertBefore( '#repeatable-fieldset-one .slide-row:last' );
        return false;

    } );

    $( '.remove-row' ).on('click', function() {
        $(this).parents('.slide-row').remove();
        return false;
    });

    /**
     *  Colapsible panels (not in use - DEV)
     */

    $(document).ready(function() {
        // hide all div with class .content by default
        //$('.slide-row .slide-content').hide(); 
      
        // when the class .slide-header is clicked,
        // toggle div with class .slide-content
        $('.slide-row .slide-header').click(function() { 
          $(this).parent().find('.slide-content').slideToggle(500);
        });
    });
});