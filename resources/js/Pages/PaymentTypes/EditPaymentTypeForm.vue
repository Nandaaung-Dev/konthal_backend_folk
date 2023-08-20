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
		payment_type: Object,
	});
	const form = useForm({
		name: props.payment_type.name,
		name_mm: props.payment_type.name_mm,
	});

	const updatePaymentType = () => {
		form.put(
			route(`system_dashboard.payment_types.update`, props.payment_type),
			{
				errorBag: "updatePaymentType",
				preserveScroll: true,
			}
		);
	};
</script>
<template>
	<AppLayout title="PaymentType">
		<template #header>
			<FormHeader title="Edit PaymentType Form" />
		</template>
		<FormSection @submit.prevent="updatePaymentType">
			<template #title>Edit PaymentType</template>
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
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>
