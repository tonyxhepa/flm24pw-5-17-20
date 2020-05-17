<template>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
        <div class="relative" v-for="(cast, i) in casts" :key="i">
            <a :href="cast.url">
                <div v-lazy-container="{ selector: 'img', error: '/img/loader.jpg', loading: '/img/loader.jpg' }">
                    <img
                        class="w-full h-full rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                        :data-src="cast.poster_url ? cast.poster_url : cast.no_poster"
                        alt="cast poster"
                    >
                </div>
            </a>
            <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 text-lg text-white font-bold rounded-lg"><a :href="cast.url" class="w-full text-sm">{{ cast.name}}</a></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WelcomeSeries",
        props: ['casts'],
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
