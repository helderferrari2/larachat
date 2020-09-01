/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import store from "./store/store";

//Global Components
Vue.component("chat-component", require("./pages/Chat.vue").default);

const app = new Vue({
    el: "#app",
    store
});
