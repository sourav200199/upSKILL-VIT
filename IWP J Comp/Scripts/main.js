burger = document.querySelector(".burger");
navbar = document.querySelector(".navb");
navlist = document.querySelector(".items");
login = document.querySelector(".navbar-nav");
// burger = document.querySelector(".burger");

burger.addEventListener('click',()=>{
    navlist.classList.toggle('v-class-resp');
    navbar.classList.toggle('h-nav-resp');
    login.classList.toggle('v-class-resp');
})

// anime({
//     targets: '#upskl path',
//     strokeDashoffset: [anime.setDashoffset, 0],
//     easing: 'easeInOutSine',
//     duration: 1500,
//     delay: function(el, i) { return i * 250 },
//     direction: 'alternate',
//     loop: true
//   });