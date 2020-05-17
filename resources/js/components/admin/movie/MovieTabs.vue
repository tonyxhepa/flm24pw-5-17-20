<template>
    <div class="flex flex-wrap m-2">
        <tabs
            :tabs="tabs"
            :currentTab="currentTab"
            :wrapper-class="'default-tabs'"
            :tab-class="'default-tabs__item'"
            :tab-active-class="'default-tabs__item_active'"
            :line-class="'default-tabs__active-line'"
            @onClick="handleClick"
        />
        <div class="container mx-auto">
            <div v-if="currentTab === 'tab1'">
                <div class="flex flex-wrap m-2">
                    <div v-if="isLoading" class="card-body">
                        <vcl-table></vcl-table>
                    </div>
                    <button
                        v-if="!isLoading"
                        v-for="embed in embedUrls"
                        :key="embed.web_name"
                        @click="deleteEmbed(embed.id)"
                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md mx-2 py-2 px-6 inline-flex items-center">
                        <span class="mr-2">{{ embed.web_name}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentcolor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                        </svg>
                    </button>
                </div>
                <form class="w-full max-w-lg" @keyup.enter="createEmbedUrl">
                    <div v-if="errorEmbedMessage" class="text-red-500 text-sm mb-4">{{ errorEmbedMessage }}</div>
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                type="text"
                                v-model="embedUrl.web_name"
                                placeholder="Web Name">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Url
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                   type="url"
                                   v-model="embedUrl.web_url"
                                   placeholder="Web Url">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Type
                            </label>
                            <div class="relative">
                                <select v-model="embedUrl.type"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                    <option v-for="option in options" v-bind:value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <button @click.prevent="createEmbedUrl" class="block bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white p-2 m-2 rounded" type="button">
                            Add Embed
                        </button>
                    </div>
                </form>
            </div>
            <div v-if="currentTab === 'tab2'">
                <div class="flex flex-wrap m-2">
                    <div v-if="isLoading" class="card-body">
                        <vcl-table></vcl-table>
                    </div>
                    <button
                        v-if="!isLoading"
                        v-for="watch in watchUrls"
                        :key="watch.id"
                        @click="deleteWatch(watch.id)"
                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md mx-2 py-2 px-6 inline-flex items-center">
                        <span class="mr-2">{{ watch.web_name}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentcolor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                        </svg>
                    </button>
                </div>
                <form class="w-full max-w-lg" @keyup.enter="createWatchUrl" >
                    <div v-if="errorWatchMessage" class="text-red-500 text-sm mb-4">{{ errorWatchMessage }}</div>
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                type="text"
                                v-model="watchUrl.web_name"
                                placeholder="Web Name">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Url
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                   type="url"
                                   v-model="watchUrl.web_url"
                                   placeholder="Web Url">
                        </div>
                        <button @click.prevent="createWatchUrl"class="block bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white p-2 m-2 rounded" type="button">
                            Add Watch
                        </button>
                    </div>
                </form>
            </div>
            <div v-if="currentTab === 'tab3'">
                <div class="flex flex-wrap m-2">
                    <div v-if="isLoading" class="card-body">
                        <vcl-table></vcl-table>
                    </div>
                    <button
                        v-if="!isLoading"
                        v-for="download in downloadUrls"
                        :key="download.id"
                        @click="deleteDownload(download.id)"
                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md mx-2 py-2 px-6 inline-flex items-center">
                        <span class="mr-2">{{ download.web_name}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentcolor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                        </svg>
                    </button>
                </div>
                <form class="w-full max-w-lg" @keyup.enter="createDownloadUrl">
                    <div v-if="errorDownloadMessage" class="text-red-500 text-sm mb-4">{{ errorDownloadMessage }}</div>
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                type="text"
                                v-model="downloadUrl.web_name"
                                placeholder="Web Name">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Url
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                   type="url"
                                   v-model="downloadUrl.web_url"
                                   placeholder="Web Url">
                        </div>
                        <button @click.prevent="createDownloadUrl" class="block bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white p-2 m-2 rounded" type="button">
                            Add Download
                        </button>
                    </div>
                </form>
            </div>
            <div v-if="currentTab === 'tab4'">
                <div class="flex flex-wrap m-2">
                    <div v-if="isLoading" class="card-body">
                        <vcl-table></vcl-table>
                    </div>
                    <button
                        v-if="!isLoading"
                        v-for="trailer in trailerUrls"
                        :key="trailer.id"
                        @click="deleteTrailer(trailer.id)"
                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md mx-2 py-2 px-6 inline-flex items-center">
                        <span class="mr-2">{{ trailer.web_name}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentcolor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                        </svg>
                    </button>
                </div>
                <form class="w-full max-w-lg" @keyup.enter="createTrailerUrl">
                    <div v-if="errorTrailerMessage" class="text-red-500 text-sm mb-4">{{ errorTrailerMessage }}</div>
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                type="text"
                                v-model="trailerUrl.web_name"
                                placeholder="Web Name">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Url
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                   type="url"
                                   v-model="trailerUrl.web_url"
                                   placeholder="Web Url">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Type
                            </label>
                            <div class="relative">
                                <select v-model="trailerUrl.type"
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                    <option v-for="option in options" v-bind:value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <button @click.prevent="createTrailerUrl" class="block bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white p-2 m-2 rounded" type="button">
                            Add Download
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { VclFacebook, VclTable } from 'vue-content-loading';
    import Tabs from 'vue-tabs-with-active-line';
    const TABS = [{
        title: 'Embed links',
        value: 'tab1',
    }, {
        title: 'Watch Links',
        value: 'tab2',
    }, {
        title: 'Dwonload Links',
        value: 'tab3',
    }, {
        title: 'Trailer Links',
        value: 'tab4',
    }];
    export default {
        props: {
            movie: {
                type: Object
            }
        },
        components: {
            Tabs,
            VclFacebook,
            VclTable
        },
        data: () => ({
            tabs: TABS,
            currentTab: 'tab1',
            isLoading: false,
            watchUrls: [],
            watchUrl: {
                web_name: '',
                web_url: ''
            },
            embedUrls: [],
            embedUrl: {
                web_name: '',
                web_url: '',
                type: 1
            },
            downloadUrls: [],
            downloadUrl: {
                web_name: '',
                web_url: ''
            },
            trailerUrls: [],
            trailerUrl: {
                web_name: '',
                web_url: '',
                type: 1
            },
            errorEmbedMessage: '',
            errorWatchMessage: '',
            errorDownloadMessage: '',
            errorTrailerMessage: '',
            options: [
                { text: 'Iframe', value: 1 },
                { text: 'Url', value: 2 }
            ]
        }),
        async created() {
            await this.getWatchUrl();
            await this.getembedUrl();
            await this.getDownloadUrl();
            await this.getTrailerUrl();
        },
        methods: {
            handleClick(newTab) {
                this.currentTab = newTab;
            },
            getWatchUrl(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/watchUrl`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.watchUrls = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            getDownloadUrl(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/downloadUrl`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.downloadUrls = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            getembedUrl(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/embedUrl`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.embedUrls = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            createEmbedUrl(){
                this.isLoading = true;
                const _this = this;
                const data = {
                    web_name: this.embedUrl.web_name,
                    web_url: this.embedUrl.web_url
                };
               if (this.embedUrl.type === 1){
                   const parser = new DOMParser();
                   let parsedIframe = parser.parseFromString(this.embedUrl.web_url, "text/html");
                   let iFrame = parsedIframe.getElementsByTagName("iframe");
                   let src = iFrame[0].src;
                   console.log(src);
                   data.web_url = src
               }
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/addEmbedUrl`;
                axios.post(baseUrl, data)
                    .then(res => {
                        this.isLoading = false;
                        _this.getembedUrl();
                        _this.clearEmbed();
                        Vue.$toast.success(res.data)
                    }).catch(errorE => {
                    if (errorE.response.status == 422){
                        const key = Object.keys(errorE.response.data.errors)[0]
                        _this.errorEmbedMessage = errorE.response.data.errors[key][0]
                    }
                    Vue.$toast.error(errorE)
                })
            },
            deleteEmbed(id){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-embed/${id}`;
                axios.delete(baseUrl)
                    .then(res => {
                        this.isLoading = false;
                        _this.getembedUrl();
                        Vue.$toast.warning(res.data)
                    }).catch(errorE => {
                    Vue.$toast.error(errorE)
                })
            },
            clearEmbed(){
                this.embedUrl.web_name = '',
                    this.embedUrl.web_url = ''
            },
            createWatchUrl(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/addWatchUrl`;
                axios.post(baseUrl, {
                    'web_name': _this.watchUrl.web_name,
                    'web_url': _this.watchUrl.web_url
                })
                    .then(res => {
                        this.isLoading = false;
                        _this.getWatchUrl();
                        _this.clearWatch();
                        Vue.$toast.success(res.data)
                    }).catch(errorW => {
                    if (errorW.response.status == 422){
                        const key = Object.keys(errorW.response.data.errors)[0]
                        _this.errorWatchMessage = errorW.response.data.errors[key][0]
                    }
                    Vue.$toast.error(errorW)
                })
            },
            deleteWatch(id){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-watchUrl/${id}`;
                axios.delete(baseUrl)
                    .then(res => {
                        this.isLoading = false;
                        _this.getWatchUrl();
                        Vue.$toast.warning(res.data)
                    }).catch(errorW => {
                    console.log(errorW)
                })
            },
            clearWatch(){
                this.watchUrl.web_name = '',
                    this.watchUrl.web_url = ''
            },
            createDownloadUrl(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/addDownloadUrl`;
                axios.post(baseUrl, {
                    'web_name': _this.downloadUrl.web_name,
                    'web_url': _this.downloadUrl.web_url
                })
                    .then(res => {
                        this.isLoading = false;
                        _this.getDownloadUrl();
                        _this.clearDownload();
                        Vue.$toast.success(res.data)
                    }).catch(errorD => {
                    if (errorD.response.status == 422){
                        const key = Object.keys(errorD.response.data.errors)[0]
                        _this.errorDownloadMessage = errorD.response.data.errors[key][0]
                    }
                    Vue.$toast.error(errorD)
                })
            },
            deleteDownload(id){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-download/${id}`;
                axios.delete(baseUrl)
                    .then(res => {
                        this.isLoading = false;
                        _this.getDownloadUrl();
                        Vue.$toast.warning(res.data)
                    }).catch(errorD => {
                    Vue.$toast.error(errorD)
                })
            },
            clearDownload(){
                this.downloadUrl.web_name = '',
                    this.downloadUrl.web_url = ''
            },
            getTrailerUrl(){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/trailerUrl`;
                axios.get(baseUrl)
                    .then(res => {
                        _this.isLoading = false;
                        _this.trailerUrls = res.data.data;
                    }).catch(error => {
                    console.log(error)
                })
            },
            createTrailerUrl(){
                this.isLoading = true;
                const data = {
                    web_name: this.trailerUrl.web_name,
                    web_url: this.trailerUrl.web_url
                };
                if (this.trailerUrl.type === 1){
                    const parser = new DOMParser();
                    let parsedIframe = parser.parseFromString(this.trailerUrl.web_url, "text/html");
                    let iFrame = parsedIframe.getElementsByTagName("iframe");
                    let src = iFrame[0].src;
                    console.log(src);
                    data.web_url = src
                }
                const _this = this;
                const baseUrl = `/api/admin/admin-movies/${this.movie.slug}/addTrailerUrl`;
                axios.post(baseUrl, data)
                    .then(res => {
                        this.isLoading = false;
                        _this.getTrailerUrl();
                        _this.clearTrailer();
                        Vue.$toast.success(res.data)
                    }).catch(errorE => {
                    if (errorE.response.status == 422){
                        const key = Object.keys(errorE.response.data.errors)[0]
                        _this.errorTrailerMessage = errorE.response.data.errors[key][0]
                    }
                    Vue.$toast.error(errorE)
                })
            },
            deleteTrailer(id){
                this.isLoading = true;
                const _this = this;
                const baseUrl = `/api/admin/admin-trailer/${id}`;
                axios.delete(baseUrl)
                    .then(res => {
                        this.isLoading = false;
                        _this.getTrailerUrl();
                        Vue.$toast.warning(res.data)
                    }).catch(error => {
                    Vue.$toast.error(error)
                })
            },
            clearTrailer(){
                this.trailerUrl.web_name = '',
                    this.trailerUrl.web_url = ''
            },
        },
    }
</script>

<style lang="scss">
    .default-tabs {
        position: relative;
        margin: 0 auto;
        &__item {
            display: inline-block;
            margin: 0 5px;
            padding: 10px;
            padding-bottom: 8px;
            font-size: 16px;
            letter-spacing: 0.8px;
            color: gray;
            text-decoration: none;
            border: none;
            background-color: transparent;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.25s;
            &_active {
                color: black;
            }
            &:hover {
                border-bottom: 2px solid gray;
                color: black;
            }
            &:focus {
                outline: none;
                border-bottom: 2px solid gray;
                color: black;
            }
            &:first-child {
                margin-left: 0;
            }
            &:last-child {
                margin-right: 0;
            }
        }
        &__active-line {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            background-color: black;
            transition: transform 0.4s ease, width 0.4s ease;
        }
    }
    .content {
        margin-top: 30px;
        font-size: 20px;
    }
</style>
