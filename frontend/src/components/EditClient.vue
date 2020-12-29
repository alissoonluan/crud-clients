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
  name: "EditClient",
  mounted() {
    this.id = this.$route.params.id;
    axios
      .get("http://localhost:81/v1/public/clients/" + this.id)
      .then((r) => {
        this.client = r.data.clients[0];
      })
      .catch(function(error) {
        console.log(error);
      });
  },
  data() {
    return {
      id: null,
      client: {
        name: "",
        email: "",
      },
    };
  },
  methods: {
    saveClient() {
      var router = this.$router;
      const params = new URLSearchParams();
      params.append("name", this.client.name);
      params.append("email", this.client.email);

      axios
        .post("http://localhost:81/v1/public/clients/update/" + this.id, params)
        .then(function() {
          router.push("/clientes");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
  },
};
</script>
