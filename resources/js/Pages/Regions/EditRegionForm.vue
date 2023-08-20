<script setup>
	import AppLayout from "@/Layouts/AppLayout.vue";
	import FormHeader from "@/Components/CoreUI/FormHeader.vue";
	import { useForm } from "@inertiajs/inertia-vue3";
	import FormSection from "@/Components/FormSection.vue";
	import InputError from "@/Components/InputError.vue";
	import InputLabel from "@/Components/InputLabel.vue";
	import PrimaryButton from "@/Components/PrimaryButton.vue";
	import TextInput from "@/Components/TextInput.vue";
	const props = defineProps({
		region: {
			type: Object,
			default: () => {},
		},
	});
	const form = useForm({
		name: props.region.name,
		name_mm: props.region.name_mm,
	});

	const updateRegion = () => {
		form.put(route(`system_dashboard.regions.update`, props.region), {
			errorBag: "updateRegion",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="Region">
		<template #header>
			<FormHeader title="Edit Region Form" />
		</template>
		<FormSection @submit.prevent="updateRegion">
			<template #title>Edit Region</template>
			<template #description>Create a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="name" value="Name" />
					<input type="text" v-model="form.name" />
					<!-- <TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" /> -->
					<InputError :message="form.errors.name" class="mt-2" />
					<InputLabel for="name" value="Name MM" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name_mm" />
					<InputError :message="form.errors.name_mm" class="mt-2" />
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>
