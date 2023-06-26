<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <nav>
    <div id="menus">
      <RouterLink to="/">Inicio</RouterLink>
      <RouterLink to="/users">Usuarios</RouterLink>
      <RouterLink to="/products">Productos</RouterLink>
      <RouterLink to="/orders">Ordenes</RouterLink>
    </div>
  </nav>
  <main>
    <RouterView />
  </main>
</template>

<style scoped>
main {
  padding: 0px 25px;
}

nav {
  background-color: rgb(0 138 247);
  width: 100%;
  height: 45px;
  font-size: 20px;
  text-align: end;
}

nav a.router-link-exact-active {
  border-radius: 6px;
  background-color: rgb(30 75 111);
  color: white;
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  color: white;
  margin: 5px;
  padding: 7px 35px;
  text-decoration: none;
  border-left: 1px solid var(--color-border);
}

nav a:hover {
  border-radius: 6px;
  background-color: #64b5f6;
}

nav a:first-of-type {
  border: 100px;
}
</style>
