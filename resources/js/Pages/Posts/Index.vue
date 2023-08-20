
<template>
	<AppLayout title="Post">
		<template #header>
			<PageHeader title="Posts" btnText="Create Post" />
		</template>

		<Table
			:list="posts"
			:createButton="createButton"
			:headers="thableHeaders"
			:columns="tableColumns"
		/>
	</AppLayout>
</template>
<script>
	import AppLayout from "@/Layouts/AppLayout.vue";
	import Table from "@/Components/Table.vue";
	import PageHeader from "@/Components/CoreUI/PageHeader.vue";
	export default {
		components: {
			AppLayout,
			Table,
			PageHeader,
		},
		props: {
			posts: {
				type: Array,
				default: () => [],
			},
		},
		data: () => ({
			createButton: "Create Post",
			thableHeaders: ["pot id", "post title", "post content"],
			tableColumns: ["id", "title", "content"],
		}),
	};
</script>
