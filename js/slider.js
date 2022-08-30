$(function(){
    $('.product-block').slick({
        infinite: true,
        dots:true,
        slidesToShow: 3,
        slidesToScroll:3,
        responsive: [
        {
            breakpoint: 877,
            settings: {
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 675,
            settings: {
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 500,
            settings: {
                arrows: true,
                slidesToShow: 2,
                slidesToScroll: 1    
            }
        }
        
    ]
    })
})
$(function(){
    $('.popular-block').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll:1,
        autoplay: true,
        autoplaySpeed: 1000,
        responsive: [
        {
            breakpoint: 877,
            settings: {
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 675,
            settings: {
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 500,
            settings: {
                arrows: true,
                slidesToShow: 2,
                slidesToScroll: 1    
            }
        }
        
    ]
    })
})