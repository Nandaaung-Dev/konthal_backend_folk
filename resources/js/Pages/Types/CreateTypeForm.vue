<script setup>
	import AppLayout from "@/Layouts/AppLayout.vue";
	import FormHeader from "@/Components/CoreUI/FormHeader.vue";
	import { useForm } from "@inertiajs/inertia-vue3";
	import FormSection from "@/Components/FormSection.vue";
	import InputError from "@/Components/InputError.vue";
	import InputLabel from "@/Components/InputLabel.vue";
	import PrimaryButton from "@/Components/PrimaryButton.vue";
	import TextInput from "@/Components/TextInput.vue";
	import Selector from "@/Components/Selector.vue";

	const form = useForm({
		name: "",
		name_mm: "",
	
	});

	const createType = () => {
		form.post(route("system_dashboard.types.store"), {
			errorBag: "createType",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="Type">
		<template #header>
			<FormHeader title="Create Type Form" />
		</template>
		{{form}}
		<FormSection @submit.prevent="createType">
			<template #title>Create Type</template>
			<template #description>Create a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="name" value="Name" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" />
					<InputError :message="form.errors.name" class="mt-2" />
					<InputLabel for="name" value="Name MM" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name_mm" />
					<InputError :message="form.errors.name_mm" class="mt-2" />
					
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Create</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>
