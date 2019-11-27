/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { ValidationProvider, ValidationObserver, extend, configure } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import id from 'vee-validate/dist/locale/id';
import VueSelect from 'vue-select';

id.messages.email = `Alamat email harus berupa alamat email yang valid.`;

for (let rule in rules) {
    extend(rule, {
        ...rules[rule], // add the rule
        message: id.messages[rule] // add its message
    });
}

configure({
    classes: {
        valid: '', // one class
        invalid: 'is-invalid' // multiple classes
    }
});

extend('uniqueUsername', {
    async validate(value) {
        // You might want to check if its a valid email
        // before sending to server...
        const { data } = await axios.post('/api/check-username', { username: value });

        // server response
        if (data.valid) {
            return true;
        }

        return {
            valid: false,
            // the data object contents can be used in the message template
            data: {
                error: data.errors.username[0]
            }
        };
    },
    message: `{error}` // will display the server error message.
});

extend('uniqueEmail', {
    async validate(value) {
        // You might want to check if its a valid email
        // before sending to server...
        const { data } = await axios.post('/api/check-username', { email: value });

        // server response
        if (data.valid) {
            return true;
        }

        return {
            valid: false,
            // the data object contents can be used in the message template
            data: {
                error: data.errors.email[0]
            }
        };
    },
    message: `{error}` // will display the server error message.
});

extend('uniquePhone', {
    async validate(value) {
        // You might want to check if its a valid email
        // before sending to server...
        const { data } = await axios.post('/api/check-username', { phone_number: value });

        // server response
        if (data.valid) {
            return true;
        }

        return {
            valid: false,
            // the data object contents can be used in the message template
            data: {
                error: data.errors.phone_number[0]
            }
        };
    },
    message: `{error}` // will display the server error message.
});

extend('password', {
    validate: (value, { other }) => value === other,
    message: 'Kata sandi tidak cocok.',
    params: [{ name: 'other', isTarget: true }]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('vue-select', VueSelect);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/*Vue.component('example-component', require('./components/ExampleComponent.vue').default);*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
