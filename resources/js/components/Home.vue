<template>
  <div>
    <h1>Welcome 😀</h1>
    <br>
    <recipes :filter="'all'"></recipes>
  </div>
</template>

<script>
import Recipes from "./Recipes.vue";

export default {
  components: {
    recipes: Recipes
  }
};
</script>
