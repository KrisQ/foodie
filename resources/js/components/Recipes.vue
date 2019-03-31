<template>
  <div>
    <el-row :gutter="20">
      <el-col v-for="recipe in recipes" :key="recipe.id" :xs="12" :sm="12" :md="8">
        <el-card class="box-card recipe-box" :body-style="{ padding: '0px' }">
          <div @click="goToRecipe(recipe.id)">
            <div class="recipe-image-box">
              <img class="recipe-image" :src="recipe.photo" alt>
            </div>
            <div class="recipe-box-card">
              <h3 class="recipe-title">{{recipe.title}}</h3>
            </div>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<style>
.recipe-box {
  max-width: 400px;
  max-height: 500px;
  cursor: pointer;
  margin: 0 auto;
  margin-bottom: 20px;
}
.recipe-box:hover {
  border: 2px solid white;
}
.recipe-image {
  height: 100%;
  width: 100%;
  max-height: 400px;
  max-width: 400px;

  margin: 0px;
}
.recipe-box-card {
  padding: 10px 20px 10px 20px;
}
.recipe-image-box {
  max-height: 400px;
  max-width: 400px;
  /* border: 3px solid rosybrown; */
}
/* .recipe-title {
  color: cadetblue;
} */
</style>


<script>
import axios from "axios";

export default {
  data() {
    return {
      recipes: []
    };
  },
  mounted() {
    if (this.filter == "author") {
      axios
        .get(`getRecipes/author/${this.$auth.user().id}`)
        .then(res => {
          this.recipes = res.data;
        })
        .catch(err => console.log(err));
    } else {
      axios
        .get(`getRecipes/all`)
        .then(res => {
          this.recipes = res.data;
        })
        .catch(err => console.log(err));
    }
  },
  props: {
    filter: String
  },
  methods: {
    goToRecipe(id) {
      console.log(`/recipe/${id}`);
      this.$router.push({ path: `/recipe/${id}` });
    }
  }
};
</script>

