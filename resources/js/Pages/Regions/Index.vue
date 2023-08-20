<script setup>
	import AppLayout from "@/Layouts/AppLayout.vue";
	import Table from "@/Components/Table.vue";
	import PageHeader from "@/Components/CoreUI/PageHeader.vue";
	// import Pagination from "@/Components/CoreUI/Pagination.vue";
	const props = defineProps({
		regions: {
			type: Object,
			default: () => {},
		},
	});
	const tableHeaders = ["id", "name", "name_mm", "actions"];
	const tableColumns = ["id", "name", "name_mm"];
	const relColun = "";
</script>
<template>
	<AppLayout title="Regions">
		<template #header>
			<PageHeader title="Regions" btnText="Create Region" />
		</template>
		<div v-if="$page.props.flash.message" class="flash_message" role="alert">
			<span class="font-medium">{{ $page.props.flash.message }}</span>
		</div>
		<Table
			:list="regions"
			:headers="tableHeaders"
			:columns="tableColumns"
			:resourceName="$page.props.resource_name"
			:deletable="$page.props.deletable"
		/>
	</AppLayout>
</template>

	