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
		owner: {
			type: Object,
			default: () => {},
		},
	});
	const form = useForm({
		username: props.owner.username,
		email: props.owner.email,
		password: props.owner.password,
		name: props.owner.name,
		phone_number: props.owner.phone_number,
		city_id: props.owner.city_id,
		township_id: props.owner.township_id,
		address: props.owner.address,
	});

	const updateOwner = () => {
		form.put(route(`system_dashboard.owners.update`, props.owner), {
			errorBag: "updateOwner",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="Owner">
		<template #header>
			<FormHeader title="Edit Owner Form" />
		</template>
		{{form}}
		<FormSection @submit.prevent="updateOwner">
			<template #title>Edit Owner</template>
			<template #description>Create a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="username" value="username" />
					<TextInput
						id="username"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.username"
					/>
					<InputError :message="form.errors.username" class="mt-2" />
					<InputLabel for="email" value="email" />
					<TextInput id="email" type="text" class="block w-full mt-1" autofocus v-model="form.email" />
					<InputError :message="form.errors.email" class="mt-2" />
					<InputLabel for="password" value="password" />
					<TextInput
						id="password"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.password"
					/>
					<InputError :message="form.errors.password" class="mt-2" />
					<InputLabel for="name" value="name" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" />
					<InputError :message="form.errors.name" class="mt-2" />
					<InputLabel for="phone_number" value="phone_number" />
					<TextInput
						id="phone_number"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.phone_number"
					/>
					<InputError :message="form.errors.phone_number" class="mt-2" />
					<InputLabel for="city_id" value="city_id" />
					<Selector
						id="city_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.city_id"
						:options="$page.props.cities"
					/>
					<InputError :message="form.errors.city_id" class="mt-2" />
					<InputLabel for="township_id" value="township_id" />
					<Selector
						id="township_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.township_id"
						:options="$page.props.townships"
					/>
					<InputError :message="form.errors.township_id" class="mt-2" />
					<InputLabel for="address" value="address" />
					<TextInput
						id="address"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.address"
					/>
					<InputError :message="form.errors.address" class="mt-2" />
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>