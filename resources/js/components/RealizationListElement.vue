<template>
	<li class="realization-list-element is-flex-direction-column is-justify-content-center mt-5">
        <i class="fas fa-folder fa-3x"></i>
        <span>{{realization.name}}</span>
    </li>
</template>
<script>
export default {
	name: 'realization-list-element',
	props: {
		realization: {
			type: Object,
			default: []
		}
	},
}
</script>
<style scoped>
    .realization-list-element {
        flex-basis: 20%;
    }

    .realization-list-element i {
        display: block;
    }
</style>
