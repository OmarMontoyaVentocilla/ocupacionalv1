/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VeeValidate = require('vee-validate');
window.filestyle = require('bootstrap-filestyle');

const config = {
    errorBagName: 'errors', // change if property conflicts
    fieldsBagName: 'fields',
    delay: 0,
    locale: 'es',
    dictionary: null,
    strict: true,
    classes: false,
    classNames: {
        touched: 'touched', // the control has been blurred
        untouched: 'untouched', // the control hasn't been blurred
        valid: 'valid', // model is valid
        invalid: 'invalid', // model is invalid
        pristine: 'pristine', // control has not been interacted with
        dirty: 'dirty' // control has been interacted with
    },
    events: 'input|blur',
    inject: true,
    validity: false,
    aria: true,
    i18n: null, // the vue-i18n plugin instance,
    i18nRootKey: 'validations' // the nested key under which the validation messsages will be located
};
Vue.use(VeeValidate, config);
Vue.use(filestyle);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('autor', require('./components/autor/Autor.vue'));
Vue.component('idioma', require('./components/idioma/Idioma.vue'));
Vue.component('editorial', require('./components/editorial/Editorial.vue'));
Vue.component('role', require('./components/rol/Role.vue'));
Vue.component('usuario', require('./components/usuario/Usuario.vue'));
Vue.component('diagnostico', require('./components/diagnostico/Diagnostico.vue'));
Vue.component('especialidad', require('./components/especialidad/Especialidad.vue'));
Vue.component('equipo', require('./components/equipo/Equipo.vue'));
Vue.component('empresa', require('./components/empresa/Empresa.vue'));
Vue.component('asignar', require('./components/asignar/Asignar.vue'));
Vue.component('permisos', require('./components/permisos/Permisos.vue'));
Vue.component('examenes', require('./components/examenes/Examen.vue'));
Vue.component('catalogo', require('./components/catalogo/CatalogoEmpresa.vue'));
Vue.component('protocolo', require('./components/protocolo/Protocolo.vue'));
Vue.component('paciente', require('./components/paciente/Paciente.vue'));
Vue.component('atencion', require('./components/atencion/Atencion.vue'));
Vue.component('doctor', require('./components/doctor/Doctor.vue'));
Vue.component('atenocup', require('./components/atencionocupacional/AtencionOcupacional.vue'));
Vue.component('triaje', require('./components/triaje/Triaje.vue'));
Vue.component('dermatologia', require('./components/dermatologia/Dermatoologia.vue'));
Vue.component('antecedentes', require('./components/antecedentes/Antecedentes.vue'));
Vue.component('historia', require('./components/historia/Historia.vue'));
const app = new Vue({
    el: '#app'
});