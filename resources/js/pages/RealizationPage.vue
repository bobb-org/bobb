<template>
	<div class="container mt-6">
		<h2 class="is-size-4 has-text-weight-bold">Realizacja <span class="is-italic">{{realization.name}}</span></h2>
		<forge-viewer @selectionChanged="updateInspect"></forge-viewer>
    </div>
</template>

<script>
import ForgeViewer from "@components/ForgeViewer.vue"

export default {
	components: { ForgeViewer },
	name: 'realization-page',
    data() {
        return {
            inspectedObject: {}
        }
    },
	props: ['id'],
	computed: {
		realization() {
			return this.$store.getters['realization/getRealizationById'](this.id);
		}
	},
    methods: {
        updateInspect(newSelectionObject) {
            this.inspectedObject = newSelectionObject;
        }
    }
}
</script>

<style scoped>
	.realizations-table {
		height: 75vh;
	}
</style>
