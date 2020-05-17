window.Vue = require("vue");
window.axios = require("axios");
import SmartTable from "vuejs-smart-table";
import Multiselect from "vue-multiselect";
import VueLazyload from "vue-lazyload";
import VueToast from "vue-toast-notification";
import VueClipboard from "vue-clipboard2";



window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.withCredentials = true;
window.axios.defaults.baseURL = process.env.APP_URL;

Vue.use(VueLazyload, {
    lazyComponent: true,
    preLoad: 1.3,
    error: "/img/loader.jpg",
    loading: "/img/loader.jpg",
    attempt: 1
});
Vue.use(SmartTable);
Vue.component("multiselect", Multiselect);
Vue.use(VueToast);
Vue.use(VueClipboard);

Vue.component("admin-cast", require("./components/admin/Cast").default);
Vue.component("admin-genre", require("./components/admin/Genre").default);
Vue.component("admin-tag", require("./components/admin/Tag").default);
Vue.component("admin-serie", require("./components/admin/Serie").default);
Vue.component("admin-season", require("./components/admin/Season").default);
Vue.component("admin-episode", require("./components/admin/Episode").default);
Vue.component("admin-movie", require("./components/admin/Movie").default);

Vue.component(
    "welcome-movie",
    require("./components/blade/welcome/WelcomeMovies").default
);
Vue.component(
    "welcome-episode",
    require("./components/blade/welcome/WelcomeEpisodes").default
);
Vue.component(
    "welcome-serie",
    require("./components/blade/welcome/WelcomeSeries").default
);
Vue.component(
    "welcome-season",
    require("./components/blade/welcome/WelcomeSeasons").default
);
Vue.component(
    "welcome-cast",
    require("./components/blade/welcome/WelcomeCasts").default
);
Vue.component(
    "movie-embed-card",
    require("./components/blade/MovieEmbedCard").default
);
Vue.component(
    "episode-embed-card",
    require("./components/blade/EpisodeEmbedCard").default
);
Vue.component("welcome", require("./components/blade/welcome/Welcome").default);
Vue.component("vue-navbar", require("./components/blade/Navbar").default);
Vue.component(
    "movie-index",
    require("./components/blade/movie/MovieIndex").default
);
Vue.component("img-card", require("./components/blade/ImgCard").default);
Vue.component(
    "img-card-header",
    require("./components/blade/ImgCardHeader").default
);
Vue.component("copy-url", require("./components/blade/CopyUrl").default);
Vue.component("notification", require("./components/blade/Notification").default);

const app = new Vue({
    el: "#app"
});
