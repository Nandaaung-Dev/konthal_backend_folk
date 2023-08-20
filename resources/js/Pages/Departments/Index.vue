<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Table from "@/Components/Table.vue";
import PageHeader from "@/Components/CoreUI/PageHeader.vue";
const props = defineProps({
    departments: {
        type: Object,
        default: () => { },
    },
});
const tableHeaders = ["id", "name", "name_mm", "actions"];
const tableColumns = ["id", "name", "name_mm",];
const relColumn = "";
</script>
<template>
    <AppLayout title="Department">
        <template #header>
            <PageHeader title="Department" btnText="Create Department" />
        </template>
        <div v-if="$page.props.flash.message"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class="font-medium">{{ $page.props.flash.message }}</span>
        </div>
        <Table :list="departments" :headers="tableHeaders" :columns="tableColumns" :relColumn="relColumn"
            :resourceName="$page.props.resource_name" :deletable="$page.props.deletable" />
    </AppLayout>
</template>


