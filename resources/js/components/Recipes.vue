<template>
  <div>
    <el-row :gutter="20">
      <h3 v-if="recipes.length === 0" :style="{textAlign: 'center'}">No Recipes</h3>
      <el-col v-for="recipe in recipes" :key="recipe.id" :xs="24" :sm="12" :md="8">
        <el-card class="box-card recipe-box" :body-style="{ padding: '0px' }">
          <div @click="goToRecipe(recipe.id)">
            <div v-if="recipe.photo" class="recipe-image-box">
              <img class="recipe-image" :src="recipe.photo" alt>
            </div>
            <div class="recipe-box-card">
              <h3 class="recipe-title">{{recipe.title}}</h3>
            </div>
          </div>
        </el-card>
      </el-col>
    </el-row>
    <br>
    <div class="block" v-if="recipes.length > 0">
      <div :style="{flexGrow: 1}"></div>
      <el-pagination
        class="center-pagination"
        layout="prev, pager, next"
        :total="pagination.totalPages"
        :page-size="pagination.perPage"
        @current-change="select($event)"
      ></el-pagination>
      <div :style="{flexGrow: 1}"></div>
    </div>
  </div>
</template>

<style>
.recipe-box {
  max-width: 400px;
  max-height: 500px;
  cursor: pointer;
  margin: 0 auto;
  margin-bottom: 30px;
}
/* .recipe-box:hover {
  padding: 2px;
  position: absolute;
} */
.recipe-image {
  /* max-height: 300px; */
  width: 100%;
  margin: 0 auto;
  /* margin-top: -100px; */
}
.recipe-box-card {
  padding: 10px 20px 10px 20px;
}
.recipe-image-box {
  background: black;
  max-height: 250px;
  max-width: 400px;
  position: relative;
  /*   */
  /* background-position: 50% 50%; */
  /* background-repeat: no-repeat;
  background-size: cover; */
  overflow: hidden;

  /* border: 3px solid rosybrown; */
}
.block {
  display: flex;
}
</style>


<script>
import axios from "axios";

export default {
  data() {
    return {
      recipes: [],
      pagination: {
        totalPages: 0,
        next: "",
        prev: ""
      }
    };
  },
  mounted() {
    this.fetchRecipes();
  },
  props: {
    filter: String,
    category: String
  },
  watch: {
    category: function() {
      this.fetchRecipes();
    }
  },
  methods: {
    goToRecipe(id) {
      console.log(`/recipe/${id}`);
      this.$router.push({ path: `/recipe/${id}` });
    },
    fetchRecipes() {
      if (this.filter == "author") {
        axios
          .get(`getRecipes/author/${this.category}/${this.$auth.user().id}`)
          .then(res => {
            this.recipes = res.data.data;
            this.pagination.totalPages = res.data.total;
            this.pagination.perPage = res.data.per_page;
            this.pagination.currentPAge = res.data.current_page;
            this.pagination.path = res.data.path;
          })
          .catch(err => console.log(err));
      } else {
        axios
          .get(`getRecipes/all/${this.category}`)
          .then(res => {
            this.recipes = res.data.data;
            this.pagination.totalPages = res.data.total;
            this.pagination.perPage = res.data.per_page;
            this.pagination.currentPAge = res.data.current_page;
            this.pagination.path = res.data.path;
          })
          .catch(err => console.log(err));
      }
    },
    select(e) {
      if (this.filter == "author") {
        axios
          .get(
            `getRecipes/author/${this.category}/${
              this.$auth.user().id
            }?page=${e}`
          )
          .then(res => {
            this.recipes = res.data.data;
            this.pagination.totalPages = res.data.total;
            this.pagination.perPage = res.data.per_page;
            this.pagination.currentPAge = res.data.current_page;
            this.pagination.path = res.data.path;
          })
          .catch(err => console.log(err));
      } else {
        axios
          .get(`getRecipes/all/${this.category}?page=${e}`)
          .then(res => {
            this.recipes = res.data.data;
            this.pagination.totalPages = res.data.total;
            this.pagination.perPage = res.data.per_page;
            this.pagination.currentPAge = res.data.current_page;
            this.pagination.path = res.data.path;
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>

