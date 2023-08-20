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
		shop: {
			type: Object,
			default: () => {},
		},
	});
	const form = useForm({
		name: props.shop.name,
		name_mm: props.shop.name_mm,
		phone_number: props.shop.phone_number,
		address: props.shop.address,
		description: props.shop.description,
		shop_type_id: props.shop.shop_type_id,
		owner_id: props.shop.owner_id,
		city_id: props.shop.city_id,
		township_id: props.shop.township_id,
	});

	const updateShop = () => {
		form.put(route(`system_dashboard.shops.update`, props.shop), {
			errorBag: "updateShop",
			preserveScroll: true,
		});
	};
</script>
<template>
	<AppLayout title="Shop">
		<template #header>
			<FormHeader title="Edit Shop Form" />
		</template>
		{{form}}
		<FormSection @submit.prevent="updateShop">
			<template #title>Edit Shop</template>
			<template #description>Edit a new team to collaborate with others on projects.</template>
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="name" value="Name" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name" />
					<InputError :message="form.errors.name" class="mt-2" />
					<InputLabel for="name" value="Name MM" />
					<TextInput id="name" type="text" class="block w-full mt-1" autofocus v-model="form.name_mm" />
					<InputError :message="form.errors.name_mm" class="mt-2" />
					<InputLabel for="phone" value="Phone Number" />
					<TextInput
						id="phone"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.phone_number"
					/>
					<InputError :message="form.errors.phone_number" class="mt-2" />
					<InputLabel for="address" value="Address" />
					<TextInput
						id="address"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.address"
					/>
					<InputError :message="form.errors.address" class="mt-2" />
					<InputLabel for="description" value="Description" />
					<TextInput
						id="description"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.description"
					/>
					<InputError :message="form.errors.description" class="mt-2" />
					<InputLabel for="shop_type_id" value="ShopType" />
					<Selector
						id="shop_type_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.shop_type_id"
						:options="$page.props.shop_types"
					/>
					<InputError :message="form.errors.shop_type_id" class="mt-2" />
					<InputLabel for="owner_id" value="Owner" />
					<Selector
						id="owner_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.owner_id"
						:options="$page.props.owners"
					/>
					<InputError :message="form.errors.owner_id" class="mt-2" />
					<InputLabel for="city_id" value="City" />
					<Selector
						id="city_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.city_id"
						:options="$page.props.cities"
					/>
					<InputError :message="form.errors.city_id" class="mt-2" />
					<InputLabel for="township_id" value="Township" />
					<Selector
						id="township_id"
						type="text"
						class="block w-full mt-1"
						autofocus
						v-model="form.township_id"
						:options="$page.props.townships"
					/>
					<InputError :message="form.errors.township_id" class="mt-2" />
				</div>
			</template>
			<template #actions>
				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>
