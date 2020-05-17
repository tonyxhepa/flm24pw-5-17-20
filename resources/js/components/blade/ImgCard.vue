<template>
    <img
        class="w-full h-full rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
        v-lazy="img"
        alt="movie poster"
    >
</template>

<script>
    export default {
        name: "ImgCard",
        props: ['img']
    }
</script>

<style scoped>

</style>
