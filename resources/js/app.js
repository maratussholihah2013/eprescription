require('./bootstrap');

import router from './router'
import { createApp } from 'vue'

//import Bootstrap, Popper, jQuery
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'
import "vue-select/dist/vue-select.css"

const app = createApp({})

import {Form, Errors } from 'vform'
window.Form = Form;
app.component(Errors.name, Errors)

import swal from 'sweetalert2';
window.swal = swal;

import vSelect from 'vue-select';
app.component("v-select",vSelect);

app.use(router)

app.mount('#app')