<template>
  <div class="row container mx-auto rounded-lg bg-black">
    <div class="header flex flex-wrap rounded-lg">
      <a href="/filma" class="w-full md:w-1/3">
        <div
          class="p-2 mt-2 mr-2 rounded-lg hover:bg-gray-500 hover:text-gray-900 bg-gray-700 text-yellow-500 text-center font-bold"
        >Filma</div>
      </a>
      <a href="/seriale" class="w-full md:w-1/3">
        <div
          class="p-2 mt-2 mr-2 rounded-lg hover:bg-gray-500 hover:text-gray-900 bg-gray-700 text-yellow-500 text-center font-bold"
        >Seriale</div>
      </a>
      <a href="/aktor" class="w-full md:w-1/3">
        <div
          class="p-2 mt-2 mr-2 rounded-lg hover:bg-gray-500 hover:text-gray-900 bg-gray-700 text-yellow-500 text-center font-bold"
        >Aktoret</div>
      </a>
    </div>
    <div class="column" v-for="(genre, i) in genres" :key="i">
      <a
        class="rounded-lg py-1 px-4 bg-gray-800 hover:bg-gray-700 text-white mx-6 text-center"
        :href="genre.url"
      >{{ genre.name }}</a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Dropdown",
  props: ["genres"]
};
</script>

<style scoped>
</style>
