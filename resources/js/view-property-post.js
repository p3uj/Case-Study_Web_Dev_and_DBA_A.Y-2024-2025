jQuery(document).ready(function($) {
    $(".slider-img").on("click", function() {
        // Scroll the window to a 90px from the top
        $('html, body').animate({
            scrollTop: 90
        }, 500); // Adjust the time (500ms) for smooth scrolling effect

        $(".slider-img").removeClass("active");
        $(this).addClass("active");
    });
});

// Scroll the window to a 90px from the top
window.onload = function () {
    window.scrollTo({
        top: 90,
        behavior: 'smooth' // Smooth scroll to the middle
    });
};

document.addEventListener("DOMContentLoaded", function (){
    var sliderImages = document.getElementById('slider-images') // Get the element that has an id of 'slider-images'
    var totalUnitPhotos = sliderImages.getAttribute('data-count-unit-photos'); // Get the value of the data attribute of 'data-count-unit-photos'

    switch (totalUnitPhotos) {
        case '1':
            // Set the height of the image
            sliderImages.firstElementChild.style.height = "480px";
            break
        case '2':
            // Set the height of the image
            [sliderImages.firstElementChild, sliderImages.lastElementChild].forEach(child => {
                child.style.height = "480px";
            });
            break
        case '3':
            // Set the height of the first and last image
            [sliderImages.firstElementChild, sliderImages.lastElementChild].forEach(child => {
                child.style.height = "480px";
            });

            // Set the height of the middle image
            sliderImages.children[1].style.height = "665px";
            break;
        case '4':
            // Set the height of the first and last image
            [sliderImages.firstElementChild, sliderImages.lastElementChild].forEach(child => {
                child.style.height = "480px";
            });

            // Set the height of the middle image
            [sliderImages.children[1], sliderImages.children[2]].forEach(child => {
                child.style.height = "665px";
            });
            break
        case '5':
            // Set the height of the first and last image
            [sliderImages.firstElementChild, sliderImages.lastElementChild].forEach(child => {
                child.style.height = "480px";
            });

            // Set the height of the second and second to the last image
            [sliderImages.children[1], sliderImages.children[3]].forEach(child => {
                child.style.height = "560px";
            });

            // Set the height of the middle image
            sliderImages.children[2].style.height = "665px";
            break
        case '6':
            // Set the height of the first and last image
            [sliderImages.firstElementChild, sliderImages.lastElementChild].forEach(child => {
                child.style.height = "480px";
            });

            // Set the height of the second and second to the last image
            [sliderImages.children[1], sliderImages.children[4]].forEach(child => {
                child.style.height = "560px";
            });

            // Set the height of the middle image
            [sliderImages.children[2], sliderImages.children[3]].forEach(child => {
                child.style.height = "665px";
            });
            break
        case '7':
            // Set the height of the first and last image
            [sliderImages.firstElementChild, sliderImages.lastElementChild].forEach(child => {
                child.style.height = "480px";
            });

            // Set the height of the second and second to the last image
            [sliderImages.children[1], sliderImages.children[5]].forEach(child =>{
                child.style.height = "540px";
            });

            // Set the height of the third and third to the last image
            [sliderImages.children[2], sliderImages.children[4]].forEach(child => {
                child.style.height = "600px";
            });

            // Set the height of the middle image
            sliderImages.children[3].style.height = "665px";
            break
    }
});
