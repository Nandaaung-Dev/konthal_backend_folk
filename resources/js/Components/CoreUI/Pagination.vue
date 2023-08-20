<script setup>
	import { Link } from "@inertiajs/inertia-vue3";
	defineProps({
		links: {
			type: Object,
			default: () => {},
		},
	});
</script>
<template>
	<div class="flex justify-end mt-1">
		<Link
			v-for="(link,index) in links"
			:key="index"
			class="px-4 py-3 text-sm leading-4 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
			:class="{'bg-indigo-400 text-white': link.active}"
			:href="link.url"
			v-html="link.label"
		/>
	</div>
</template>