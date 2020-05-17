<template>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
        <div class="relative" v-for="(season, i) in seasons" :key="i">
            <a :href="season.url">
                    <img
                        class="w-full h-full rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                        v-lazy="season.poster_url ? season.poster_url : season.no_poster"
                        alt="season poster"
                    >
            </a>
            <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 text-lg text-white font-bold rounded-lg"><a :href="season.url" class="w-full text-sm">{{ season.name}}</a></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WelcomeSeries",
        props: ['seasons'],
    }
</script>

<style scoped>

</.bg-movie {
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.65); /* Black see-through */
    width: 100%;
    color: white;
    text-align: center;
}style>
