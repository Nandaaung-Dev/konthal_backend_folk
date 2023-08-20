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
		shop_type:{
			type:Object,
			default:()=>{}
		}
	});
	const form = useForm({
		name: props.shop_type.name,
		name_mm: props.shop_type.name_mm,
		description: props.shop_type.description,
	});

	const updateShopType = () => {
		form.put(route(`system_dashboard.shop_types.update`, props.shop_type), {
			errorBag: "updateShopType",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="ShopType">
		<template #header>
			<FormHeader title="Edit ShopType Form" />
		</template>
		{{form}}
		<FormSection @submit.prevent="updateShopType">
			<template #title>Edit ShopType</template>
			<template #description>Create a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="name" value="Name" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" />
					<InputError :message="form.errors.name" class="mt-2" />
					<InputLabel for="name" value="Name MM" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name_mm" />
					<InputError :message="form.errors.name_mm" class="mt-2" />
					<InputLabel for="description" value="Description" />
					<TextInput
						id="description"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.description"
					/>
					<InputError :message="form.errors.description" class="mt-2" />
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>