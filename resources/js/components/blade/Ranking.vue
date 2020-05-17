<template>
    <div class="container mx-auto bg-yellow-600 rounded-lg mt-3">
        <div class="flex flex-wrap justify-around">
            <div
                class="p-2 text-gray-900 font-bold hover:text-gray-300 rounded-lg hover:bg-gray-700 ranging_sort"
                v-for="column in columns"
                :key="column.name"
                @click="$emit('sort', column.name)"
                :class="sortKey === column.name ? 'bg-yellow-900' : ''"
                :style="'width:' + column.width + ';' + 'cursor:pointer;'"
            >
                {{ column.label }}<i class="ml-2"  :class="
                    sortKey === column.name
                        ? sortOrders[column.name] > 0
                            ? 'ranging_sort_bottom'
                            : 'ranging_sort_top'
                        : 'bg-yellow-900'
                "></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Ranking",
    props: ["columns", "sortKey", "sortOrders"]
};
</script>

<style scoped>
    .ranging_sort_top {
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
        transform: rotate(-135deg);
        -webkit-transform: rotate(-135deg);
    }
    .ranging_sort_bottom {
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }

</style>
