<script setup>
import { RouterLink, RouterView } from "vue-router";
import Home from "./views/Home.vue";
</script>

<template>
  <Home />
  <RouterView />
</template>

<style scoped>
body {
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue",
    sans-serif;
  min-height: 100vh;
  color: #2c3e50;
  background-color: rgb(224 231 231);
  transition: color 0.5s, background-color 0.5s;
  line-height: 1.6;
  font-size: 15px;
  text-rendering: optimizeLegibility;
}
</style>
