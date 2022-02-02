import api from '@/utils/api';

const state = () => ({
	realizations: [],
});

const mutations = {
	setRealizations(state, realizationList) {
		console.log(realizationList);
		state.realizations = realizationList;
	}
};

const actions = {
	getRealizations({commit}) {
		api.get('/realizations').then(res => {
			commit('setRealizations', res?.data);
		});
	},
};

export default {
	namespaced: true,
	state,
	mutations,
	actions,
}
