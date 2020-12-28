
function scroll_to(clicked_link, nav_height) {
	var element_class = clicked_link.attr('href').replace('#', '.');
	var scroll_to = 0;
	if(element_class != '.top-content') {
		element_class += '-container';
		scroll_to = $(element_class).offset().top - nav_height;
	}
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 1000);
	}
}


jQuery(document).ready(function() {
	
	/*
	    Navigation
	*/
	$('a.scroll-link').on('click', function(e) {
		e.preventDefault();
		scroll_to($(this), $('nav').outerHeight());
	});
	
    /*
        Background
    */
    $('.section-4-container').backstretch("assets/img/backgrounds/bg.jpg");
    
    /*
	    Wow
	*/
	new WOW().init();

	$('.carousel[data-type="multi"] .item').each(function() {
		var next = $(this).next();
		console.log(next);
		if (!next.length) {
			next = $(this).siblings(':first');
		}
		next.children(':first-child').clone().appendTo($(this));
	
		for (var i = 0; i < 2; i++) {
			next = next.next();
			if (!next.length) {
				next = $(this).siblings(':first');
			}
	
			next.children(':first-child').clone().appendTo($(this));
		}
	});
	
	
	/*
	    Carousel
	*/
	$('#carousel-one').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = $('.carousel-itemone').length - 1;
		var totalItems = $('.carousel-itemone').length;
		// console.log("idx",idx)
		// console.log("totalItems",totalItems)
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('.carousel-itemone').eq(i).appendTo('.carousel-inner-one');
	            }
	            else {
	                $('.carousel-itemone').eq(0).appendTo('.carousel-inner-one');
	            }
	        }
		}
		
	});

	$('#carousel-two').on('slide.bs.carousel', function (e2) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e2 = $(e2.relatedTarget);
	    var idx2 = $e2.index();
	    var itemsPerSlide2 = $('.carousel-itemtwo').length - 1;
		var totalItems2 = $('.carousel-itemtwo').length;
		// console.log("idx2",idx2)
		// console.log("totalItems2",totalItems2)
	    
	    if (idx2 >= totalItems2-(itemsPerSlide2-1)) {
	        var it2 = itemsPerSlide2 - (totalItems2 - idx2);
	        for (var i=0; i<it2; i++) {
	            // append slides to end
	            if (e2.direction=="left") {
	                $('.carousel-itemtwo').eq(i).appendTo('.carousel-inner-two');
	            }
	            else {
	                $('.carousel-itemtwo').eq(0).appendTo('.carousel-inner-two');
	            }
	        }
		}
		
	});

	// $('#carousel-two').on('slide.bs.carousel', function (e2) {

	//     /*
	//         CC 2.0 License Iatek LLC 2018
	//         Attribution required
	//     */
	//     var $e2 = $(e2.relatedTarget);
	//     var idx2 = $e2.index();
	//     var itemsPerSlide2 = 7;
	//     var totalItems2 = $('.carousel-itemtwo').length;
	    
	//     if (idx2 >= totalItems2-(itemsPerSlide2-1)) {
	//         var it2 = itemsPerSlide2 - (totalItems2 - idx2);
	//         for (var i2=0; i2<it2; i2++) {
	//             // append slides to end
	//             if (e2.direction=="left") {
	//                 $('.carousel-itemtwo').eq(i2).appendTo('.carousel-itemtwo');
	//             }
	//             else {
	//                 $('.carousel-itemtwo').eq(0).appendTo('.carousel-itemtwo');
	//             }
	//         }
	//     }
	// });
	
});

$(document).ready(function () {
   
});

function guideSelect(){
	var guideList = $("#guideList").val();
	window.location.href='guide.php?id='+guideList;
}
