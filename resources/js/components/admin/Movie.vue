<template>
  <div class="container mx-auto ml-10">
    <section v-if="showForm" class="flex flex-wrap bg-white rounded-lg">
      <!-- Horizontal Form -->
      <h3 class="m-2 p-2 font-bold">Create New Movie</h3>
      <div class="w-full max-w-sm">
        <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
          <input
            type="text"
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            v-model="tmdb_id"
            placeholder="Movie number"
          />
          <button
            @click.prevent="generateMovie"
            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
          >Generate movie</button>
          <button
            @click.prevent="generateCasts"
            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
          >Generate Casts</button>
        </div>
      </div>
      <div v-if="Edit" class="flex flex-wrap">
        <movie-tabs :movie="movie"></movie-tabs>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form class="w-full">
        <div v-if="errorMessage" class="text-red-500 text-sm mb-4">{{ errorMessage }}</div>
        <div class="flex flex-wrap mx-3">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Imdb Id</label>
            <input
              type="text"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.tmdb_id"
              placeholder="Imdb id"
            />
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Title</label>
            <input
              type="text"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.title"
              placeholder="Name"
            />
          </div>
        </div>
        <div class="flex flex-wrap mx-3">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Release Date</label>
            <input
              type="date"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.release_date"
              placeholder="Name"
            />
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Runtime</label>
            <input
              type="number"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.runtime"
              placeholder="Name"
            />
          </div>
        </div>
        <div class="flex flex-wrap mx-3">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Language</label>
            <input
              type="text"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.lang"
              placeholder="Name"
            />
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Vieo Format</label>
            <input
              type="text"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.video_format"
              placeholder="Name"
            />
          </div>
        </div>
        <div class="flex flex-wrap mx-3">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Rating</label>
            <input
              type="number"
              step="any"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.rating"
              placeholder="Name"
            />
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Poster Path</label>
            <input
              type="text"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              v-model="movie.poster_path"
              placeholder="Name"
            /></div>
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label
                      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  >Backdrop Path</label>
                  <input
                      type="text"
                      class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                      v-model="movie.backdrop_path"
                      placeholder="Name"
                  />
          </div>
        </div>

        <div class="flex flex-wrap mx-3">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
              <div class="flex">Genres</div>
            </label>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
              <div class="flex">
                <button
                  type="button"
                  class="p-1 m-1"
                  v-for="img in imdbGenres"
                  :key="img.id"
                >{{ img.name}}</button>
              </div>
            </label>
            <multiselect
              v-model="movie.genres"
              :options="genres"
              :multiple="true"
              :close-on-select="false"
              :clear-on-select="false"
              :preserve-search="true"
              placeholder="Pick some"
              label="name"
              track-by="name"
              :preselect-first="true"
            ></multiselect>
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
              <div class="flex">Casts</div>
            </label>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
              <div class="flex flex-wrap">
                <button
                  type="button"
                  class="p-1 m-1 border border-gray-200 rounded-lg hover:bg-blue-400"
                  v-for="(imc, i) in imdbCast"
                  :key="i"
                  @click.prevent="createCast(imc)"
                >
                  <span>{{ imc.id}}</span>
                  {{ imc.name}}
                  <span
                    v-if="imc.profile_path"
                    class="p-1 bg-blue-500"
                  >OK</span>
                </button>
              </div>
            </label>
            <multiselect
              v-model="movie.casts"
              :options="casts"
              :multiple="true"
              :close-on-select="false"
              :clear-on-select="false"
              :preserve-search="true"
              placeholder="Pick some"
              label="name"
              track-by="name"
              :preselect-first="true"
            ></multiselect>
          </div>
        </div>
        <div class="flex flex-wrap mx-3">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tags</label>
            <multiselect
              v-model="movie.tags"
              :options="tags"
              :multiple="true"
              :close-on-select="false"
              :clear-on-select="false"
              :preserve-search="true"
              placeholder="Pick some"
              label="name"
              track-by="name"
              :preselect-first="true"
            ></multiselect>
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Is Public</label>
            <input class="mr-2 leading-tight" v-model="movie.is_public" type="checkbox" />
          </div>
        </div>
        <div class="flex flex-wrap mx-3">
          <div class="w-full px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >Overview</label>
            <div class="w-full">
              <textarea
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-blue-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                v-model="movie.overview"
                rows="5"
                cols="70"
                placeholder="overview"
              ></textarea>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="flex flex-wrap mx-3">
          <div class="w-full px-3 mb-6 md:mb-0">

            <button
              type="submit"
              v-if="Edit"
              @click.prevent="updateMovie(movie)"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >Update</button>
            <button
              type="submit"
              v-if="showForm"
              @click.prevent="Close"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >Close</button>
          </div>
        </div>
        <!-- /.card-footer -->
      </form>
    </section>
    <section v-if="showTable">
      <vcl-table v-if="isLoading"></vcl-table>
      <!--            <Table :movies="movies" v-on:sendEditMovie="editMovie($event)" v-on:sendDeleteMovie="deleteMovie($event)" />-->
      <div class="pt-3">
        <div class="flex p-2 bg-blue-200">
          <input
            class="flex-1"
            type="text"
            v-model="tableData.search"
            placeholder="Search Table"
            @input="getMovies()"
          />

          <div class="flex-1">
            <div class="p-2">
              <select v-model="tableData.length" @change="getMovies()">
                <option
                  v-for="(records, index) in perPage"
                  :key="index"
                  :value="records"
                >{{records}}</option>
              </select>
            </div>
          </div>
          <div class="flex-1">
            <button
              v-if="!showForm"
              type="button"
              class="bg-purple-100 hover:bg-purple-300 rounded-lg p-2 float-right"
              @click="showFormM"
            >Show Form</button>
          </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          <tbody class="w-full">
            <tr
              class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0"
              v-for="movie in movies"
              :key="movie.id"
            >
              <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"
              >
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"
                >Tmdb</span>
                {{movie.tmdb_id}}
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"
              >
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"
                >Titulli</span>
                {{movie.title}}
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"
              >
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"
                >Public</span>
                {{movie.is_public}}
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"
              >
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"
                >Visits</span>
                {{movie.visits}}
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"
              >
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"
                >Format</span>
                {{movie.video_format}}
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"
              >
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"
                >Updated</span>
                {{movie.updated_at}}
              </td>
              <td
                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"
              >
                <span
                  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"
                >Actions</span>
                <div class="flex mr-2">
                  <button
                    class="flex-1 p-1 bg-blue-400 hover:bg-blue-600"
                    @click="editMovie(movie)"
                  >edit</button>
                  <button
                    class="flex-1 p-1 bg-red-400 hover:bg-red-600"
                    @click="deleteMovie(movie)"
                  >Delete</button>
                </div>
              </td>
            </tr>
          </tbody>
        </datatable>
        <pagination
          :pagination="pagination"
          @prev="getMovies(pagination.prevPageUrl)"
          @next="getMovies(pagination.nextPageUrl)"
        ></pagination>
      </div>
    </section>
  </div>
</template>

<script>
import { VclFacebook, VclTable } from "vue-content-loading";
import MovieTabs from "./movie/MovieTabs";
import Datatable from "./Datatable";
import Pagination from "./Pagination";
export default {
  name: "Movie",
  components: {
    VclFacebook,
    VclTable,
    MovieTabs,
    Pagination,
    Datatable
  },
  data() {
    let sortOrders = {};
    let columns = [
      { width: "auto", label: "Tmdb", name: "tmdb_id", isSortable: true },
      { width: "auto", label: "Title", name: "title", isSortable: true },
      { width: "auto", label: "Public", name: "is_public", isSortable: false },
      { width: "auto", label: "Visits", name: "visits", isSortable: true },
      {
        width: "auto",
        label: "Format",
        name: "video_format",
        isSortable: true
      },
      { width: "auto", label: "Updated", name: "updated_at", isSortable: true },
      { width: "auto", label: "Actions", name: "actions", isSortable: false }
    ];
    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      isLoading: false,
      movies: [],
      genres: [],
      casts: [],
      tags: [],
      movie: {
        tmdb_id: "",
        is_public: false,
        title: "",
        release_date: "",
        overview: "",
        runtime: "",
        lang: "",
        video_format: "HD",
        rating: "5.1",
        poster_path: "",
        backdrop_path: "",
        genres: [],
        casts: [],
        tags: []
      },
      tmdb_cast_poster: "",
      tmdb_id: "",
      imdbGenres: [],
      imdbCast: [],
      errorMessage: "",
      Edit: false,
      showForm: false,
      showTable: true,
      columns: columns,
      sortKey: "title",
      sortOrders: sortOrders,
      perPage: ["10", "20", "30"],
      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 5,
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

  async created() {
    await this.getMovies();
    await this.getGenres();
    await this.getCasts();
    await this.getTags();
  },

  methods: {

    getGenreIds(item) {
      const genreIds = [item.id].join(" ");
      return genreIds;
    },
    getCastIds(item) {
      const castIds = [item.id].join(" ");
      return castIds;
    },
    getTagsIds(item) {
      const tagIds = [item.id].join(" ");
      return tagIds;
    },
    getMovies(baseUrl = `/api/admin/admin-movies`) {
      this.isLoading = true;
      this.tableData.draw++;
      const _this = this;
      axios
        .get(baseUrl, { params: this.tableData })
        .then(res => {
          _this.isLoading = false;
          let data = res.data;
          if (_this.tableData.draw == data.draw) {
            _this.movies = data.data.data;
            _this.configPagination(data.data.pagination);
          }
          _this.Close();
        })
        .catch(error => {
          Vue.$toast.error(error);
        });
    },
    getGenres() {
      const _this = this;
      const baseUrl = `/api/admin/admin-genres`;
      axios
        .get(baseUrl)
        .then(res => {
          _this.genres = res.data.data;
        })
        .catch(error => {
          Vue.$toast.error(error);
        });
    },
    getCasts() {
      const _this = this;
      const baseUrl = `/api/admin/admin-movie-casts`;
      axios
        .get(baseUrl)
        .then(res => {
          _this.casts = res.data.data;
        })
        .catch(error => {
          Vue.$toast.error(error);
        });
    },
    getTags() {
      const _this = this;
      const baseUrl = `/api/admin/admin-tags`;
      axios
        .get(baseUrl)
        .then(res => {
          _this.tags = res.data.data;
        })
        .catch(error => {
          Vue.$toast.error(error);
        });
    },
    editMovie(movie) {
      this.showForm = true;
      this.showTable = false;
      this.Edit = true;
      this.movie = movie;
    },
    updateMovie(movie) {
      this.isLoading = true;
      this.showForm = false;
      this.showTable = true;
      const _this = this;
      const url = "https://image.tmdb.org/t/p/w185" + this.movie.poster_path;
      const baseUrl = `/api/admin/admin-movies/${movie.slug}`;
      axios
        .post(baseUrl, {
          tmdb_id: movie.tmdb_id,
          title: movie.title,
          release_date: movie.release_date,
          runtime: movie.runtime,
          lang: movie.lang,
          genres: movie.genres.map(_this.getGenreIds),
          casts: movie.casts.map(_this.getCastIds),
          tags: movie.tags.map(_this.getTagsIds),
          video_format: movie.video_format,
          rating: movie.rating,
          poster_path: url,
          backdrop_path: movie.backdrop_path,
          is_public: movie.is_public,
          overview: movie.overview,
          _method: "PUT"
        })
        .then(res => {
          this.isLoading = false;
          _this.getMovies();
          _this.clear();
          _this.Edit = false;
          Vue.$toast.success(res.data);
        })
        .catch(error => {
          if (error.response.status == 422) {
            const key = Object.keys(error.response.data.errors)[0];
            _this.errorMessage = error.response.data.errors[key][0];
          }
          Vue.$toast.error(error);
        });
    },
    deleteMovie(movie) {
      const _this = this;
      const baseUrl = `/api/admin/admin-movies/${movie.slug}`;
      axios
        .delete(baseUrl)
        .then(res => {
          _this.getMovies();
          Vue.$toast.success(res.data);
        })
        .catch(error => {
          Vue.$toast.error(error);
        });
    },

    generateMovie() {
      this.Edit = false;
      const _this = this;
        const baseUrl = `/api/admin/admin-movies`;
      axios
        .post(baseUrl, {
            'tmdb_id' : _this.tmdb_id
        })
        .then(res => {
            Vue.$toast.success(res.data);
            _this.getMovies();

        })
        .catch(error => {
          Vue.$toast.error(error);
        });
    },
    generateCasts() {
      const _this = this;
      const url = `https://api.themoviedb.org/3/movie/${this.tmdb_id}/credits?api_key=8a11aac3fb4ef5f1f9607ee7e0329793`;
      axios
        .get(url, { withCredentials: false })
        .then(res => {
          _this.imdbCast = res.data.cast;
          Vue.$toast.info("Casts generated");
        })
        .catch(error => {
          Vue.$toast.error(error);
        });
    },
    clear() {
      this.movie = {};
      this.showTable = true;
      this.showForm = false;
      this.imdbGenres = [];
      this.imdbCast = [];
    },
    showFormM() {
      this.showForm = true;
      this.showTable = false;
    },
    Close() {
      this.movie = {};
      this.Edit = false;
      this.showForm = false;
      this.showTable = true;
      this.imdbGenres = [];
      this.imdbCast = [];
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
      this.tableData.column = this.getIndex(this.columns, "name", key);
      this.tableData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
      this.getMovies();
    },
    getIndex(array, key, value) {
      return array.findIndex(i => i[key] == value);
    },

    createCast(cast) {
      if (cast.profile_path) {
        this.tmdb_cast_poster =
          "https://image.tmdb.org/t/p/w185" + cast.profile_path;
      }
      const _this = this;
      axios
        .post("/api/admin/admin-casts", {
          tmdb_id: cast.id,
          name: cast.name,
          poster_path: _this.tmdb_cast_poster
        })
        .then(res => {
          _this.tmdb_cast_poster = null;
          _this.getCasts();
          Vue.$toast.success(res.data);
        })
        .catch(error => {
          if (error.response.status == 422) {
            const key = Object.keys(error.response.data.errors)[0];
            _this.errorMessage = error.response.data.errors[key][0];
          }
          Vue.$toast.error(error);
        });
    }
  }
};
</script>

<style scoped>
@import "~vue-multiselect/dist/vue-multiselect.min.css";
.textred {
  color: red;
}
</style>
