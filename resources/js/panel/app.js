/*require('./bootstrap.panel.js');*/

/* require('alpinejs'); */

// import jQuery from "jquery";
// window.$ = window.jQuery = jQuery;

// require('materialize-css');
// go https://stackoverflow.com/questions/39019545/materialize-css-uncaught-typeerror-vel-is-not-a-function/43577171
// import "materialize-css";
// import 'materialize-css/js/toasts';

// Require Vue
import { createApp } from 'vue'
import ActionPage from './components/ActionPage'

const app = createApp({})

app.component('action-page-first', ActionPage)

app.mount('#app')