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
		region_id: "",
	});

	const createCity = () => {
		form.post(route("system_dashboard.cities.store"), {
			errorBag: "createCity",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="City">
		<template #header>
			<FormHeader title="Create City Form" />
		</template>
		{{form}}
		<FormSection @submit.prevent="createCity">
			<template #title>Create City</template>
			<template #description>Create a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="name" value="Name" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" />
					<InputError :message="form.errors.name" class="mt-2" />
					<InputLabel for="name" value="Name MM" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name_mm" />
					<InputError :message="form.errors.name_mm" class="mt-2" />
					<InputLabel for="region_id" value="Region" />
					<Selector
						id="region_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.region_id"
						:options="$page.props.regions"
					/>
					<InputError :message="form.errors.region_id" class="mt-2" />
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Create</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>
