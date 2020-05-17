<template>
    <section class="container mx-auto">
        <div v-if="showForm" class="container mx-auto ml-8 mb-3">
            <h3 class="w-full md:w-1/3 text-lg">Create New Cast</h3>
            <div class="w-full max-w-sm">
                <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                    <input
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text"
                        v-model="tmdb_id" placeholder="Imdb id"
                       >
                    <button
                        class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                        @click.prevent="generateCast"
                        type="button">
                        Generate Cast
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="w-full max-w-lg mt-4">
                <div v-if="errorMessage" class="text-red-500 text-sm mb-4">{{ errorMessage }}</div>
                <div class="flex flex-wrap mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Imdb Id</label>
                        <input type="text"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name"
                               v-model="cast.tmdb_id"
                               placeholder="Imdb id">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                        <input type="text"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                               v-model="cast.name"
                               placeholder="Name">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Poster Path</label>
                        <input type="url"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                               v-model="cast.poster_path"
                               placeholder="Poster url">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="flex flex-wrap">
                    <button
                        type="submit"
                        v-if="!Edit" @click.prevent="createCast"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded focus:outline-none focus:shadow-outline">
                        Create
                    </button>
                    <button type="submit"
                            v-if="Edit"
                            @click.prevent="updateCast(cast)"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded focus:outline-none focus:shadow-outline">
                        Update
                    </button>
                    <button type="submit"
                            @click="closeForm()"
                            class="bg-red-300 hover:bg-red-600 text-white font-bold py-2 px-4 mx-2 rounded focus:outline-none focus:shadow-outline">
                        Close
                    </button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <div class="container mx-auto ml-8">
            <div class="pt-3">
                <div id="filter" class="flex p-2 bg-blue-200">
                    <input class="flex-1" type="text" v-model="tableData.search" placeholder="Search Table"
                           @input="getCasts()">

                    <div class="flex-1">
                        <div class="p-2">
                            <select v-model="tableData.length" @change="getCasts()">
                                <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-1">
                        <button v-if="!showForm" type="button" class="bg-purple-100 hover:bg-purple-300 rounded-lg p-2 float-right" @click="showForm = !showForm">
                            Show Form
                        </button>
                    </div>
                </div>
                <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                    <tbody class="w-full">
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0"
                        v-for="cast in casts" :key="cast.id">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Tmdb</span>
                            {{cast.tmdb_id}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nmae</span>
                            {{cast.name}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Poster</span>
                            {{cast.poster_path}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Updated</span>
                            {{cast.updated_at}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                            <div class="flex mr-2">
                                <button class="flex-1 p-1 bg-blue-400 hover:bg-blue-600" @click="editCast(cast)">edit</button>
                                <button class="flex-1 p-1 bg-red-400 hover:bg-red-600" @click="deleteCast(cast)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </datatable>
                <pagination :pagination="pagination"
                            @prev="getCasts(pagination.prevPageUrl)"
                            @next="getCasts(pagination.nextPageUrl)">
                </pagination>
            </div>
        </div>
    </section>

</template>

<script>
    import { VclFacebook, VclTable } from 'vue-content-loading';
    import Datatable from "./Datatable";
    import Pagination from "./Pagination";
    export default {
        name: "Cast",
        components: {
            VclFacebook,
            VclTable,
            Datatable,
            Pagination
        },
        data() {
            let sortOrders = {};
            let columns = [
                {width: 'auto', label: 'Tmdb', name: 'tmdb_id', isSortable: true},
                {width: 'auto', label: 'Name', name: 'name',  isSortable: true },
                {width: 'auto', label: 'Poster', name: 'poster_path',  isSortable: true},
                {width: 'auto', label: 'Updated', name: 'updated_at', isSortable: true},
                {width: 'auto', label: 'Actions', name: 'actions', isSortable: false}
            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return{
                isLoading: false,
                showForm: false,
                casts: [],
                cast: {
                    tmdb_id: '',
                    name: '',
                    poster_path: '',
                    updated_at: ''
                },
                poster_url: null,
                tmdb_id: '',
                errorMessage: '',
                Edit: false,
                filters: {
                    name: { value: '', keys: ['name'] }
                },
                currentPage: 1,
                totalPages: 0,

                columns: columns,
                sortKey: 'title',
                isSortable: true,
                sortOrders: sortOrders,
                perPage: ['10', '20', '30'],
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 3,
                    dir: 'desc',
                },
                pagination: {
                    lastPage: '',
                    currentPage: '',
                    total: '',
                    lastPageUrl: '',
                    nextPageUrl: '',
                    prevPageUrl: '',
                    from: '',
                    to: ''
                },
            }
        },

        async created() {
            await this.getCasts();
        },
        methods: {
            getCasts(url =  '/api/admin/admin-casts'){
                this.isLoading = true;
                this.tableData.draw++;
                const _this = this;
                axios.get(url, {params: this.tableData})
                    .then(res => {
                        _this.isLoading = false;
                        let data = res.data;
                        if (this.tableData.draw == data.draw) {
                            this.casts = data.data.data;
                            this.configPagination(data.data.pagination);
                        }

                    }).catch(error => {
                    Vue.$toast.error(error)
                })
            },
            createCast(){
                const _this = this;
                if (!this.cast.poster_path){
                    this.poster_url = null
                }else if (this.cast.poster_path){
                    this.poster_url = 'https://image.tmdb.org/t/p/w185'+_this.cast.poster_path;
                }
                axios.post('/api/admin/admin-casts', {
                    'tmdb_id': _this.cast.tmdb_id,
                    'name': _this.cast.name,
                    'poster_path': _this.poster_url
                })
                    .then(res => {
                        _this.getCasts();
                        _this.clear();
                        Vue.$toast.success(res.data)
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0];
                        _this.errorMessage = error.response.data.errors[key][0];
                    }
                    Vue.$toast.error(error)
                })
            },
            editCast(cast){
                this.Edit = true;
                this.showForm = true;
                this.cast = cast

            },
            updateCast(cast){
                const _this = this;
                if (!this.cast.poster_path){
                    this.poster_url = null
                }else if (this.cast.poster_path){
                    this.poster_url = 'https://image.tmdb.org/t/p/w185'+_this.cast.poster_path;
                }
                axios.post('/api/admin/admin-casts/'+ cast.slug, {
                    'tmdb_id': cast.tmdb_id,
                    'name': cast.name,
                    'poster_path': _this.poster_url,
                    _method: "PUT"
                })
                    .then(res => {
                        _this.getCasts();
                        _this.clear();
                        _this.Edit = false;
                        Vue.$toast.success(res.data)
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0];
                        _this.errorMessage = error.response.data.errors[key][0];
                        Vue.$toast.error(error.response.data.errors[key][0])
                    }
                    Vue.$toast.error(error.response.data.message)
                })

            },
            deleteCast(cast){
                const  _this = this
                axios.delete('/api/admin/admin-casts/'+ cast.slug)
                    .then(res => {
                        _this.getCasts();
                        Vue.$toast.success(res.data)
                    }).catch(error => {
                    Vue.$toast.warning(error)
                })
            },
            generateCast(){
                this.Edit = false;
                const _this = this;
                const url = `https://api.themoviedb.org/3/person/${this.tmdb_id}?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US`;
                axios.get(url, {withCredentials: false})
                    .then(res => {
                        _this.cast.tmdb_id = res.data.id;
                        _this.cast.name = res.data.name;
                        _this.cast.poster_path = res.data.profile_path;

                    }).catch(error => {
                    Vue.$toast.error(error)
                })
            },
            clear(){
                this.cast.name = '';
                this.cast.tmdb_id = '';
                this.cast.poster_path = ''
            },
            configPagination(data) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getCasts();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },
            closeForm(){
                this.showForm = false
                this.cast = {}
            }
        }
    }
</script>

<style scoped>

</style>
