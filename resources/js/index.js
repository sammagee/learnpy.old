import Vue from 'vue';
import Editor from './components/Editor';

Vue.component(Editor.name, Editor);

const app = new Vue({
    el: '#app',
});
