// HALAMAN UTAMA 
let slideIndex = 0;
showSlides(slideIndex);

function showSlides(index) {
    let slides = document.querySelectorAll('.slide');
    let dots = document.querySelectorAll('.dot');
    if (index >= slides.length) { slideIndex = 0 }
    if (index < 0) { slideIndex = slides.length - 1 }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(' active', '');
    }
    slides[slideIndex].style.display = 'block';
    dots[slideIndex].className += ' active';
}

function nextSlide() {
    showSlides(slideIndex += 1);
}

function prevSlide() {
    showSlides(slideIndex -= 1);
}

function currentSlide(index) {
    showSlides(slideIndex = index);
} 