<template>
  <div>
    <el-dialog
      v-model="dialogVisible"
      width="50%"
      :before-close="handleClose"
      title="Editar usuario"
    >
      <el-row>
        <el-col>
          <div class="content">
            <el-row>
              <el-col :span="16" :offset="4">
                <el-form
                  ref="model"
                  label-position="top"
                  :model="model"
                  :rules="rules"
                  v-loading="loading"
                >
                  <el-form-item label="Nombre" prop="name">
                    <el-input v-model="model.name"></el-input>
                  </el-form-item>

                  <el-form-item label="Correo" prop="email">
                    <el-input v-model="model.email"></el-input>
                  </el-form-item>

                  <el-form-item label="Password" prop="password">
                    <el-input v-model="model.password"></el-input>
                  </el-form-item>
                </el-form>
                <div class="button" align="center">
                  <el-button :loading="loading" @click="saveUser('model')"
                    >Guardar usuario</el-button
                  >
                </div>
              </el-col>
            </el-row>
          </div>
        </el-col>
      </el-row>
    </el-dialog>
  </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import { ElMessageBox } from "element-plus";
import { ElMessage } from "element-plus";
import { ElNotification } from "element-plus";
import { putData, getData } from "../../request/request.js";
export default defineComponent({
  name: "CreateUser",
  components: {},

  setup() {
    const handleClose = (done) => {
      ElMessageBox.confirm(
        "¿Está Seguro que quiere salir de la edición de usuario?",
        {
          showCancelButton: true,
          confirmButtonText: "Confirmar",
          cancelButtonText: "Cancelar",
        }
      )
        .then(() => {
          done();
        })
        .catch(() => {
          // catch error
        });
    };

    return {
      handleClose,
    };
  },
  data() {
    return {
      dialogVisible: false,
      roles: [],
      loading: false,
      idUser: 0,
      model: {
        name: "",
        email: "",
        password: "",
      },
      rules: {
        name: [
          {
            required: true,
            message: "Por favor ingresa un nombre",
            trigger: "blur",
          },
        ],
        email: [
          {
            type: "email",
            message: "Por favor ingresa una dirección de correo válido",
            trigger: "blur",
          },
          {
            required: true,
            message: "Por favor ingresa una dirección de correo",
            trigger: "blur",
          },
        ],
        password: [
          {
            required: true,
            message: "Por favor ingresa una cotraseña",
            trigger: "blur",
          },
        ],
      },
    };
  },
  methods: {
    validateForm(formName) {
      console.log(this.$refs[formName]);
      let res;
      this.$refs[formName].validate((valid) => {
        res = valid;
      });
      return res;
    },

    getUser() {
      this.loading = true;
      getData("api/users/" + this.idUser, {}, true)
        .then((res) => {
          if (res.error == true || res.error == undefined) {
            ElNotification({
              title: "Error",
              message: res.message,
              type: "error",
            });
          } else {
            this.model.name = res.data.name;
            this.model.email = res.data.email;
          }
          this.loading = false;
        })
        .catch(() => {
          ElNotification({
            title: "Error",
            message: "Ocurrió un error al hacer la petición",
            type: "error",
          });

          this.loading = false;
        });
    },
    saveUser(formName) {
      this.loading = true;
      console.log(this.validateForm(formName));
      if (this.validateForm(formName)) {
        putData("api/users/" + this.idUser, this.model, true)
          .then((res) => {
            if (res.error == true || res.error == undefined) {
              ElNotification({
                title: "Error",
                message: res.message,
                type: "error",
              });
            } else {
              ElNotification({
                title: "Usuario actualizado",
                message: res.message,
                type: "success",
              });

              this.dialogVisible = false;
              this.emitter.emit("reload-list-of-users");
            }
            this.loading = false;
          })
          .catch(() => {
            ElNotification({
              title: "Error",
              message: "Ocurrió un error al hacer la petición",
              type: "error",
            });
            this.loading = false;
          });
      } else {
        ElMessage.error("¡ Error !, Por favor verifica todos los campos");
        this.loading = false;
      }
    },
    openForm(id) {
      this.cleanForm();
      this.idUser = id;
      this.getUser();
      this.dialogVisible = true;
    },
    cleanForm() {
      let form = this.$refs["model"];
      if (form) {
        form.resetFields();
      }

      this.model = {
        name: "",
        email: "",
        password: "",
      };
    },
  },
});
</script>

<style scoped>
.el-button--danger {
  background: #bc0304;
  border: none;
}

.el-button--success {
  background: #003149;
  border: none;
}

.el-button--primary {
  background: var(--blue) !important;
  border: 1px solid var(--blue) !important;
}

.el-button--text {
  color: var(--blue) !important;
  font-weight: bold;
  font-size: 25px;
}
.content {
  margin-top: 30px;
}
.icon-step {
  width: 20px;
}

::v-deep(.el-dialog__body) {
  text-align: center;
}

::v-deep(.el-form--label-top .el-form-item__label) {
  padding: 0;
}
</style>
