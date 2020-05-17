<template>
    <div class="bg-indigo-900 text-center py-4 lg:px-4">
        <div class="p-2 bg-indigo-800 items-center leading-none lg:rounded-full flex lg:inline-flex" role="alert">
            <button class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                    v-clipboard:copy="input"
                    v-clipboard:success="onCopy"
                    v-clipboard:error="onError">
                Copy
            </button>
            <input class="font-bold p-2 mr-2 text-left flex-auto" type="text" v-model="input">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CopyUrl",
        props: ['url'],
        data(){
            return{
                input: ''
            }
        },
        mounted() {
            this.input = this.url
        },
        methods:{
            onCopy: function (e) {
                console.log('You just copied: ' + e.text)
            },
            onError: function (e) {
                alert('Failed to copy texts')
            }
        }
    }
</script>

<style scoped>

</style>
