<template>
  <EditUser ref="editModalComponent" />
  <el-container class="container">
    <el-row>
      <el-col :span="24">
        <el-table
          v-loading="loading"
          :data="tableData"
          :empty-text="'No hay registros'"
          style="border-radius: 10px"
          stripe
        >
          <el-table-column prop="name" label="Nombre" />
          <el-table-column prop="email" label="Correo" />
          <el-table-column label="Acciones" align="center">
            <template #default="scope">
              <el-tooltip content="Editar" placement="top" effect="light">
                <i
                  class="fa-solid fa-pen el-icon-edit properties"
                  @click="edit(scope.row.id)"
                ></i>
              </el-tooltip>
              <Delete
                :endpoint="'api/v1/users/' + scope.row.id"
                event="reload-list-of-users"
                :key="scope.row.id"
              />
            </template>
          </el-table-column>
        </el-table>
      </el-col>
    </el-row>
  </el-container>
</template>
<script>
import { getData } from "../../request/request.js";
import EditUser from "./EditUser.vue";

export default {
  name: "UserList",
  setup() {
    return {};
  },
  components: {
    EditUser,
  },
  data() {
    return {
      tableData: [],
      loading: false,
    };
  },
  methods: {
    loadData() {
      this.loading = true;
      getData("api/users", {})
        .then((res) => {
          this.tableData = res.data;
          this.loading = false;
        })
        .catch(() => {
          this.loading = false;
        });
    },
    edit(id) {
      this.$refs.editModalComponent.openForm(id);
    },
  },
  mounted() {
    this.$emit("reload-list-of-users", () => {
      this.loadData();
    });

    this.loadData();
  },
};
</script>
<style scoped>
.container {
  width: -webkit-fill-available;
  height: fit-content !important;
}

.el-table {
  border-radius: 10px;
}

.el-icon-view {
  color: var(--blue);
  margin-right: 5px;
  font-size: 19px;
  cursor: pointer;
}

.paginate {
  margin: auto;
  text-align: end;
}

.el-row {
  width: inherit;
}

.el-button {
  background: var(--blue);
  color: white;
}

.is-disabled {
  background: #8080809c;
}

.is-disabled:hover {
  background: #8080809c;
}

::v-deep(.el-table thead) {
  color: var(--blue) !important;
}

.el-select {
  background: var(--blue);
  color: white;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}

.el-select-dropdown__item.selected {
  color: var(--blue);
}

.properties {
  color: darkorange;
  margin: 0 10px 0 10px;
  font-size: 20px;
  cursor: pointer;
}
</style>
