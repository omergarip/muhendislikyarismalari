$(document).ready(function() {
   
    /* For the sticky navigation */
    $('.js--section-competitions').waypoint(function(direction) {
       if (direction == 'down') {
          $('#sticky-nav').removeClass('d-none');    
       } else {
          $('#sticky-nav').addClass('d-none'); 
       }
    }, {
       offset: '60px;'
    });
    
    /* Animations on scroll */
    $('.js--wp-1').waypoint(function(direction) {
        $('.js--wp-1').addClass('animated fadeInUp');
    }, {
        offset: '90%'
    });
    
    $('.js--wp-2').waypoint(function(direction) {
        $('.js--wp-2').addClass('animated fadeInUp');
    }, {
        offset: '90%'
    });
    
    $('.js--wp-3').waypoint(function(direction) {
        $('.js--wp-3').addClass('animated fadeInUp');
    }, {
        offset: '90%'
    });
    
    $('.js--wp-4').waypoint(function(direction) {
        $('.js--wp-4').addClass('animated bounce');
    }, {
        offset: '80%'
    });
    
    /* MOBILE NAV */ 
    
    $('.js--nav-icon').click(function() {
        var nav = $('.js--main-nav')
        var icon = $('.js--nav-icon i')
        
        nav.slideToggle(200);
        if (icon.hasClass('fa-bars')) {
            icon.addClass('fa-times')
            icon.removeClass('fa-bars')
        } else {
            icon.removeClass('fa-times')
            icon.addClass('fa-bars')
        }
    });
    
});


$('#myCarousel').carousel({
  interval: 4000
})

$('.carousel .carousel-item').each(function() {
  var minPerSlide = 5;
  var next = $(this).next();
  if (!next.length) {
      next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i = 0; i < minPerSlide; i++) {
      next = next.next();
      if (!next.length) {
          next = $(this).siblings(':first');
      }

      next.children(':first-child').clone().appendTo($(this));
  }
});

$('.carousel2 .carousel-item2').each(function() {
    var minPerSlide = 5;
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  
    for (var i = 0; i < minPerSlide; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
  
        next.children(':first-child').clone().appendTo($(this));
    }
  });


  jQuery(document).ready(function() {
	jQuery('.toggle-nav').click(function(e) {
		jQuery(this).toggleClass('active');
		jQuery('.menu ul').toggleClass('active');

		e.preventDefault();
	});
});

$(document).ready(function() {
    // run test on initial page load
    checkSize();

    // run test on resize of the window
    $(window).resize(checkSize);
    var checked = $(".navigation__checkbox").prop("checked")
    if(!checked)
        $(".navigation__nav").css("display", "none");
    else
        $(".navigation__nav").css("display", "block");
});

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#dashboard-wrapper").toggleClass("toggled");
});

$(document).on('change', '.custom-file-input', function (event) {
    $(this).next('.custom-file-label').html(event.target.files[0].name);
})

