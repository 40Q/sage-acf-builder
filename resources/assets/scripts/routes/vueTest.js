import Vue from 'vue';
import VueTest from '../vue/VueTest.vue';

export default {
	init() {
		// JavaScript to be fired on all pages
		new Vue({
			components: {
				VueTest,
			},
			el: '#vue-test',
		});
	},
};
