<template>
    <nav class="flex justify-center my-2 p-2 bg-yellow-800">
            <button v-if="pagination.prevPageUrl" class="p-2 bg-blue-200 hover:bg-blue-400 mx-2 font-bold rounded-lg focus:outline-none" @click="$emit('prev')">
                Prev
            </button>
            <a class="button is-small pagination-previous" v-else :disabled="true">
                Prev
            </a>
            <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
            <button type="button" v-if="pagination.nextPageUrl" class="p-2 bg-blue-200 hover:bg-blue-400 mx-2 font-bold rounded-lg focus:outline-none" @click="$emit('next')">
                Next
            </button>
            <a class="" v-else :disabled="true">
                Next
            </a>
    </nav>
</template>

<script>
    export default {
        name: "Pagination",
        props: ['pagination', 'client', 'filtered']
    }
</script>

<style scoped>

</style>
