/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

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
Vue.component('v-select', vSelect)
Vue.component('xero-invoice-filter', require('./components/XeroInvoiceFilter').default)
const store = new Vuex.Store({
    state: {
        showChatBox: false,
        currentIdentifier: null,
        chats: [],
        xeroInvoices: {},
        invoiceStatus: '',
        allInvoices: [],
        invoice: {
            loading: true,
            page: 1,
            status: null
        },
    },
    getters: {},
    actions: {
        async getAllInvoices({commit}, params = {}) {
            if (params.invoiceLoading) {
                commit('SET_INVOICE_LOADING', true)
            }
            if (params.page) {
                commit('SET_INVOICE_PAGE', params.page)
            }
            if (params.invoiceStatus) {
                commit('SET_INVOICE_STATUS', params.invoiceStatus)
            }
            let response = await axios.get(`/invoices/xero`, {params});
            if (response.data.status === 201) {
                commit('SET_ALL_INVOICES', response.data.data)
                commit('SET_INVOICE_LOADING', false)
            }
        }
    },
    mutations: {
        SET_INVOICE_LOADING(state, payload) {
            state.invoice = Object.assign({}, state.invoice, {loading: payload})
        },
        SET_INVOICE_PAGE(state, payload) {
            state.invoice = Object.assign({}, state.invoice, {page: payload})
        },
        SET_ALL_INVOICES(state, payload) {
            state.allInvoices = payload;
        },
        SET_XERO_INVOICE_FILTER(state, payload) {
            state.xeroInvoices = payload
        },
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
        SET_INVOICE_STATUS(state, payload) {
            state.invoice = Object.assign({}, state.invoice, {status: payload})
        }
    },
});

const app = new Vue({
    el: "#app",
    store,
});
