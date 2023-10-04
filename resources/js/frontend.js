import Alpine from 'alpinejs'
import './editor';

export const frontHome = () => ({
  init() {
    this.navbarProc(true);
  },
  topOffset: 150,
  navbarProc() {
    const a = document.getElementById('navbar-wrapper');
    if (window.scrollY > this.topOffset) {
      a.classList.add('navbar-wrapper-sec')
    } else {
      a.classList.remove('navbar-wrapper-sec')
    }
  },
  scrollWatch: ($this) => {
    $this.navbarProc();
  }
})
Alpine.data('front_home', frontHome);
window.Alpine = Alpine;

Alpine.start();
