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
body {
  font-family: "Courier New", Courier, monospace !important;
  min-height: 100vh;
  color: #2c3e50;
  background-color: rgb(224 231 231) !important;
  transition: color 0.5s, background-color 0.5s;
  line-height: 1.6;
  font-size: 15px;
  text-rendering: optimizeLegibility;
}
main {
  padding: 0px 25px;
}
</style>
