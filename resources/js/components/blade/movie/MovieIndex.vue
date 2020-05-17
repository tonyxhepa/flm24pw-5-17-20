<template>
    <main>
        <div class="container mx-auto">
            <section>
                <ranking
                    :columns="columns"
                    :sortKey="sortKey"
                    :sortOrders="sortOrders"
                    @sort="sortBy"
                ></ranking>
            </section>
            <section class="p-8 justify-content-center" v-if="isLoading">
                <div class="spinner"></div>
            </section>
            <section
                id="movies"
                class="my-3 px-4 py-2 bg-gray-900 mx-auto rounded-lg"
                v-if="!isLoading"
            >
                <welcome-movies :movies="movies"></welcome-movies>
                <pagination
                    :pagination="pagination"
                    @prev="getMovies(pagination.prevPageUrl)"
                    @next="getMovies(pagination.nextPageUrl)"
                >
                </pagination>
            </section>
        </div>
    </main>
</template>

<script>
import WelcomeMovies from "../welcome/WelcomeMovies";
import Ranking from "../Ranking";
import Pagination from "../../admin/Pagination";
export default {
    name: "MovieIndex",
    components: {
        WelcomeMovies,
        Pagination,
        Ranking
    },
    data() {
        let sortOrders = {};
        let columns = [
            {
                width: "auto",
                label: "Te Fundit",
                name: "updated_at"
            },
            {
                width: "auto",
                label: "Shikime",
                name: "visits"
            },
            {
                width: "auto",
                label: "Formati",
                name: "video_format"
            },
            {
                width: "auto",
                label: "Viti",
                name: "release_date"
            },
            {
                width: "auto",
                label: "IMDB",
                name: "rating"
            }
        ];
        columns.forEach(column => {
            sortOrders[column.name] = -1;
        });
        return {
            isLoading: false,
            movies: [],
            columns: columns,
            sortKey: "title",
            sortOrders: sortOrders,
            perPage: ["10", "20", "30"],
            tableData: {
                draw: 0,
                length: 18,
                column: 0,
                dir: "desc"
            },
            pagination: {
                lastPage: "",
                currentPage: "",
                total: "",
                lastPageUrl: "",
                nextPageUrl: "",
                prevPageUrl: "",
                from: "",
                to: ""
            }
        };
    },
    created() {
        this.getMovies();
    },
    methods: {
        getMovies(baseUrl = `/api/movie-index`) {
            this.isLoading = true;
            const _this = this;
            axios
                .get(baseUrl, { params: this.tableData })
                .then(res => {
                    _this.isLoading = false;
                    let data = res.data;
                    if (this.tableData.draw == data.draw) {
                        this.movies = data.data.data;
                        this.scrollToTop();
                        this.configPagination(data.data.pagination);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
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
        scrollToTop() {
            window.scrollTo(0, 0);
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, "name", key);
            this.tableData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
            this.getMovies();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value);
        }
    }
};
</script>

<style scoped></style>
