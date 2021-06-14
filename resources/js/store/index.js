import Vuex from 'vuex';
import Vue from 'vue';
import user from './modules/user';


Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		count: 1
	},

	getters: {
		//sth
	},

	mutations: {
		//sth
	},

	actions: {
		//sth
	},
	modules: {
		user,
	}
})
