<template>
    <div class="container mx-auto">
        <div class="flex">
            <button v-if="!showForm" type="button" class="bg-purple-300 rounded-full m-2 p-2" @click="showFormM">
                Show Form
            </button>
        </div>
        <div v-if="showForm" class="flex flex-wrap bg-white rounded-lg">
            <!-- Horizontal Form -->
            <div class="w-full" v-if="!Edit">
                <h3 class="m-2 p-2 font-bold">Create New episode</h3>
                <form class="p-2 m-2 mb-4">
                    <div class="px-3 py-2">
                        <input type="text" class="fshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="episode_number" placeholder="Episode number">
                    </div>
                    <button @click.prevent="generateEpisode" class="bg-blue-500 hover:bg-blue-700 text-white font-bold m-2 py-2 px-6 rounded focus:outline-none focus:shadow-outline">Generate episode</button>
                </form>
            </div>
            <div v-if="Edit" class="flex flex-wrap">
                <episode-tabs :episode="episode"></episode-tabs>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="card-body">
                    <div v-if="errorMessage" class="text-red-500 text-sm mb-4">{{ errorMessage }}</div>
                    <div class="form-group">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Imdb Id</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"

                                v-model="episode.tmdb_id"
                                placeholder="Imdb id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Episode Nr</label>
                        <div class="col-sm-10">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="episode.episode_number" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " v-model="episode.name" placeholder="Poster url">
                        </div>
                    </div>
                    <div class="md:flex mb-6 py-2 my-2">
                        <label class="md:w-2/3 block text-gray-500 font-bold">
                            <input class="mr-2 leading-tight" v-model="episode.is_public" type="checkbox">
                            <span class="text-sm">
                                  Is Public
                                   </span>
                        </label>
                    </div>
                    <div class="pt-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Overview</label>
                        <div class="w-full">
                            <textarea v-model="episode.overview" rows="5" cols="70" placeholder="overview"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" v-if="!Edit" @click.prevent="createEpisode" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                    <button type="submit" v-else-if="Edit" @click.prevent="updateEpisode(episode)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                    <button type="submit" v-if="showForm" @click="closeForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Close</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <div class="flex flex-wrap" v-if="showTable">
            <div class="table-responsive">
                <div v-if="isLoading" class="card-body">
                    <vcl-table></vcl-table>
                </div>
                <div class="bg-white shadow-md rounded p-2">
                    <label class="text-xl font-bold p-2">Filter by E Nr:</label>
                    <input class="bg-gray-200 focus:outline-none focus:bg-white focus:shadow-md text-gray-700 font-bold rounded-full p-2" v-model="filters.name.value"/>
                </div>
                <v-table v-if="!isLoading" class="table sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                         :data="episodes"
                         :filters="filters"
                         :hideSortIcons="true"
                         :currentPage.sync="currentPage"
                         :pageSize="12"
                         @totalPagesChanged="totalPages = $event"
                >
                    <thead class="bg-blue-500 text-white" slot="head">
                    <v-th sortKey="tmdb_id" scope="col" class="p-3 text-left">Tmdb Id</v-th>
                    <v-th sortKey="episode_number" scope="col" class="p-3 text-left">E Nr</v-th>
                    <v-th sortKey="name" scope="col" class="p-3 text-left">Name</v-th>
                    <v-th sortKey="visits" scope="col" class="p-3 text-left">Visits</v-th>
                    <v-th sortKey="is_public" scope="col" class="p-3 text-left">Public</v-th>
                    <th scope="col" class="p-3 text-left">Edit</th>
                    <th scope="col" class="p-3 text-left">Delete</th>
                    </thead>
                    <tbody class="flex-1 sm:flex-none" slot="body" slot-scope="{displayData}">
                    <tr class="flex flex-col flex-wrap sm:table-row mb-2 sm:mb-0" v-for="row in displayData" :key="row.tmdb_id">
                        <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.tmdb_id }}</td>
                        <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.episode_number }}</td>
                        <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.name }} </td>
                        <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.visits }} </td>
                        <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.is_public }} </td>
                        <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-blue-300 p-2 rounded-lg" @click="editEpisode(row)">Edit</button></td>
                        <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-red-400 p-2 rounded-lg" @click="deleteEpisode(row)">Delete</button></td>
                    </tr>
                    </tbody>
                </v-table>
                <smart-pagination
                    :currentPage.sync="currentPage"
                    :totalPages="totalPages"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import { VclFacebook, VclTable } from 'vue-content-loading';
    import EpisodeTabs from "./EpisodeTabs";
    export default {
        name: "Episode",
        props:  {
            serie: {
                type: Object,
                required: true
            },
            season: {
                type: Object,
                required: true
            }
        },

        components: {
            VclFacebook,
            VclTable,
            EpisodeTabs
        },
        data() {
            return{
                isLoading: false,
                episodes: [],
                episode: {
                    tmdb_id: '',
                    is_public: false,
                    episode_number: '',
                    name: '',
                    overview: ''
                },
                episode_number: '',
                errorMessage: '',
                Edit: false,
                showForm: false,
                showTable: true,
                filters: {
                    episode_number: { value: '', keys: ['episode_number'] },
                    name: { value: '', keys: ['name'] },
                    visits: { value: '', keys: ['visits'] },
                    is_public: { value: '', keys: ['is_public'] }
                },
                currentPage: 1,
                totalPages: 0
            }
        },

        async created() {
            await this.getEpisodes();
        },
        methods: {
            getEpisodes(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons/${this.season.slug}/admin-episodes`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.episodes = res.data.data;
                    }).catch(error => {
                     Vue.$toast.error(error)
                })
            },
            createEpisode(){
                this.showForm = false;
                this.showTable = true;
                const _this = this;
                const url = 'https://image.tmdb.org/t/p/w185'+_this.episode.poster_path;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons/${this.season.slug}/admin-episodes`;
                axios.post(baseUrl, {
                    'tmdb_id': _this.episode.tmdb_id,
                    'episode_number': _this.episode.episode_number,
                    'name': _this.episode.name,
                    'overview': _this.episode.overview,
                })
                    .then(res => {
                        _this.getEpisodes();
                        Vue.$toast.success(res.data);
                        _this.clear();
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                })
            },
            editEpisode(episode){
                this.showForm = true;
                this.showTable = false;
                this.Edit = true;
                this.episode = episode
            },
            updateEpisode(episode){
                this.showForm = false;
                this.showTable = true;
                const _this = this;
                const url = 'https://image.tmdb.org/t/p/original'+_this.episode.poster_path;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons/${this.season.slug}/admin-episodes/${episode.slug}`;
                axios.post(baseUrl, {
                    'tmdb_id': episode.tmdb_id,
                    'episode_number': episode.episode_number,
                    'name': episode.name,
                    'is_public': episode.is_public,
                    'overview': episode.overview,
                    _method: "PUT"
                })
                    .then(res => {
                        _this.getEpisodes();
                        Vue.$toast.success(res.data);
                        _this.clear();
                        _this.Edit = false
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                    Vue.$toast.error(error)
                })

            },
            deleteEpisode(episode){
                const  _this = this;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons/${this.season.slug}/admin-episodes/${episode.slug}`;
                axios.delete(baseUrl)
                    .then(res => {
                        _this.getEpisodes();
                        Vue.$toast.success(res.data)
                    }).catch(error => {
                    Vue.$toast.error(error)
                })
            },
            generateEpisode(){
                this.Edit = false;
                const _this = this;
                const url = `https://api.themoviedb.org/3/tv/${this.serie.tmdb_id}/season/${this.season.season_number}/episode/${this.episode_number}?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US`;
                axios.get(url, {withCredentials: false})
                    .then(res => {
                        _this.episode.tmdb_id = res.data.id;
                        _this.episode.name = res.data.name;
                        _this.episode.episode_number = res.data.episode_number;
                        _this.episode.overview = res.data.overview;

                    }).catch(error => {
                     Vue.$toast.error(error)
                })
            },
            clear(){
                this.episode.episode_number = '';
                this.episode.tmdb_id = '';
                this.episode.name = '';
                this.episode.overview = '';
            },
            closeForm(){
                this.showForm = false;
                this.showTable = true;
                this.Edit = false;
            },
            showFormM(){
                this.showForm = true;
                this.showTable = false;
                this.Edit = false;
            }
        }
    }
</script>

<style scoped>
    .textred {
        color: red;
    }

</style>
