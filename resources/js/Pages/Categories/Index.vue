<script setup>
	import AppLayout from "@/Layouts/AppLayout.vue";
	import Table from "@/Components/Table.vue";
	import PageHeader from "@/Components/CoreUI/PageHeader.vue";
	const props = defineProps({
		categories: {
			type: Object,
			default: () => {},
		},
	});
	const tableHeaders = ["id", "name", "type" ,"actions"];
	const tableColumns = ["id", "name", "type" ];
	const relColumn = "name";
</script>
<template>
	<AppLayout title="Categories">
		<template #header>
			<PageHeader title="Categories" btnText="Create Category" />
		</template>
		<div
			v-if="$page.props.flash.message"
			class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
			role="alert"
		>
			<span class="font-medium">{{ $page.props.flash.message }}</span>
		</div>
		<Table
			:list="categories"
			:headers="tableHeaders"
			:columns="tableColumns"
			:relColumn="relColumn"
			:resourceName="$page.props.resource_name"
			:deletable="$page.props.deletable"
		/>
	</AppLayout>
</template>

	