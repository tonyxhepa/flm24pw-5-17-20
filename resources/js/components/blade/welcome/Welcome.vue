<template>
    <main>
        <div class="container mx-auto">
            <section class="p-8 justify-content-center" v-if="isLoading">
                <div class="spinner"></div>
            </section>
            <section id="movies" class="my-3 px-4 py-2 bg-gray-900 mx-auto rounded-lg" v-if="!isLoading">
                <div class="flex justify-between rounded-lg my-2 px-2 bg-yellow-700">
                    <h2 class="text-gray-400 text-xl text-center p-2">Filmat e Fundit</h2>
                </div>
                <welcome-movies :movies="movies"></welcome-movies>
            </section>
            <section id="series" class="my-3 px-4 py-2 bg-gray-900 mx-auto rounded-lg" v-if="!isLoading">
                <div class="flex justify-between rounded-lg my-2 px-2 bg-yellow-700">
                    <h2 class="text-gray-400 text-xl text-center p-2">Serialet e Fundit</h2>
                </div>
                <welcome-series :series="series"></welcome-series>
            </section>
            <section id="episodes" class="my-3 px-4 py-2 bg-gray-900 mx-auto rounded-lg" v-if="!isLoading">
                <div class="flex justify-between rounded-lg my-2 px-2 bg-yellow-700">
                    <h2 class="text-gray-400 text-xl text-center p-2">Episodet e Fundit</h2>
                </div>
                <welcome-episodes :episodes="episodes"></welcome-episodes>
            </section>
        </div>
    </main>
</template>

<script>
    import WelcomeEpisodes from "./WelcomeEpisodes";
    import WelcomeMovies from "./WelcomeMovies";
    import WelcomeSeries from "./WelcomeSeries";
    export default {
        name: "Welcome",
        components: {
            WelcomeMovies,
            WelcomeSeries,
            WelcomeEpisodes
        },
        data(){
            return{
                isLoading: false,
                fullPage: true,
                movies: [],
                series: [],
                episodes: []
            }
        },
         created() {
            this.getMovies();
            this.getSeries();
            this.getEpisodes();
        },
        methods: {
            getMovies(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/welcome-movies`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.movies = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            getSeries(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/welcome-series`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.series = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            getEpisodes(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/welcome-episodes`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.episodes = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },

        }
    }
</script>

<style scoped>

</style>
