<template>
  <section>
    <div class="container bg-black mx-auto rounded-lg my-3">
      <div class="flex justify-around">
        <div class="iframe-container bg-yellow-800">
            <div class="absolute flex justify-center load">
            </div>
          <iframe
            class="rounded-lg"
            ref="frame"
            @load="load"
            v-show="iframe.loaded"
            :src="iframe.selectedUrl"
            frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
        </div>
      </div>
      <div class="flex">
        <button
          :class="{'bg-yellow-600 cursor-not-allowed' : ei === index}"
          class="p-2 m-2 focus:outline-none hover:bg-gray-700 text-gray-300 hover:text-gray-500 rounded-lg border border-yellow-500"
          v-for="(embed, index) in embeds"
          :key="index"
          @click="changeEmbed(embed,index)"
        >{{ embed.web_name}}</button>
      </div>
      <div class="flex font-bold mx-2 p-2 bg-yellow-600 text-gray-900">Shiko Trailerin</div>
      <div class="flex" v-if="trailers">
        <button
          :class="{'bg-yellow-600 cursor-not-allowed' : ti === index}"
          class="p-2 m-2 focus:outline-none hover:bg-gray-700 text-gray-300 hover:text-gray-500 rounded-lg border border-yellow-500"
          v-for="(trailer, index) in trailers"
          :key="index"
          @click="changeTrailer(trailer, index)"
        >{{ trailer.web_name}}</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "MovieEmbedCard",
  props: ["embeds", "trailers"],
  data() {
    return {
        isLoading: true,
      ei: "",
      ti: "",
      iframe: {
        selectedUrl: false,
        loaded: false
      }
    };
  },
    computed: {
      showPlayer(){
          if(this.iframe.loaded = true){
              this.isLoading = false
          }
      }
    },
  mounted() {
    this.iframe.selectedUrl = this.embeds[0].web_url;
  },
  methods: {
    changeEmbed(embed, index) {
        this.isLoading = true;
      this.ei = index;
      this.ti = null;
      this.iframe.selectedUrl = embed.web_url;
    },
    changeTrailer(trailer, index) {
        this.isLoading = true;
      this.ti = index;
      this.ei = null;
      this.iframe.selectedUrl = trailer.web_url;
    },
    load: function() {
      this.iframe.loaded = true;
      this.isLoading = false;
    }
  }
};
</script>

<style scoped>
.iframe-container {
  position: relative;
  width: 100%;
  padding-bottom: 56.25%;
  height: 0;
  border-radius: 5px;
}
.iframe-container iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

</style>
