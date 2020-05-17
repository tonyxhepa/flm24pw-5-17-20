<template>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
        <div class="relative" v-for="(episode, i) in episodes" :key="i">
            <a :href="episode.url">
                    <img
                        class="w-full h-full rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                        v-lazy="episode.poster_url"
                        alt="episode poster"
                    >
            </a>
            <div class="absolute right-0 top-0 my-2 mx-1">
                      <span class="py-1 bg-gray-900 text-white rounded text-xs px-1">
                        Season {{ episode.season_number}}
                      </span>
            </div>

            <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 text-lg text-white font-bold rounded-lg"><a :href="episode.url" class="w-full text-sm">{{ episode.name}}</a></div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "WelcomeEpisodes",
        props: ['episodes'],
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
