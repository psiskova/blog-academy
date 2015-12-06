$( document ).ready(function() {

    var isMobile = window.matchMedia("only screen and (max-width: 991px)");
    var boundingElement = $('.right_col');
    var profileElement = $('#movable-bounding');
    var DEFAULT_HEIGHT_PENCIL = boundingElement.height();
    var DEFAULT_WIDTH_PROFILE = boundingElement.width();
    //default : static, auto

    // Bounding
    var boundingtop = boundingElement.offset().top;
    var boundingleft = boundingElement.offset().left;

    function resetPosition() {
        profileElement.css('position', 'static');
        profileElement.css('top', 'auto');
        profileElement.css('left', 'auto');
        profileElement.css('width', DEFAULT_WIDTH_PROFILE);
        boundingElement.css('height', 'auto');
    }

    function estimateMove() {
        if(boundingtop <= 0) {
            profileElement.css('position', 'fixed');
            profileElement.css('top', '0px');
            profileElement.css('left', (boundingleft + 15) + 'px');
            profileElement.css('width', DEFAULT_WIDTH_PROFILE);
            boundingElement.css('height', DEFAULT_HEIGHT_PENCIL + 'px');
        } else {
            resetPosition();
        }
    }

    resetPosition();


    // Resize checker
    $( window ).resize(function() {
        isMobile = window.matchMedia("only screen and (max-width: 991px)");
        if (isMobile) {
            resetPosition();
            // Mobile fix reset position
            profileElement.css('width', 'auto');
        }
        //console.log(isMobile);
    });



    // Scroll function
    $(document).on('scroll',function(){
        if (!isMobile.matches) {
            // Check if profileElement is out of window
            boundingtop = boundingElement.offset().top - $(window).scrollTop();
            boundingleft = boundingElement.offset().left;

            estimateMove();


        }
    });


});