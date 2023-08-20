<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Table from "@/Components/Table.vue";
import PageHeader from "@/Components/CoreUI/PageHeader.vue";
const props = defineProps({
    providers: Array,
});
const tableHeaders = ["id", "name", "phone","email" ,"address","city", "township", "actions"];
const tableColumns = ["id", "name", "phone","email","address" ,"city", "township"];
const relColumn = "name";
</script>
<template>
    <GuestLayout title="Providers">
        {{ $page.props.cities }}
        <template #header>
            <PageHeader title="Providers" btnText="Create Provider" />
        </template>
        <div
            v-if="$page.props.flash.message"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">{{ $page.props.flash.message }}</span>
        </div>
        <Table
            :list="providers"
            :headers="tableHeaders"
            :columns="tableColumns"
            :relColumn="relColumn"
            :resourceName="$page.props.resource_name"
			:deletable="$page.props.deletable"
        />
    </GuestLayout>
</template>
