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

	const props = defineProps({
		category: {
			type: Object,
			default: () => {},
		},
	});
	const form=useForm({
        name:props.category.name,
        type_id:props.category.type_id
    })

	const updateCategory= () => {
		form.put(route(`system_dashboard.categories.update`, props.category), {
			errorBag: "updateCategory",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="Category">
		<template #header>
			<FormHeader title="Edit Category Form" />
		</template>
		{{form}}
		<FormSection @submit.prevent="updateCategory">
			<template #title>Edit Category</template>
			<template #description>Create a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="name" value="Name" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" />
					<InputError :message="form.errors.name" class="mt-2" />
					<InputLabel for="type_id" value="Type" />
					<Selector
						id="type_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.type_id"
					    :options="$page.props.types"
					/>
					<InputError :message="form.errors.type_id" class="mt-2" />
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>
