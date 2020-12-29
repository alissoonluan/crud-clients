<template>
  <v-container>
    <v-row class="text-center">
      <v-col class="mb-4">
        <h2 class="display 2 font-weight-bold mb-3">
          Listar os Clientes
        </h2>
      </v-col>
    </v-row>

    <v-row>
      <v-col class="mb-1">
        <v-btn
          :to="{ name: 'CreateClient' }"
          class="mx-2"
          fab
          dark
          color="indigo"
        >
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
      </v-col>
    </v-row>

    <v-row class="text-center">
      <v-col cols="12">
        <v-simple-table fixed-header class="elevation-3">
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Email</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="client in clients" :key="client.id">
                <td>{{ client.id }}</td>
                <td>{{ client.name }}</td>
                <td>{{ client.email }}</td>
                <td>
                  <v-btn
                    :to="{ name: 'EditClient', params: { id: client.id } }"
                    fab
                    small
                    color="primary"
                    ><v-icon>mdi-pencil</v-icon></v-btn
                  >
                  <v-btn
                    @click.stop="dialog = true"
                    @click="id = client.id"
                    fab
                    small
                    color="error"
                    ><v-icon>mdi-delete</v-icon></v-btn
                  >
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
    </v-row>

    <v-dialog v-model="dialog" max-width="350">
      <v-card>
        <v-card-title class="headline"
          >Deseja Deletar este registro?</v-card-title
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="dialog = false">Cancelar</v-btn>
          <v-btn @click="confirmDel(id)" color="error">Confirmar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-snackbar v-model="snackbar" color="success">
      {{ textsnack }}
      <template v-slot:action="{ attrs }">
        <v-btn text v-bind="attrs" @click="snackbar = false">Fechar</v-btn>
      </template>
    </v-snackbar>
  </v-container>
</template>
<script>
import axios from "axios";
export default {
  name: "ListClient",
  mounted() {
    this.getClient();
  },
  data() {
    return {
      dialog: false,
      clients: null,
      id: null,
      snackbar: false,
      textsnack: "Registro Deletado!",
    };
  },
  methods: {
    getClient() {
      axios
        .get("http://localhost:81/v1/public/clients")
        .then((r) => {
          this.clients = r.data.clients;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    confirmDel(id) {
      axios
        .delete("http://localhost:81/v1/public/clients/delete/" + id)
        .then(() => {
          this.getClient();
          this.dialog = false;
          this.snackbar = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
  },
};
</script>
