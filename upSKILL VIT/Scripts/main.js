burger = document.querySelector(".burger");
navbar = document.querySelector(".navb");
navlist = document.querySelector(".items");
login = document.querySelector(".navbar-nav");

burger.addEventListener('click',()=>{
    navlist.classList.toggle('v-class-resp');
    navbar.classList.toggle('h-nav-resp');
    login.classList.toggle('v-class-resp');
})

VANTA.CELLS({
  el: "#body-index",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  color1: 0x90a4a4,
  color2: 0x0,
  size: 0.80,
  speed: 1.50
})

VANTA.CELLS({
  el: "#body-login",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  color1: 0x7e8282,
  color2: 0x0,
  size: 0.90,
  speed: 1.50
})

VANTA.CELLS({
  el: "#body-index",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  color1: 0x7e8282,
  color2: 0x0,
  size: 0.90,
  speed: 1.50
})

