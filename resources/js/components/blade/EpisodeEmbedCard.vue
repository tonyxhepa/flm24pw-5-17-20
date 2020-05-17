<template>
    <section>
        <div class="container bg-black mx-auto rounded-lg my-3" v-if="embeds">
            <div class="flex justify-around">
                <div class="iframe-container bg-yellow-800">
                    <div class="absolute flex justify-center load">
                    </div>
                    <iframe class="rounded-lg"
                            ref="frame"
                            @load="load"
                            v-show="iframe.loaded"
                            :src="iframe.selectedUrl"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
            <div class="flex">
                <button :class="{'bg-yellow-600 cursor-not-allowed' : ei === index}" class="p-2 m-2 focus:outline-none  hover:bg-gray-700 text-gray-300 hover:text-gray-500 rounded-lg border border-yellow-500" v-for="(embed, index) in embeds" :key="index" @click="changeEmbed(embed,index)">{{ embed.web_name}}</button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "EpisodeEmbedCard",
        props: ['embeds'],
        data(){
            return {
                isLoading: true,
                ei: '',
                iframe: {
                    selectedUrl: false,
                    loaded: false
                }
            }
        },
        created() {
            if (this.embeds){
                this.iframe.selectedUrl = this.embeds[0].web_url
            }

        },
        methods: {
            changeEmbed(embed, index){
                this.isLoading = true;
                this.ei = index;
                this.ti = null;
                this.iframe.selectedUrl = embed.web_url
            },
            load: function(){
                this.iframe.loaded = true;
                this.isLoading = false
            }
        }
    }
</script>

<style scoped>
    .iframe-container{
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        height: 0;
        border-radius: 5px;
    }
    .iframe-container iframe{
        position: absolute;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

