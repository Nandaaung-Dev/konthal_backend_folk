<template>
	<div class="flex justify-between">
		<h2 class="font-semibold">{{title}}</h2>
	</div>
</template>
<script>
	export default {
		name: "FormHeader",
		props: {
			title: {
				type: String,
				default: "",
			},
		},
	};
</script>