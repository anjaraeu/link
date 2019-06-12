/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('dark-button', require('./components/DarkButton.vue').default);

Vue.component('create-link', require('./components/CreateLink.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

axios.get('/language.json').then(res => {
    Vue.prototype.$lang = new Lang({
        messages: res.data,
        locale: require('cookie-universal')().get('lang'),
        fallback: res.data.defaultlang
    });
    const app = new Vue({
        el: '#app',
        data: {
            dark: false,
        },
        mounted() {
            $('.linkinput > input').focus();
        },
        methods: {
            switchTheme: function(dark) {
                if (dark) {
                    this.dark = true;
                    $('body').addClass('darkbg');
                } else {
                    this.dark = false;
                    $('body').removeClass('darkbg');
                }
            }
        },
    });
});

