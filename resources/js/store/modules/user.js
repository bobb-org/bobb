import axios from 'axios';
import router from '@/router/index';

const state = () => ({
	user: null,
	isAuthenticated: false,
});

const mutations = {
	setAuth(state, {user, isAuthenticated}) {
		state.user = user;
		state.isAuthenticated = isAuthenticated;
	}
};

const getters = {
	currentUser() {
		return state.user;
	},

	isAuthenticated() {
		return state.isAuthenticated
	}
};
const actions = {
	login({commit, dispatch}, formData) {
		axios.get('/sanctum/csrf-cookie').then(() => {
			axios.post('/login/', formData).then(response => {
				commit('setAuth', {user: {email: response.data.email}, isAuthenticated: true})
				router.push('/dashboard');
			});
		});
	},

	logout({commit, dispatch}) {
		axios.post('/logout', formData).then(() => {
			commit('setAuth', {user: null, isAuthenticated: false})
		});
	}
};

export default {
	namespaced: true,
	state,
	getters,
	mutations,
	actions,
}
