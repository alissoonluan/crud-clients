<template>
  <v-container>
    <v-row class="text-center">
      <v-col class="mb-4">
        <h1 class="display-2 font-weight-bold mb-3">Formulario</h1>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <form v-on:submit.prevent="saveClient()">
          <v-text-field v-model="client.name" label="Nome" outlined required>
          </v-text-field>
          <v-text-field v-model="client.email" label="Email" outlined required>
          </v-text-field>
          <v-card-actions>
            <v-btn color="warning" class="mr-4" type="submit">Salvar</v-btn>
          </v-card-actions>
        </form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  name: "CreateClient",
  data() {
    return {
      client: {
        name: "",
        email: "",
      },
    };
  },
  methods: {
    saveClient() {
      var router = this.$router;
      const formData = new FormData();
      formData.append("name", this.client.name);
      formData.append("email", this.client.email);
      axios
        .post("http://localhost:8000/v1/public/clients/store", formData)
        .then(() => {
          router.push("/clientes");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
  },
};
</script>
