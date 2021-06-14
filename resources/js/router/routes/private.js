import DashboardPage from '@pages/DashboardPage.vue';
import RealizationPage from '@pages/RealizationPage.vue';


const routes = [
	{
		path: '/dashboard',
		name: 'dashboard',
		component: DashboardPage
	},
    {
		path: '/realization/:id',
		name: 'realization',
		component: RealizationPage,
        props: true,
	}
]

export default routes.map(route => {
	return {...route, meta: {public: false}};
});
