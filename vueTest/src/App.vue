<script setup>
import { RouterLink, RouterView } from "vue-router";
import Home from "./views/Home.vue";
import Navbar from "../src/components/Navbar.vue";
</script>

<template>
  <Navbar />
  <main>
    <Home />
    <RouterView />
  </main>
</template>

<style scoped>
main {
  padding: 0px 25px;
}
</style>
