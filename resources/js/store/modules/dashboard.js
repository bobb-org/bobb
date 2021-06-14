import axios from 'axios';
import api from '@/utils/api';

const state = () => ({
	realizations: [],
});

const mutations = {
	setRealizations(state, realizationList) {
		state.realizations = realizationList;
	}
};

const getters = {
};

const actions = {
	getRealizations({commit}) {
		api.get('/realization').then(({data: responseData}) => {
			const {data} = responseData;
			commit('setRealizations', data);
		});
	},
};

export default {
	namespaced: true,
	state,
	getters,
	mutations,
	actions,
}
