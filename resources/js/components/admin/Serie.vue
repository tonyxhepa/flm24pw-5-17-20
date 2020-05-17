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
                             :data="series"
                             :filters="filters"
                             :hideSortIcons="true"
                             :currentPage.sync="currentPage"
                             :pageSize="12"
                             @totalPagesChanged="totalPages = $event"
                    >
                        <thead class="bg-blue-500 text-white" slot="head">
                        <v-th sortKey="tmdb_id" scope="col" class="p-3 text-left">Tmdb Id</v-th>
                        <v-th sortKey="name" scope="col" class="p-3 text-left">Name</v-th>
                        <th scope="col" class="p-3 text-left">Poster</th>
                        <v-th sortKey="slug" scope="col" class="p-3 text-left">Seasons</v-th>
                        <th scope="col" class="p-3 text-left">Edit</th>
                        <th scope="col" class="p-3 text-left">Delete</th>
                        </thead>
                        <tbody class="flex-1 sm:flex-none" slot="body" slot-scope="{displayData}">
                        <tr class="flex flex-col flex-wrap sm:table-row mb-2 sm:mb-0" v-for="row in displayData" :key="row.tmdb_id">
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.tmdb_id }}</td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.name }}</td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><img class="h-16 w-16 rounded-full mx-auto" :src="row.poster_url"> </td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><a :href="row.seasons_route">Seasons</a> </td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-blue-300 p-2 rounded-lg" @click="editSerie(row)">Edit</button></td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-red-400 p-2 rounded-lg" @click="deleteSerie(row)">Delete</button></td>
                        </tr>
                        </tbody>
                    </v-table>
                    <smart-pagination
                        :currentPage.sync="currentPage"
                        :totalPages="totalPages"
                        maxPageLinks="1"
                        :pageSize="pageSize"
                    />
                </div>
            </div>
            <div class="p-2 md:w-1/2">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create New Serie</h3>
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <div class="col-sm-10">
                                <input type="text" class="fshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="tmdb_id" placeholder="Imdb id">
                            </div>
                            <button @click.prevent="generateSerie" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Generate Serie</button>
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
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="serie.tmdb_id" placeholder="Imdb id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="serie.name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                                <div class="col-sm-10">
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="serie.first_air_date" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Poster Path</label>
                                <div class="col-sm-10">
                                    <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " v-model="serie.poster_path" placeholder="Poster url">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" v-if="!Edit" @click.prevent="createSerie" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                            <button type="submit" v-else-if="Edit" @click.prevent="updateSerie(serie)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
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
        name: "Serie",
        components: {
            VclFacebook,
            VclTable,
        },
        data() {
            return{
                isLoading: false,
                series: [],
                serie: {
                    tmdb_id: '',
                    name: '',
                    first_air_date: '',
                    poster_path: ''
                },
                tmdb_id: '',
                errorMessage: '',
                Edit: false,
                filters: {
                    name: { value: '', keys: ['name'] }
                },
                currentPage: 1,
                totalPages: 0,
                pageSize: 6
            }
        },

        async created() {
            await this.getSeries();
        },
        methods: {
            getSeries(){
                this.isLoading = true;
                const _this = this;
                axios.get('/api/admin/admin-series')
                    .then(res => {
                        _this.isLoading = false;
                        _this.series = res.data.data;

                    }).catch(error => {
                     Vue.$toast.error(error)
                })
            },
            createSerie(){
                const _this = this;
                const url = 'https://image.tmdb.org/t/p/w185'+_this.serie.poster_path;
                axios.post('/api/admin/admin-series', {
                    'tmdb_id': _this.serie.tmdb_id,
                    'name': _this.serie.name,
                    'created_year': _this.serie.first_air_date,
                    'poster_path': url
                })
                    .then(res => {
                        _this.getSeries();
                        Vue.$toast.success(res.data)
                        _this.clear();
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                })
            },
            editSerie(serie){
                this.Edit = true;
                this.serie = serie

            },
            updateSerie(serie){
                const _this = this;
                const url = 'https://image.tmdb.org/t/p/w185'+_this.serie.poster_path;
                axios.post('/api/admin/admin-series/'+ serie.slug, {
                    'tmdb_id': serie.tmdb_id,
                    'name': serie.name,
                    'created_year': serie.first_air_date,
                    'poster_path': url,
                    _method: "PUT"
                })
                    .then(res => {
                        _this.getSeries();
                        Vue.$toast.success(res.data)
                        _this.clear();
                        _this.Edit = false
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                })

            },
            deleteSerie(serie){
                const  _this = this
                axios.delete('/api/admin/admin-series/'+ serie.slug)
                    .then(res => {
                        _this.getSeries();
                        Vue.$toast.info(res.data)
                    }).catch(error => {
                    Vue.$toast.error(error)
                })
            },
            generateSerie(){
                this.Edit = false;
                const _this = this;
                const url = `https://api.themoviedb.org/3/tv/${this.tmdb_id}?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US`;
                axios.get(url, {withCredentials: false})
                    .then(res => {
                        _this.serie.tmdb_id = res.data.id;
                        _this.serie.name = res.data.name;
                        _this.serie.first_air_date = res.data.first_air_date;
                        _this.serie.poster_path = res.data.poster_path;

                    }).catch(error => {
                     Vue.$toast.error(error)
                })
            },
            clear(){
                this.serie.name = '';
                this.serie.tmdb_id = '';
                this.serie.first_air_date = '';
                this.serie.poster_path = ''
            }
        }
    }
</script>

<style scoped>

</style>
