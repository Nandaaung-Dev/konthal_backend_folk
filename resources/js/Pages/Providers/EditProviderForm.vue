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
    provider: {
        type: Object,
        default: () => {},
    },
});
const form = useForm({
    name: props.provider.name,
    phone: props.provider.phone,
    email: props.provider.email,
    address: props.provider.address,
    city_id: props.provider.city_id,
    township_id: props.provider.township_id,
});

	const updateProvider = () => {
		form.put(route(`system_dashboard.providers.update`, props.provider), {
			errorBag: "updateProvider",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="Provider">
		<template #header>
			<FormHeader title="Edit Provider Form" />
		</template>
		<FormSection @submit.prevent="updateProvider">
			<template #title>Edit Provider</template>
			<template #description>
				Create a new team to collaborate with others on
				projects.
			</template>
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
