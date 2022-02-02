<template>
	<ul class="is-flex is-flex-direction-row is-flex-wrap-wrap realization-list">
		<realization-list-element
			v-for="realization in realizations"
			:key="realization.id" :realization="realization" />
	</ul>
</template>
<script>
import RealizationListElement from './RealizationListElement.vue';
export default {
	name: 'realization-list',
	props: {
		realizations: {
			type: Array,
			default: []
		}
	},
	components: {
		RealizationListElement,
	}

}
</script>
<style scoped>
	.realization-list {
		border-top: 3px solid #4a4a4a;
	}
</style>
