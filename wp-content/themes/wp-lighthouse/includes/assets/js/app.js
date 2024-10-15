jQuery( document ).ready( function() {

    //if ( window.self !== window.top ) { window.top.location.href=window.location.href; }

    if(isTouchScreendevice()){
        jQuery(document).find('.touch-only').removeClass('d-none');
    }

    window.onscroll = function() { scrollFunction() };
    
    jQuery(document).on('click', 'a.submenu', function(e){
        e.preventDefault();
        let elem = jQuery(this).next('.dropdown');
        jQuery('.dropdown').not(jQuery(elem)).hide();
        jQuery(elem).toggle();
    });

    jQuery('body').click(function (e) {
        if ( (! jQuery(e).hasClass('dropdown')) && (!jQuery(e.target).hasClass('submenu'))) {
            jQuery('.dropdown').hide();
        }
    });

    jQuery(document).on('click', '.hamburger', function(e){
        jQuery('#sub-menu').slideToggle('fast');
    });

    jQuery(document).on('mouseover','.m-img', function(e) { 
        
        var vid = jQuery(this).find('video.preview_player');
        var ldr = jQuery(this).find('div.preview_loader');

        if(vid.length > 0) {

            ldr.show();
         
			vid.attr("data-active", "1");
            
			var playPromise = vid[0].play();
            
			if (playPromise !== undefined) {
            
				playPromise.then(_ => {
                    ldr.hide();
                    vid.show();
                })
                .catch(error => {
                  // Auto-play was prevented
                  // Show paused UI.
                });
            }
        }
    });

    jQuery(document).on('mouseout','.m-img', function(e) { 
        
        var vid = jQuery(this).find('video.preview_player');
        var ldr = jQuery(this).find('div.preview_loader');
        ldr.hide();
        
        if(vid.length > 0) {
            vid.attr('data-active', "0");
            vid.hide();
            vid[0].pause();
        }
    });

    jQuery(document).on('click', '.btn-preview-video', function(e)
    {
        e.preventDefault();
        var elem = jQuery(this);
        var elemId = elem.attr('data-id');
        var elemPlaying = elem.attr('data-playing');
        if(typeof elemId !== undefined)
        {
            var vid = jQuery('#preview-video-'+elemId);
            var ldr = jQuery('#preview-loader-'+elemId);

            if(vid.length > 0) {

                if(elemPlaying == "N") {
                    ldr.show();

                    vid.attr("data-active", "1");
                    elem.attr('data-playing', 'Y');
                    
                    var playPromise = vid[0].play();

                    elem.find('span.status').html('&#8718;');
                    
                    if (playPromise !== undefined) {
                    
                        playPromise.then(_ => {
                            ldr.hide();
                            vid.show();
                        })
                        .catch(error => {
                        // Auto-play was prevented
                        // Show paused UI.
                        });
                    }
                }
                else 
                {
                    ldr.hide();
                    vid.attr('data-active', "0");
                    elem.attr('data-playing', 'N');
                    elem.find('span.status').html('&#8883;');
                    vid.hide();
                    vid[0].pause();
                }
            }
        }
    });

    jQuery(document).on('click', '#cast-more', function(e)
    {
        e.preventDefault(); console.log('click');
        jQuery('.card-cast').css('max-height', '100%');
        jQuery('.cast .card-footer').hide();
    });

    var modal = jQuery("#modal");
    var modalOverlay = jQuery("#modal-overlay");
    var closeButton = jQuery("#close-button");
    var openButton = jQuery(".auth-user");

    jQuery(document).on('click', '#close-button', function(e) {
        e.preventDefault();
        modal.toggleClass('closed');
        modalOverlay.toggleClass('closed');
    });

    jQuery(document).on('click', '.auth-user', function(e) {
        e.preventDefault();
        modal.toggleClass('closed');
        modalOverlay.toggleClass('closed');
    });

    jQuery(document).on('change', '#blog-categories', function(e) {
        e.preventDefault();
        let href = jQuery(this).val();
        document.location.href=href;
    });

    lazyBg();
    adjustPrimaryMenu();
    window.onresize = function() {
        adjustPrimaryMenu();
    }

    if( getCookie( '_privacy_agreed' ) == "" ) {
        setTimeout(function() { jQuery('#privacy-footer').show(); }, (1000*3));
    }

    jQuery(document).on('click', '#btn-privacy-agree', function(e){
        e.preventDefault();
        jQuery('#privacy-footer').fadeOut('fast');
        setCookie('_privacy_agreed', '1', 30)
    });

});

function adjustPrimaryMenu()
{
    let primaryMenu = jQuery('#primary-menu').html();
    if(jQuery( document ).width() < 600) {
        jQuery('#mobile-primary-menu').html(primaryMenu);
    }
    else {
        jQuery('#mobile-primary-menu').html('');
    }
}

function lazyBg() {
    
    jQuery('.lazy-bg').each(function() {
        var lazy = jQuery(this);
        var src = lazy.attr('data-src');
        lazy.css('background-image', 'url("'+src+'")');
        lazy.css('background-size', 'cover');
    
    });
}

function isTouchScreendevice() {
    return 'ontouchstart' in window || navigator.maxTouchPoints;      
};

function scrollFunction() { 
    
    if( document.body.scrollTop > 100 || document.documentElement.scrollTop > 100 ) { 
        
        document.getElementById("btn-scroll-top").style.display="block";
    }
    else { 
        
        document.getElementById("btn-scroll-top").style.display="none";
    }
}

function topFunction(){ 
    
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
  
function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}