window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Vue is a JS framework, it is component-based. It has an incrementally
 * adoptable ecosystem that scales between a library and a full-featured
 * framework. We integrate Sentry error tracking if a DSN is set.
 */

window.Vue = require('vue');

import * as Sentry from '@sentry/browser';
import * as Integrations from '@sentry/integrations';

if (process.env.MIX_SENTRY_DSN != 'null') {
    Sentry.init({
        dsn: process.env.MIX_SENTRY_DSN,
        integrations: [new Integrations.Vue({
            Vue: window.Vue,
            attachProps: true
        })]
    });
}

/**
 * Lang.js, associated with the PHP tool of the same name, can be used to
 * access i18n files directly in the JS code, e.g. for Vue.js components.
 */

window.Lang = require('lang.js');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
