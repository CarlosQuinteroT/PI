
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.$ = window.jQuery = require('jquery'); 

window.Vue = require('vue');


//AQUI VAN LOS QUE HEMS HECHO HASTA AHORA

//MANDA LLAMAR AL CONTENIDO DE ACADEMIA
Vue.component('academia', require('./components/Academia.vue'));
//MANDA LLAMAR AL CONTENIDO DE PERSONAS
Vue.component('persona', require('./components/Persona.vue'));
//MANDA LLAMAR AL CONTENIDO DE CONTACTOS
Vue.component('contacto', require('./components/Contacto.vue'));
//MANDA LLAMAR AL CONTENIDO DE CURSOS
Vue.component('curso', require('./components/Curso.vue'));
//MANDA LLAMAR AL CONTENIDO DE TICKETS
Vue.component('ticket', require('./components/Ticket.vue'));
//MANDA LLAMAR AL CONTENIDO DE TICKETS
Vue.component('actividad', require('./components/Actividad.vue'));
//MANDA LLAMAR AL CONTENIDO DE USUARIOS
Vue.component('user', require('./components/User.vue'));
//MANDA LLAMAR AL CONTENIDO DE INSTRUCTORES
Vue.component('instructor', require('./components/Instructor.vue'));
//MANDA LLAMAR AL CONTENIDO DEL DASHBOARD
Vue.component('dashboard', require('./components/Dashboard.vue'));
//MANDA LLAMAR AL CONTENIDO DEL CALIFICAR CURSOS
Vue.component('calificarcursos', require('./components/CalifCursos.vue'));


const app = new Vue({
    el: '#app',
    data :{
        menu : 0,
        ruta: 'http://localhost:8080/sistema/public'
    }        
});
