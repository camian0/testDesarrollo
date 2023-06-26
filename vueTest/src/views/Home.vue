<template>
  <Navbar />
  <main>
    <h1>pagina de inicio</h1>
  </main>
</template>

<script>
import Navbar from "../components/Navbar.vue";
export default {
  name: "Home",
  setup() {
    return {};
  },
  components: {
    Navbar,
  },
};
</script>

<style scoped>
main {
  margin: 5px 10px;
}
</style>
