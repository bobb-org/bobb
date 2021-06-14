import api from '@/utils/api';
import router from '@/router/index';

const state = () => ({
	user: window.auth_user
});

const mutations = {
	setAuth(state, user) {
		state.user = user;
	}
};

const getters = {
	currentUser: state => {
		return state.user;
	},

	isAuthenticated: state => {
		return state.user !== null;
	},
};
const actions = {
	login({commit}, formData) {
		api.get('/sanctum/csrf-cookie').then(() => {
			axios.post('/login/', formData).then(response => {
				commit('setAuth', {email: response.data.email})
				router.push('/dashboard');
			});
		});
	},

	logout({commit}) {
		api.post('/logout').then(() => {
			commit('setAuth', null)
			router.push('/login');
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
