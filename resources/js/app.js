import { createApp } from "vue";
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Home from "./components/Home.vue";

const app = createApp({});

app.component("home-component", Home);
// app.use(BootstrapVue)
// app.use(IconsPlugin)

const mountedApp = app.mount("#app");
