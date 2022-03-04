/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

let Vuex = require("vuex");
window.Vue = require("vue").default;

Vue.use(Vuex);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component(
    "passport-clients",
    require("./components/passport/Clients").default
);
Vue.component(
    "passport-authorized-clients",
    require("./components/passport/AuthorizedClients").default
);
Vue.component(
    "passport-personal-access-tokens",
    require("./components/passport/PersonalAccessTokens").default
);
Vue.component(
    "chat-notification",
    require("./components/Notification").default
);
Vue.component(
    'dashboard-mail',
    require('./components/DashboardMail').default
);
Vue.component("chat-box", require("./components/ChatBox").default);
Vue.component("xero-invoice", require("./components/XeroInvoice").default);
Vue.component("vue-modal", require("./components/Modal").default);
Vue.component("xero-invoice-create", require("./components/XeroInvoiceCreate").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
    state: {
        showChatBox: false,
        currentIdentifier: null,
        chats: [],

    },
    getters: {},
    actions: {},
    mutations: {
        TOGGLE_CHAT_BOX(state, identifier) {
            state.showChatBox = !state.showChatBox;
            state.currentIdentifier = identifier;
        },
        SET_CHATS(state, chats) {
            console.log(chats);
            if (Array.isArray(chats)) {
                state.chats = chats;
            } else {
                state.chats.push(chats);
            }
        },
    },
});

const app = new Vue({
    el: "#app",
    store,
});
