var slideIndex = 1;
window.onload = (event) => {
  showSlides(slideIndex);
}

function plusSlide(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName('slide');
  var thumbnails = document.getElementsByClassName('thumbnail');
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none';
  }
  for (i = 0; i < thumbnails.length; i++) {
    thumbnails[i].className = thumbnails[i].className.replace(' active', '');
  }
  slides[slideIndex-1].style.display = 'block';
  thumbnails[slideIndex-1].className += ' active';
}

