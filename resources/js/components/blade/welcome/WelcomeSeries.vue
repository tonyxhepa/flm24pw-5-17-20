<template>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
        <div class="relative" v-for="(serie, i) in series" :key="i">
            <a :href="serie.url">
                    <img
                        class="w-full h-full rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                        v-lazy="serie.poster_url ? serie.poster_url : serie.no_poster"
                        alt="serie poster"
                    >
            </a>
            <div class="absolute right-0 top-0 my-2 mx-1">
                      <span class="py-1 bg-gray-900 text-white rounded text-xs px-1">
                        {{ serie.seasons_count}} sezone
                      </span>
            </div>
            <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 text-lg text-white font-bold rounded-lg"><a :href="serie.url" class="w-full text-sm">{{ serie.name}}</a></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WelcomeSeries",
        props: ['series'],
    }
</script>

<style scoped>
    .bg-movie {
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.65); /* Black see-through */
        width: 100%;
        color: white;
        text-align: center;
    }
</style>
