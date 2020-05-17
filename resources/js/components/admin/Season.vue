<template>
    <div class="container mx-auto">
        <div class="flex flex-wrap">
            <div class="p-2 md:w-1/2">
                <label>Filter by Name:</label>
                <input class="bg-gray-200 focus:outline-none focus:bg-white focus:shadow-md text-gray-700 font-bold rounded-full p-2" v-model="filters.name.value"/>
                <div class="table-responsive">
                    <div v-if="isLoading" class="card-body">
                        <vcl-table></vcl-table>
                    </div>
                    <v-table v-if="!isLoading" class="table sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"
                             :data="seasons"
                             :filters="filters"
                             :hideSortIcons="true"
                             :currentPage.sync="currentPage"
                             :pageSize="12"
                             @totalPagesChanged="totalPages = $event"
                    >
                        <thead class="bg-blue-500 text-white" slot="head">
                        <v-th sortKey="tmdb_id" scope="col" class="p-3 text-left">Tmdb Id</v-th>
                        <v-th sortKey="name" scope="col" class="p-3 text-left">Season Nr</v-th>
                        <th scope="col" class="p-3 text-left">Poster</th>
                        <v-th sortKey="slug" scope="col" class="p-3 text-left">Episodes</v-th>
                        <th scope="col" class="p-3 text-left">Edit</th>
                        <th scope="col" class="p-3 text-left">Delete</th>
                        </thead>
                        <tbody class="flex-1 sm:flex-none" slot="body" slot-scope="{displayData}">
                        <tr class="flex flex-col flex-wrap sm:table-row mb-2 sm:mb-0" v-for="row in displayData" :key="row.tmdb_id">
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.tmdb_id }}</td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.season_number }}</td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><img class="h-16 w-16 rounded-full mx-auto" :src="row.poster_url"> </td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><a :href="row.episode_route">Episodes</a> </td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-blue-300 p-2 rounded-lg" @click="editSeason(row)">Edit</button></td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-red-400 p-2 rounded-lg" @click="deleteSeason(row)">Delete</button></td>
                        </tr>
                        </tbody>
                    </v-table>
                    <smart-pagination
                        :currentPage.sync="currentPage"
                        :totalPages="totalPages"
                    />
                </div>
            </div>
            <div class="p-2 md:w-1/2">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create New season</h3>
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <div class="col-sm-10">
                                <input type="text" class="fshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="season_number" placeholder="Season number">
                            </div>
                            <button @click.prevent="generateseason" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Generate season</button>
                        </form>

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="card-body">
                            <div v-if="errorMessage" class="text-red-500 text-sm mb-4">{{ errorMessage }}</div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Imdb Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="season.tmdb_id" placeholder="Imdb id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Season Nr</label>
                                <div class="col-sm-10">
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="season.season_number" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Season Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="season.name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Poster Path</label>
                                <div class="col-sm-10">
                                    <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " v-model="season.poster_path" placeholder="Poster url">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" v-if="!Edit" @click.prevent="createSeason" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                            <button type="submit" v-else-if="Edit" @click.prevent="updateSeason(season)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VclFacebook, VclTable } from 'vue-content-loading';

    export default {
        name: "Season",
        props:  {
            serie: {
                type: Object,
                required: true
            }
        },
        components: {
            VclFacebook,
            VclTable,
        },
        data() {
            return{
                isLoading: false,
                seasons: [],
                season: {
                    tmdb_id: '',
                    name: '',
                    season_number: '',
                    poster_path: ''
                },
                season_number: '',
                errorMessage: '',
                Edit: false,
                filters: {
                    name: { value: '', keys: ['name'] }
                },
                currentPage: 1,
                totalPages: 0
            }
        },

        async created() {
            await this.getSeasons();
        },
        methods: {
            getSeasons(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.seasons = res.data.data;
                    }).catch(error => {
                    Vue.$toast.error(error)
                })
            },
            createSeason(){
                const _this = this;
                const url = 'https://image.tmdb.org/t/p/w185'+_this.season.poster_path;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons`;
                axios.post(baseUrl, {
                    'tmdb_id': _this.season.tmdb_id,
                    'name' : _this.season.name,
                    'season_number': _this.season.season_number,
                    'poster_path': url
                })
                    .then(res => {
                        _this.getSeasons();
                        Vue.$toast.success(res.data)
                        _this.clear();
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                })
            },
            editSeason(season){
                this.Edit = true;
                this.season = season

            },
            updateSeason(season){
                const _this = this;
                const url = 'https://image.tmdb.org/t/p/w185'+_this.season.poster_path;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons/${season.slug}`;
                axios.post(baseUrl, {
                    'tmdb_id': season.tmdb_id,
                    'name' : season.name,
                    'season_number': season.season_number,
                    'poster_path': url,
                    _method: "PUT"
                })
                    .then(res => {
                        _this.getSeasons();
                        Vue.$toast.success(res.data);
                        _this.clear();
                        _this.Edit = false
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                })

            },
            deleteSeason(season){
                const  _this = this;
                const baseUrl = `/api/admin/admin-series/${this.serie.slug}/admin-seasons/${season.slug}`;
                axios.delete(baseUrl)
                    .then(res => {
                        _this.getSeasons();
                        Vue.$toast.info(res.data)
                    }).catch(error => {
                    console.log(error.response.data.message)
                })
            },
            generateseason(){
                this.Edit = false;
                const _this = this;
                const url = `https://api.themoviedb.org/3/tv/${this.serie.tmdb_id}/season/${this.season_number}?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US`;
                axios.get(url, {withCredentials: false})
                    .then(res => {
                        _this.season.tmdb_id = res.data.id;
                        _this.season.name = res.data.name;
                        _this.season.season_number = res.data.season_number;
                        _this.season.poster_path = res.data.poster_path;

                    }).catch(error => {
                    Vue.$toast.error(error)
                })
            },
            clear(){
                this.season.season_number = '';
                this.season.tmdb_id = '';
                this.season.name = '';
                this.season.poster_path = ''
            }
        }
    }
</script>

<style scoped>

</style>
