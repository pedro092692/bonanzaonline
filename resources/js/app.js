import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Clipboard from "@ryangjchandler/alpine-clipboard"

import Swiper, { Navigation, Pagination } from 'swiper';
import 'swiper/css/bundle';

const swiper = new Swiper('.swiper', {
    // configure Swiper to use modules
    modules: [Navigation, Pagination],
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
  });




import '@ckeditor/ckeditor5-build-classic';

ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'link']
    })
    .catch(error => {
        console.log(error);
});

Alpine.plugin(Clipboard)
        
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();


