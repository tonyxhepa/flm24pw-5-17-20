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
                             :data="tags"
                             :filters="filters"
                             :hideSortIcons="true"
                             :currentPage.sync="currentPage"
                             :pageSize="12"
                             @totalPagesChanged="totalPages = $event"
                    >
                        <thead class="bg-blue-500 text-white" slot="head">
                        <v-th sortKey="name" scope="col" class="p-3 text-left">Name</v-th>
                        <v-th sortKey="slug" scope="col" class="p-3 text-left">Slug</v-th>
                        <th scope="col" class="p-3 text-left">Edit</th>
                        <th scope="col" class="p-3 text-left">Delete</th>
                        </thead>
                        <tbody class="flex-1 sm:flex-none" slot="body" slot-scope="{displayData}">
                        <tr class="flex flex-col flex-wrap sm:table-row mb-2 sm:mb-0" v-for="row in displayData" :key="row.slug">
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.name }}</td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3">{{ row.slug }}</td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-blue-300 p-2 rounded-lg" @click="editTag(row)">Edit</button></td>
                            <td scope="row" class="border-grey-light border hover:bg-gray-100 p-3"><button class="bg-red-400 p-2 rounded-lg" @click="deleteTag(row)">Delete</button></td>
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
                        <h3 class="card-title">Create New Tag</h3>

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="card-body">
                            <div v-if="errorMessage" class="text-red-500 text-sm mb-4">{{ errorMessage }}</div>
                            <div class="form-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="tag.name" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" v-if="!Edit" @click.prevent="createTag" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                            <button type="submit" v-else-if="Edit" @click.prevent="updateTag(tag)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
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
        name: "Tag",
        components: {
            VclFacebook,
            VclTable,
        },
        data() {
            return{
                isLoading: false,
                tags: [],
                tag: {
                    name: ''
                },
                tmdb_id: '',
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
            await this.getTags();
        },
        methods: {
            getTags(){
                this.isLoading = true;
                const _this = this;
                axios.get('/api/admin/admin-tags')
                    .then(res => {
                        _this.isLoading = false;
                        _this.tags = res.data.data;

                    }).catch(error => {
                    console.log(error)
                })
            },
            createTag(){
                const _this = this;
                axios.post('/api/admin/admin-tags', {
                    'tag_name': _this.tag.name,
                })
                    .then(res => {
                        _this.getTags();
                        _this.clear();
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                })
            },
            editTag(tag){
                this.Edit = true;
                this.tag = tag

            },
            updateTag(tag){
                const _this = this;
                axios.post('/api/admin/admin-tags/'+ tag.slug, {
                    'tag_name': tag.name,
                    _method: "PUT"
                })
                    .then(res => {
                        _this.getTags();
                        _this.clear();
                        _this.Edit = false
                    }).catch(error => {
                    if (error.response.status == 422){
                        const key = Object.keys(error.response.data.errors)[0]
                        _this.errorMessage = error.response.data.errors[key][0]
                    }
                })

            },
            deleteTag(tag){
                const  _this = this
                axios.delete('/api/admin/admin-tags/'+ tag.slug)
                    .then(res => {
                        _this.getTags();
                        console.log(res)
                    }).catch(error => {
                    console.log(error.response.data.message)
                })
            },
            clear(){
                this.tag.name = '';
            }
        }
    }
</script>

<style scoped>

</style>
