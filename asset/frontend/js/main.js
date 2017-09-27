$('.close').click(function () {
    $('.pop-top').slideUp(function(){$('body').removeClass('has-pop-top');});
    $('.close').css('display','none');
    $('.pop-top').css('display','none !important');
    $('.navbar-toggle').css('top','30px');
});

$('.close2').click(function () {
    $('.advisor-pop').animate(
        {
            'right': '-340px'
            // to move it towards the right and, probably, off-screen.
        }, 1000
        );
    setTimeout(function () {
    $('.advisor-open').animate(
        {
            'right': '0px'
            // to move it towards the right and, probably, off-screen.
        }, 500
        )},1050);
    $()
});
$('.advisor-open').click(function () {
    setTimeout(function () {
        $('.advisor-pop').animate(
            {
                'right': '0'
                // to move it towards the right and, probably, off-screen.
            }, 1000
        )
    }, 550);

    $('.advisor-open').animate(
        {
            'right': '-50px'
            // to move it towards the right and, probably, off-screen.
        }, 500
        );

});
// Can also be used with $(document).ready()
$(window).load(function () {
    $('.flexslider').flexslider({
        animation: "slide"
    });
});

$(document).ready(function () {

    function totop_button(a) {
        "use strict";
        var b = $(".scroll-top");
        b.removeClass("off on");
        if (a === "on") {
            b.addClass("on")
        } else {
            b.addClass("off")
        }
    }
       $(window).scroll(function() {
        var b = $(this).scrollTop();
        var c = $(this).height();
        var d;
        if (b > 0) {
            d = b + c / 2
        } else {
            d = 1
        }
        if (d < 1e3) {
            totop_button("off");
        } else {
            totop_button("on");
        }
        
        
    
    })
    

  $(document).on('click', '.scroll-top', function(e) {
        e.preventDefault();
        $('body,html').animate({
            scrollTop: 0
        }, $(window).scrollTop() / 7, 'linear')
    })
    
	
	$('select').niceSelect();
	
	$('.showall-about-avatar .link-viewall').click(function(){
		$(this).hide();
		var parentitem = $(this).parents('.showall-about-avatar');
		var count = parentitem.find('.about-block-1').length;
		var delay = 100;
		parentitem.find('.about-block-1').each(function(index) {
			if(index>=6) {
				$(this).delay(delay).fadeIn();
				delay+=100;
			}
		});
	});
	
	
});


$('.photo-gallery').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled:true
        },
        titleSrc: 'title'
    });
});
$('.video-popup').magnificPopup({
    type: 'iframe',

    iframe: {
        patterns: {
            dailymotion: {

                index: 'dailymotion.com',

                id: function(url) {
                    var m = url.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/);
                    if (m !== null) {
                        if (m[4] !== undefined) {

                            return m[4];
                        }
                        return m[2];
                    }
                    return null;
                },

                src: 'http://www.dailymotion.com/embed/video/%id%'

            },
            youtube: {
                index: 'youtube.com/',

                id: 'v=', // String that splits URL in a two parts, second part should be %id%
                // Or null - full URL will be returned
                // Or a function that should return %id%, for example:
                // id: function(url) { return 'parsed id'; }

                src: 'http://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
            },
            vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: 'http://player.vimeo.com/video/%id%?autoplay=1'
                },
            gmaps: {
                index: 'http://maps.google.',
                src: '%id%&output=embed'
            }
        }
    },
    titleSrc: 'title'
});
