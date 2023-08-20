<script setup>
	import { Link } from "@inertiajs/inertia-vue3";
	import { ref, computed } from "vue";
	const props = defineProps({
		title: {
			type: String,
			default: "",
		},
		btnText: {
			type: String,
			default: "",
		},
	});
</script>

<template>
	<div class="flex justify-between">
		<h2 class="font-semibold">{{title}} {{test}}</h2>

		<Link
			:href="route(`system_dashboard.${$page.props.resource_name}.create`)"
			class="bg-green-600 p-2 rounded-lg"
			type="button"
			v-if="$page.props.can['create']"
		>{{btnText}}</Link>
	</div>
</template>
