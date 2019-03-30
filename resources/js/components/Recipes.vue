<template>
  <div>
    <h1>Recipes {{filter}}</h1>
  </div>
</template>

<script>
import axios from "axios";

export default {
  mounted() {
    if (this.filter == "author") {
      axios
        .get(`getRecipes/author/${this.$auth.user().id}`)
        .then(res => console.log(res));
    } else {
      axios.get(`getRecipes/all`).then(res => console.log(res));
    }
  },
  props: {
    filter: String
  }
};
</script>

