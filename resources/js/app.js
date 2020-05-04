import Vue from 'vue';
import Dropdown from './components/Dropdown';
import Editor from './components/Editor';

window.EventBus = new Vue();

Vue.component(Dropdown.name, Dropdown);
Vue.component(Editor.name, Editor);

const app = new Vue({
    el: '#app',
});
