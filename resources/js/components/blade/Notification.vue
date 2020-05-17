<template>
    <section v-if="Show">
        <div class="container mx-auto m-2">
            <div class="flex flex-wrap bg-yellow-800 rounded-lg p-2 font-bold">
                <div class="flex-1">
                    <slot/>
                </div>
                <div class="float-right">
                    <button @click="Hide"><svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-teal-500 inline-block h-4 w-4"
                                               viewBox="0 0 20 20">
                        <path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Notification",
        data(){
            return{
                Show: true
            }
        },
        methods: {
            Hide(){
                this.Show = false
            }
        }
    }
</script>

<style scoped>

</style>
