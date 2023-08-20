<script setup>
	import { onMounted, ref } from "vue";

	defineProps({
		modelValue: String,
		options: {
			type: Array,
			default: () => [],
		},
	});

	defineEmits(["update:modelValue"]);

	const input = ref(null);

	onMounted(() => {
		console.log(input.value);
		if (input.value.hasAttribute("autofocus")) {
			input.value.focus();
		}
	});

	defineExpose({ focus: () => input.value.focus() });
</script>

<template>
	<!-- <input
		ref="input"
		class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
		:value="modelValue"
		@input="$emit('update:modelValue', $event.target.value)"
	/>-->
	<select
		ref="input"
		@change="$emit('update:modelValue', $event.target.value)"
		class="border-gray-300 focus:border-indigo-300"
	>
		<option
			:value="result.id"
			v-for="(result,index) in options"
			:selected="result.id === modelValue"
		>{{result.name}}</option>
	</select>
</template>
