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
		provider_branch: {
			type: Object,
			default: () => {},
		},
	});
	const form = useForm({
		email: props.provider_branch.email,
		name: props.provider_branch.name,
		phone: props.provider_branch.phone,
		city_id: props.provider_branch.city_id,
		city_id: props.provider_branch.city_id,
		township_id: props.provider_branch.township_id,
		address: props.provider_branch.address,
	});

	const updateProviderBranch = () => {
		form.put(route(`system_dashboard.provider_branches.update`, props.provider_branch), {
			errorBag: "updateProviderBranch",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="ProviderBranch">
		<template #header>
			<FormHeader title="Edit ProviderBranch Form" />
		</template>
		{{form}}
		<FormSection @submit.prevent="updateProviderBranch">
			<template #title>Edit ProviderBranch</template>
			<template #description>Create a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="name" value="Name" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" />
					<InputError :message="form.errors.name" class="mt-2" />

					<InputLabel for="email" value="Email" />
					<TextInput id="email" type="text" class="block w-full mt-1" autofocus v-model="form.email" />
					<InputError :message="form.errors.email" class="mt-2" />

					<InputLabel for="phone" value="Phone " />
					<TextInput
						id="phone"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.phone"
					/>
					<InputError :message="form.errors.phone" class="mt-2" />

					<InputLabel for="address" value="Address" />
					<TextInput
						id="address"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.address"
					/>
					<InputError :message="form.errors.address" class="mt-2" />
					
					<InputLabel for="provider_id" value="Provider Id" />
					<Selector
						id="provider_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.provider_id"
						:options="$page.props.providers"
					/>
					<InputError :message="form.errors.provider_id" class="mt-2" />

					<InputLabel for="township_id" value="Township Id" />
					<Selector
						id="township_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.township_id"
						:options="$page.props.townships"
					/>
					<InputError :message="form.errors.township_id" class="mt-2" />
					<InputLabel for="city_id" value="City Id" />
					<Selector
						id="city_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.city_id"
					    :options="$page.props.cities"
					/>
					<InputError :message="form.errors.city_id" class="mt-2" />
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>