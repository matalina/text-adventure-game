window._ = require('lodash');
window.axios = require('axios');

import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";

import EventBus from './event';

import state from './store/state';
import mutations from "./store/mutations";
import actions from "./store/actions";

import App from "./components/App";

Vue.use(Vuex);

window.EventBus = EventBus;

const store = new Vuex.Store( {
    plugins: [createPersistedState()],
    state: state(),
    mutations,
    actions,
});


const app = new Vue({
    el: '#app',
    template: '<App/>',
    components: { App },
    store,

});
