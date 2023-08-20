<script setup>
	import { Link, useForm } from "@inertiajs/inertia-vue3";
	import Pagination from "@/Components/CoreUI/Pagination.vue";
	const props = defineProps({
		list: {
			type: Object,
			default: () => {},
		},
		headers: {
			type: Array,
			default: () => [],
		},
		columns: {
			type: Array,
			default: () => [],
		},
		deletable: {
			type: Boolean,
			default: true,
		},
		relColumn: {
			type: String,
			default: "",
		},
		resourceName: {
			type: String,
			default: "",
		},
	});
	const form = useForm();
	function destroy(region) {
		if (confirm(`Are you sure you want to Delete Region:  ${region.name}`)) {
			form.delete(
				route(`system_dashboard.${props.resourceName}.destroy`, region)
			);
		}
	}
</script>
<template>
	<div class="flex flex-col w-full">
		<table>
			<thead class="uppercase">
				<tr>
					<th class="p-2 border border-slate-300" v-for="header in headers" :key="header">{{header}}</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="result in list.data" :key="result.indx" class="bg-white">
					<td
						class="p-2 border border-slate-300"
						v-for="column in columns"
						:key="column"
					>{{ typeof(result[column])==='object'?result[column][relColumn]:result[column]}}</td>
					<td class="p-2 border border-slate-300">
						<!-- <Link
							:href="route(`system_dashboard.${$page.url.split('?')[0].replace(/[^a-zA-Z-_]/g,'')}.edit`,result)"
							class="bg-green-200 p-2 rounded-lg mx-2"
							type="button"
							v-if="$page.props.can['edit']"
						>Edit</Link>-->
						<Link
							:href="route(`system_dashboard.${$page.props.resource_name}.edit`,result)"
							class="bg-green-200 p-2 rounded-lg mx-2"
							type="button"
							v-if="$page.props.can['edit']"
						>Edit</Link>
						<Link
							class="bg-green-200 p-2 rounded-lg"
							type="button"
							@click="destroy(result)"
							v-if="deletable && $page.props.can['delete']"
						>Delete</Link>
					</td>
				</tr>
			</tbody>
		</table>
		<Pagination :links="list.links" />
	</div>
</template>
