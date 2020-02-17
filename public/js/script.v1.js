sidebar = $('#sidebar-wrapper');
contentSidebar = $('#content-sidebar-wrapper');

$(document).ready(function() {
    $('body').overlayScrollbars({ });

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

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#dashboard-wrapper").toggleClass("toggled");
});

$(".navigation__button").click(function(e) {
    e.preventDefault();
    sidebar.toggleClass("toggled");
    $(checkForChanges);
});


$("#content-navigation__button").click(function(e) {
    e.preventDefault();
    contentSidebar.toggleClass("toggled");
    $(checkForChanges);
});

function checkForChanges()
{
    if (contentSidebar.hasClass('toggled') || sidebar.hasClass('toggled'))
        $('#navi-toggle').prop("checked", true);
    else
        $('#navi-toggle').prop("checked", false);
}

$(document).on('change', '.custom-file-input', function (event) {
    $(this).next('.custom-file-label').html(event.target.files[0].name);
});

