import Vuex from 'vuex';
import Vue from 'vue';
import createPersistedState from 'vuex-persistedstate';
import user from './modules/user';
import realization from './modules/realization';
import dashboard from './modules/dashboard';


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
		realization,
		dashboard,
	},
    plugins: [
        createPersistedState({
            paths: 'realization',
        })
    ],

})
