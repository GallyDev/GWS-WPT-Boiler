var navCont = document.querySelector('nav');
var bodyCont = document.querySelector('body');
var headerCont = document.querySelector('header');
var headerHeight = headerCont.offsetHeight / 2;
var sideCont = document.querySelector('.sidebar-menu');


var toggler = document.querySelector('.navbar-toggler');

toggler.onclick = function (e) {
    
  navCont.classList.toggle('clicked');
  bodyCont.classList.toggle('opennav');
  e.preventDefault();
}




if (navCont.classList.contains('fixed') > 0) {
  if (window.innerWidth > 200) {     
    
    var scrollPosition = window.scrollY;

    window.addEventListener('scroll', function() {

      scrollPosition = window.scrollY;

      if (scrollPosition >= headerHeight) {
        navCont.classList.add('scrolled');
       
      } else {
        navCont.classList.remove('scrolled');
      }

    });

  }
}


//Embeds to Bootstrap

let allWrapper = Array.from(document.querySelectorAll('.wp-block-embed__wrapper'));

allWrapper.forEach((wrapper => {
  wrapper.classList.add('ratio');
  wrapper.classList.add('ratio-16x9');
}));

let allWrapperIframes = Array.from(document.querySelectorAll('.wp-block-column p iframe'));

allWrapperIframes.forEach((wrapper => {
  wrapper.classList.add('ratio');
  wrapper.classList.add('ratio-16x9');
}));

let allWrapperIframesStandorte = Array.from(document.querySelectorAll('.map iframe'));

allWrapperIframesStandorte.forEach((wrapper => {
  wrapper.classList.add('ratio');
  wrapper.classList.add('ratio-16x9');
}));
