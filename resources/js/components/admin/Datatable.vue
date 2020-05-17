<template>
    <table class="border-collapse w-full">
        <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"
                v-for="column in columns" :key="column.name" @click="column.isSortable ? $emit('sort', column.name) : null"
                :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                :style="'width:'+column.width+';'+'cursor:pointer;'">
                {{column.label}}
            </th>
        </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>
    export default {
        name: "Datatable",
        props: ['columns', 'sortKey', 'sortOrders']
    }
</script>

<style scoped>

</style>
