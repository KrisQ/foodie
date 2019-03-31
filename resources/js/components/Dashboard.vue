<template>
  <div>
    <div :style="{display: 'flex'}">
      <h3 :style="{flexGrow: '1'}">My Recipes 📝</h3>
      <el-button type="default" @click="goToCreateRecipe">Create a Recipe! 🚀</el-button>
    </div>
    <br>
    <recipes :filter="'author'"></recipes>
  </div>
</template>

<script>
import Recipes from "./Recipes.vue";

export default {
  methods: {
    goToCreateRecipe() {
      this.$router.push("/createRecipe");
    }
  },
  components: {
    recipes: Recipes
  }
};
</script>
