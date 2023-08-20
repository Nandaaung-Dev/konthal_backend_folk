<script setup>
	import AppLayout from "../../Layouts/AppLayout.vue";
	import Table from "../../Components/Table.vue";
	import PageHeader from "../../Components/CoreUI/PageHeader.vue";
	const props = defineProps({
		provider_branches: {
			type: Object,
			default:()=>{},
		}
	});
	const tableHeaders = ["id","email", "name","phone", "city", "township","provider","address", "actions"];
	const tableColumns = ["id","email", "name","phone", "city", "township","provider","address"];
	const relColumn = "name";
</script>
<template>
	<AppLayout title="Provider Branch">
		<template #header>
			<PageHeader title="Provider Branch" btnText="Create Provider Branch" />
		</template>
		<div
			v-if="$page.props.flash.message"
			class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
			role="alert"
		>
			<span class="font-medium">{{ $page.props.flash.message}}</span>
		</div>
		<Table
			
			:list="provider_branches"
			:headers="tableHeaders"
			:columns="tableColumns"
			:relColumn="relColumn"
			:resourceName="$page.props.resource_name"
			:deletable="$page.props.deletable"
		/>
	</AppLayout>
</template>