jQuery(document).ready(function($){

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    $('.upload_image_btn').click(function(e){

        var elem = jQuery(this);
        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            var target = elem.attr('data-target');
            $('#input_'+target).val(media_attachment.url);
            $('#preview_'+target).html(`<img src="${media_attachment.url}" style="max-width: 150px;height:auto;" />`);
            $('#href_'+target).attr('href', media_attachment.url);
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });

    $('.reset_image_btn').click(function(e){

        var elem = jQuery(this);
        e.preventDefault();

        var target = elem.attr('data-target');
        $('#input_'+target).val('');
        $('#href_'+target).attr('href', '#');
    });

});