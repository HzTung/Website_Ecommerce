var swiper = new Swiper(".swiper", {
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    // Enable auto-play with 3 seconds interval
    autoplay: {
        delay: 2000,
    },
    // Enable debugger
    debugger: true,
});
