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
    department: {
        type: Object,
        default: () => { },
    },
});
const form = useForm({
    name: props.department.name,
    name_mm: props.department.name_mm,
});

const updateDepartment = () => {
    form.put(route(`system_dashboard.departments.update`, props.department), {
        errorBag: "updateDepartment",
        preserveScroll: true,
    });
};
</script>
<template>
    <AppLayout title="Department">
        <template #header>
            <FormHeader title="Edit Department Form" />
        </template>
        {{ form }}
        <FormSection @submit.prevent="updateDepartment">
            <template #title>Edit Department</template>
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
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update
                </PrimaryButton>
            </template>
        </FormSection>
    </AppLayout>
</template>
