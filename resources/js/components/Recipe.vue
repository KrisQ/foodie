<template>
  <el-card class="box-card">
    <div slot="header" class="clearfix">
      <h3 :style="{textAlign: 'center'}">{{recipe.title}}</h3>
      <h4 :style="{textAlign: 'center'}">
        <i>{{recipe.categories}}</i>
      </h4>
    </div>

    <el-row :gutter="20">
      <el-col :xs="24" :sm="12" :md="8" class="mb-20">
        <h4>Ingredients:</h4>
        <ul v-if="recipe.ingredients && recipe.ingredients.length > 0">
          <li v-for="(ingredient, i) in recipe.ingredients" :key="i">
            <i>{{ingredient}}</i>
          </li>
        </ul>
      </el-col>
      <el-col :xs="24" :sm="12" :md="8" class="mb-20">
        <h4>Instructions:</h4>
        <ul v-if="recipe.instructions && recipe.instructions.length > 0">
          <li v-for="(instruction, i) in recipe.instructions" :key="i">
            <i>{{instruction}}</i>
          </li>
        </ul>
      </el-col>
      <el-col :xs="24" :sm="12" :md="8" class="mb-20">
        <img class="recipe-photo" :src="recipe.photo" alt>
      </el-col>
    </el-row>
    <div v-if="isSelf" class="button-grid">
      <el-button @click="editRecipe" type="primary">Edit</el-button>
      <el-button @click="deleteRecipe" type="danger">Delete</el-button>
    </div>
  </el-card>
</template>

<style>
.recipe-photo {
  max-height: 400px;
  margin: 0 auto;
}
.mb-20 {
  margin-bottom: 20px;
}
.button-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
}
</style>


<script>
import axios from "axios";

export default {
  data() {
    return {
      recipe: {},
      isSelf: false
    };
  },
  mounted() {
    axios
      .get(`getRecipe/${this.$route.params.id}`)
      .then(res => {
        this.recipe = res.data;
        this.recipe.ingredients = JSON.parse(res.data.ingredients);
        this.recipe.instructions = JSON.parse(res.data.instructions);
        this.recipe.author === this.$auth.user().id
          ? (this.isSelf = true)
          : (this.isSelf = false);
        console.log(this.recipe);
      })
      .catch(err => console.log(err));
  },
  methods: {
    editRecipe() {
      this.$router.push({ path: `/createRecipe/${this.$route.params.id}` });
    },
    deleteRecipe() {
      const confirmed = confirm("Are you sure you want to delete this recipe?");
      if (confirmed) {
        axios
          .post(`deleteRecipe/${this.$route.params.id}`)
          .then(res => {
            this.$router.push("/dashboard");
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>
