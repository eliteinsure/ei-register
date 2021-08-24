require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Tagify from '@yaireo/tagify';
window.Tagify = Tagify;

import flatpickr from 'flatpickr';
window.flatpickr = flatpickr;

import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
window.FilePond = FilePond;
FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
