<template>
  <h1>Usuarios</h1>
  <UserList />
</template>

<script>
import UserList from "../components/user/UserList.vue";

export default {
  name: "UserView",
  setup() {
    return {};
  },
  components: {
    UserList,
  },
  data() {},
  methods: {},
};
</script>

<style scoped>
h1 {
  text-align: center;
}
</style>
