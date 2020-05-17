<template>
  <img
    class="w-16 h-16 md:w-24 md:h-24 rounded-full mx-auto md:mx-0 md:mr-6 hover:opacity-75 transition transition-900 transition-ease-in bg-indigo"
    v-lazy="img"
    alt="movie poster"
  />
</template>

<script>
export default {
  name: "ImgCard",
  props: ["img"]
};
</script>

<style scoped>
</style>
