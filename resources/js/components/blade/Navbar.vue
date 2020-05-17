<template>
    <main>
        <div id="navbar" class="navbar bg-black transition" >
            <div class="container mx-auto flex justify-between">
                <div class="block p-4 lg:text-xl text-yellow-500 hover:text-gray-500 focus:outline-none focus:text-white font-bold">
                    <a class="transition duration-700 ease-in-out" href="/">Bjondja</a>
                </div>
                <div class="px-2 py-2 flex justify-around items-center">
                    <input
                        type="search"
                        v-on-clickaway="awaySearch"
                        v-model="search"
                        v-on:keyup.enter="postSearch"
                        v-on:keyup.delete="stopSearch"
                        class="w-full md:w-96 lg:w-96  bg-gray-700 focus:outline-none focus:bg-white focus:text-gray-900 text-gray-700 rounded-lg transition duration-700 ease-in-out focus:outline-none focus:border-transparent p-2 navbarearance-none leading-normal text-xl"
                        placeholder="Kerko">
                </div>
                <div class="dropdown p-4">
                    <button @click="isOpen = !isOpen" type="button"
                            class="float-right lg:text-xl font-bold mx-4 text-yellow-500 hover:text-red-600 focus:outline-none">
                       <div class="transition duration-700 ease-in-out focus:outline-none" v-if="!isOpen">
                               Menu
                           </div>
                        <div class="transition duration-700 ease-in-out focus:outline-none" v-if="isOpen">
                                Close
                        </div>
                    </button>
                    <div  v-if="isOpen"
                          class="blog dropdown-content mt-10 bg-indigo-800"
                          v-on-clickaway="away"
                    >
                        <transition name="fade" :duration="{ enter: 500, leave: 800 }">
                            <Dropdown :genres="genres" />
                        </transition>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto" v-if="showResults" v-on-clickaway="away">
            <div class="dropdown-content flex justify-around">
                <div class="block w-full md:w-84 lg:w-84 ml-12 mr-8 bg-gray-900 p-2 rounded-lg">
                    <div class="w-full py-4" v-if="isLoading">
                        <div class="spinner"></div>
                    </div>
                    <ul v-if="searchMovies">
                        <li class="flex bg-black hover:bg-gray-700 my-2 rounded-lg" v-for="(movie, i) in searchMovies.slice(0, 6)" :key="i">
                             <a :href="movie.url" class="w-full p-1">
                                 <div class="flex">
                                     <img
                                         class="w-12 h-16 rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                                         v-lazy="movie.poster_url"
                                         alt="movie poster"
                                     >
                                     <div class="ml-3">
                                         <div class="w-full text-gray-200 font-bold"> {{ movie.title.slice(0, 30) }}</div>
                                         <div class="flex justify-between">
                                             <div class="mx-2 text-gray-300">{{ movie.release_date }}</div>
                                             <div class="mx-2 text-gray-300">{{ movie.runtime }} <span class="text-sm">min</span></div>
                                             <div class="mr-3 text-green-700 float-right">Film</div>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                        </li>
                    </ul>
                    <ul v-if="searchSeries">
                        <li class="flex bg-black hover:bg-gray-700 my-2 rounded-lg" v-for="(serie, i) in searchSeries.slice(0, 6)" :key="i">
                            <a class="w-full p-1" :href="serie.url">
                                <div class="flex">
                                    <img
                                        class="w-12 h-16 rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                                        v-lazy="serie.poster_url"
                                        alt="serie poster"
                                    >
                                    <div class="ml-3">
                                        <div class="w-full text-gray-200 font-bold"> {{ serie.title.slice(0, 30) }}</div>
                                        <div class="flex">
                                            <div class="mx-2 text-gray-300">{{ serie.seasons_count }} <span class="text-sm">Sezone</span></div>
                                            <div class="mr-3 text-yellow-700 right-0">Serial</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul v-if="searchCasts">
                        <li class="flex bg-black hover:bg-gray-700 my-2 rounded-lg" v-for="(cast, i) in searchCasts.slice(0, 6)" :key="i">
                            <a class="w-full p-1 " :href="cast.url">
                                <div class="flex">
                                    <img
                                        class="w-12 h-16 rounded-lg hover:opacity-75 transition transition-900  transition-ease-in bg-indigo"
                                        v-lazy="cast.poster_url"
                                        alt="serie poster"
                                    >
                                    <div class="ml-3">
                                        <div class="w-full text-gray-200 font-bold"> {{ cast.title.slice(0, 30) }}</div>
                                        <div class="flex">
                                            <div class="mx-2 text-gray-300">{{ cast.movies }} <span class="text-sm">Filma</span></div>
                                            <div class="mr-3 text-red-700 float-right">Aktor</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a v-on-clickaway="away"
                       v-if="goToSearch"
                        :href="goToSearch"
                        class="float-right p-2 bg-blue-100 hover:bg-blue-300 rounded-lg">Me Shume</a>
                </div>
            </div>
        </div>
    </main>

</template>

<script>
    import { directive as onClickaway } from 'vue-clickaway';
   import Dropdown from './Dropdown'
    export default {
        directives: {
            onClickaway: onClickaway,
        },
        name: "Navbar",
        data(){
            return{
                isOpen: false,
                isLoading: false,
                showResults: false,
                search: null,
                genres: [],
                searchMovies: [],
                searchSeries: [],
                searchCasts: [],
                goToSearch: '',
                startSearch: true
            }
        },
        components: {
            Dropdown
        },
        async created() {
            await this.getGenres();
        },
        watch: {
            search(after, before) {
                if (this.search.length > 3 && this.startSearch){
                    this.getSearch();
                }
                if (this.search.length < 2){
                    this.resetSearch()
                }

            }
        },
        methods: {
            getGenres() {
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/genres`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.genres = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            async getSearch(){
               await this.postSearch()
            },
            postSearch(){
                const _this = this;
                this.showResults = true;
                this.isLoading = true;
                axios.post(`/api/search`, {
                    'search' : this.search
                }).then(res => {
                    _this.isLoading = false;
                    _this.searchMovies = res.data.movies;
                    _this.searchSeries = res.data.series;
                    _this.searchCasts = res.data.casts;
                    _this.goToSearch = res.data.all;
                }).catch(error => {
                    console.log(error)
                })
            },
            stopSearch(){
                this.startSearch = false
            },
            away: function() {
                this.isOpen = false;

            },
            awaySearch: function(){
                this.search = '';
                this.startSearch = true
                this.resetSearch();
            },
            resetSearch(){
                this.showResults = false;
                this.isLoading = false;
                this.startSearch = true
                this.searchSeries = [];
                this.searchMovies = [];
                this.searchCasts = [];
                this.goToSearch = ''
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
