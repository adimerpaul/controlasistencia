// require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueSimpleAlert from "vue-simple-alert";
import 'sweetalert2/src/sweetalert2.scss'
Vue.use(VueSimpleAlert);

Vue.use(require('vue-moment'));


import VueToast from 'vue-toast-notification';
// Import one of available themes
import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-sugar.css';




Vue.use(VueToast);



// let instance = Vue.$toast.open('You did it!');

//Vue.$toast.open({/* options */});

// Force close specific toast
// instance.close();
// Close all opened toast immediately
// Vue.$toast.clear();


import Auto from './components/Auto';
import Home from './components/Home';
import Usuario from './components/Usuario';
import Persona from './components/Persona';
import Asistencia from './components/Asistencia';
import Reporte from './components/Reporte';
import Destino from './components/Destino';
import Recinto from './components/Recinto';
import Salidas from './components/Salidas';
import Registroautomovil from './components/RegistroAutomovil';
import Salidaautomovil from './components/SalidaAutomovil';
import Reportautomovil from './components/Reportautomovil';
import Reportpersona from './components/Reportpersona';
import opersona from './components/opersona';
import oautomovil from './components/oautomovil';
import historialci from './components/historialci';
import historialnombre from './components/historialnombre';
import historialplaca from './components/historialplaca';

const Bar = { template: '<div>bar</div>' }

const routes = [
    { path: '/usuario', component: Usuario },
    { path: '/historialci', component: historialci },
    { path: '/historialnombre', component: historialnombre },
    { path: '/verpersona', component: Persona },
    { path: '/verasistencia', component: Asistencia },
    { path: '/reporte', component: Reporte },
    { path: '/verauto', component: Auto },
    { path: '/verdestino', component: Destino },
    { path: '/home', component: Home },
    { path: '/verrecinto', component: Recinto },
    { path: '/salidas', component: Salidas },
    { path: '/registroautomovil', component: Registroautomovil },
    { path: '/salidaautomovil', component: Salidaautomovil },
    { path: '/reportpersona', component: Reportpersona },
    { path: '/reportautomovil', component: Reportautomovil },
    { path: '/opersona', component: opersona },
    { path: '/oautomovil', component: oautomovil },
    { path: '/historialplaca', component: historialplaca },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})



// Vue.component('example-component', require('./components/ExampleComponent.vue').default);



// const app = new Vue({
//     el: '#app',
// });
const app = new Vue({
    router
}).$mount('#app')
