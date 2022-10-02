import Swiper from 'swiper';

new Swiper(".swiper-advertisers", {
    slidesPerView: 3,
    spaceBetween: 38,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination-advertisers",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 4,
            spaceBetween: 38,
        },
        768: {
            slidesPerView: 5,
            spaceBetween: 48,
        },
        1024: {
            slidesPerView: 6,
            spaceBetween: 48,
        },
    },
});

new Swiper(".swiper-partners", {
    slidesPerView: 3,
    spaceBetween: 38,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination-partners",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 4,
            spaceBetween: 38,
        },
        768: {
            slidesPerView: 5,
            spaceBetween: 48,
        },
        1024: {
            slidesPerView: 6,
            spaceBetween: 48,
        },
    },
});
