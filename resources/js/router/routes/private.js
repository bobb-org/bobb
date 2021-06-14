import DashboardPage from '@pages/DashboardPage.vue';


const routes = [
	{
		path: '/dashboard',
		name: 'dashboard',
		component: DashboardPage
	},
    {
		path: '/realization/:id',
		name: 'realization',
		component: RealizationPage
	}
]

export default routes.map(route => {
	return {...route, meta: {public: false}};
});
