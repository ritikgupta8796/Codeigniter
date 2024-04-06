</body>


<!-- Script of Bootstrap 4.6 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Bootstrap 5.2 latest  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Jquery Cdn script  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Codepen -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
<script>
    // // ---------Responsive-navbar-active-animation-----------
    // function test(){
    //     var tabsNewAnim = $('#navbarSupportedContent');
    //     var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
    //     var activeItemNewAnim = tabsNewAnim.find('.active');
    //     var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
    //     var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
    //     var itemPosNewAnimTop = activeItemNewAnim.position();
    //     var itemPosNewAnimLeft = activeItemNewAnim.position();
    //     $(".hori-selector").css({
    //         "top":itemPosNewAnimTop.top + "px", 
    //         "left":itemPosNewAnimLeft.left + "px",
    //         "height": activeWidthNewAnimHeight + "px",
    //         "width": activeWidthNewAnimWidth + "px"
    //     });
    //     $("#navbarSupportedContent").on("click","li",function(e){
    //         $('#navbarSupportedContent ul li').removeClass("active");
    //         $(this).addClass('active');
    //         var activeWidthNewAnimHeight = $(this).innerHeight();
    //         var activeWidthNewAnimWidth = $(this).innerWidth();
    //         var itemPosNewAnimTop = $(this).position();
    //         var itemPosNewAnimLeft = $(this).position();
    //         $(".hori-selector").css({
    //             "top":itemPosNewAnimTop.top + "px", 
    //             "left":itemPosNewAnimLeft.left + "px",
    //             "height": activeWidthNewAnimHeight + "px",
    //             "width": activeWidthNewAnimWidth + "px"
    //         });
    //     });
    // }
    // $(document).ready(function(){
    //     setTimeout(function(){ test(); });
    // });
    // $(window).on('resize', function(){
    //     setTimeout(function(){ test(); }, 500);
    // });
    // $(".navbar-toggler").click(function(){
    //     $(".navbar-collapse").slideToggle(300);
    //     setTimeout(function(){ test(); });
    // });

    // // --------------add active class-on another-page move----------
    // $(document).ready(function(){
    //     var path = window.location.pathname.split("/").pop();
    //     if ( path == '' ) {
    //         path = 'index.html';
    //     }
    //     var target = $('#navbarSupportedContent ul li a[href="'+path+'"]');
    //     target.parent().addClass('active');
    // });

    // ---------Responsive-navbar-active-animation-----------
function test(){
	var tabsNewAnim = $('#navbarSupportedContent');
	var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
	var activeItemNewAnim = tabsNewAnim.find('.active');
	var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
	var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
	var itemPosNewAnimTop = activeItemNewAnim.position();
	var itemPosNewAnimLeft = activeItemNewAnim.position();
	$(".hori-selector").css({
		"top":itemPosNewAnimTop.top + "px", 
		"left":itemPosNewAnimLeft.left + "px",
		"height": activeWidthNewAnimHeight + "px",
		"width": activeWidthNewAnimWidth + "px"
	});
	$("#navbarSupportedContent").on("click","li",function(e){
		$('#navbarSupportedContent ul li').removeClass("active");
		$(this).addClass('active');
		var activeWidthNewAnimHeight = $(this).innerHeight();
		var activeWidthNewAnimWidth = $(this).innerWidth();
		var itemPosNewAnimTop = $(this).position();
		var itemPosNewAnimLeft = $(this).position();
		$(".hori-selector").css({
			"top":itemPosNewAnimTop.top + "px", 
			"left":itemPosNewAnimLeft.left + "px",
			"height": activeWidthNewAnimHeight + "px",
			"width": activeWidthNewAnimWidth + "px"
		});
	});
}
$(document).ready(function(){
	setTimeout(function(){ test(); });
});
$(window).on('resize', function(){
	setTimeout(function(){ test(); }, 500);
});
$(".navbar-toggler").click(function(){
	$(".navbar-collapse").slideToggle(300);
	setTimeout(function(){ test(); });
});



// --------------add active class-on another-page move----------
jQuery(document).ready(function($){
	// Get current path and find target link
	var path = window.location.pathname.split("/").pop();

	// Account for home page with empty path
	if ( path == '' ) {
		path = 'index.html';
	}

	var target = $('#navbarSupportedContent ul li a[href="'+path+'"]');
	// Add active class to target link
	target.parent().addClass('active');
});




// Add active class on another page linked
// ==========================================
// $(window).on('load',function () {
//     var current = location.pathname;
//     console.log(current);
//     $('#navbarSupportedContent ul li a').each(function(){
//         var $this = $(this);
//         // if the current path is like this link, make it active
//         if($this.attr('href').indexOf(current) !== -1){
//             $this.parent().addClass('active');
//             $this.parents('.menu-submenu').addClass('show-dropdown');
//             $this.parents('.menu-submenu').parent().addClass('active');
//         }else{
//             $this.parent().removeClass('active');
//         }
//     })
// });






//-------------------------------------------Testimonials Slider---------------------------------------------------  
'use strict'
var	testim = document.getElementById("testim"),
	testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
    testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
    testimLeftArrow = document.getElementById("left-arrow"),
    testimRightArrow = document.getElementById("right-arrow"),
    testimSpeed = 4500,
    currentSlide = 0,
    currentActive = 0,
    testimTimer,
		touchStartPos,
		touchEndPos,
		touchPosDiff,
		ignoreTouch = 30;
;

window.onload = function() {
    // Testim Script
    function playSlide(slide) {
        for (var k = 0; k < testimDots.length; k++) {
            testimContent[k].classList.remove("active");
            testimContent[k].classList.remove("inactive");
            testimDots[k].classList.remove("active");
        }
        if (slide < 0) {
            slide = currentSlide = testimContent.length-1;
        }
        if (slide > testimContent.length - 1) {
            slide = currentSlide = 0;
        }
        if (currentActive != currentSlide) {
            testimContent[currentActive].classList.add("inactive");            
        }
        testimContent[slide].classList.add("active");
        testimDots[slide].classList.add("active");
        currentActive = currentSlide;
        clearTimeout(testimTimer);
        testimTimer = setTimeout(function() {
            playSlide(currentSlide += 1);
        }, testimSpeed)
    }
    testimLeftArrow.addEventListener("click", function() {
        playSlide(currentSlide -= 1);
    })
    testimRightArrow.addEventListener("click", function() {
        playSlide(currentSlide += 1);
    })    
    for (var l = 0; l < testimDots.length; l++) {
        testimDots[l].addEventListener("click", function() {
            playSlide(currentSlide = testimDots.indexOf(this));
        })
    }
    playSlide(currentSlide);
    // keyboard shortcuts
    document.addEventListener("keyup", function(e) {
        switch (e.keyCode) {
            case 37:
                testimLeftArrow.click();
                break;
                
            case 39:
                testimRightArrow.click();
                break;

            case 39:
                testimRightArrow.click();
                break;

            default:
                break;
        }
    })
		testim.addEventListener("touchstart", function(e) {
				touchStartPos = e.changedTouches[0].clientX;
		})
		testim.addEventListener("touchend", function(e) {
				touchEndPos = e.changedTouches[0].clientX;
				touchPosDiff = touchStartPos - touchEndPos;
				console.log(touchPosDiff);
				console.log(touchStartPos);	
				console.log(touchEndPos);	
				if (touchPosDiff > 0 + ignoreTouch) {
						testimLeftArrow.click();
				} else if (touchPosDiff < 0 - ignoreTouch) {
						testimRightArrow.click();
				} else {
					return;
				}
		})
}
//-------------------------------------------Testimonials Slider--------------------------------------------------- 









</script>


</html>