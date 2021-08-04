require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Tagify from '@yaireo/tagify';
window.Tagify = Tagify;

import flatpickr from 'flatpickr';
window.flatpickr = flatpickr;
