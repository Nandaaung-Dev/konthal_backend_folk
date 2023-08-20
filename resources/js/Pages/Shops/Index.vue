<script setup>
	import AppLayout from "@/Layouts/AppLayout.vue";
	import Table from "@/Components/Table.vue";
	import PageHeader from "@/Components/CoreUI/PageHeader.vue";
	const props = defineProps({
		shops: {
			type:Object,
			default:()=>{}
		
		},
	});
	const tableHeaders = ["id", "name", "name_mm","phone_number","address","description","shop_type","owner","city","township" ,"actions"];
	const tableColumns = ["id", "name", "name_mm","phone_number","address","description","shop_type","owner","city","township" ];
	const relColumn = "name";
</script>
<template>
	<AppLayout title="Shops">
		<template #header>
			<PageHeader title="Shops" btnText="Create Shop" />
		</template>
        {{$page.props.can}}

		<div v-if="$page.props.flash.message" class="flash_message" role="alert">
			<span class="font-medium">{{ $page.props.flash.message }}</span>
		</div>
		<Table :list="shops" 
		:headers="tableHeaders" 
		:columns="tableColumns" 
		:relColumn="relColumn"
		:resourceName="$page.props.resource_name"
		:deletable="$page.props.deletable"
		 />
	</AppLayout>
</template>

	
