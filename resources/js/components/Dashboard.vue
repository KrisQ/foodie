<template>
  <div>
    <el-row>
      <el-col :xs="24" :sm="12" :md="12">
        <h3>My Recipes 📝</h3>
      </el-col>
      <el-col :xs="24" :sm="12" :md="12">
        <div class="mt-20" :style="{display: 'flex'}">
          <div class="flex-grow-md"></div>
          <el-dropdown>
            <el-button type="default">
              {{cat}}
              <i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>
                <div :style="{width: '120%', height: '120%', margin: '0'}" @click="setAll">All</div>
              </el-dropdown-item>
              <el-dropdown-item v-for="category in categories" :key="category.id">
                <div
                  :style="{width: '120%', height: '120%', margin: '0'}"
                  @click="setCat(category.name)"
                >{{category.name}}</div>
              </el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          <el-button
            :style="{marginLeft: '10px'}"
            type="default"
            @click="goToCreateRecipe"
          >Create a Recipe! ✏️</el-button>
        </div>
      </el-col>
    </el-row>
    <br>
    <recipes :filter="'author'" :category="cat"></recipes>
  </div>
</template>

<script>
import Recipes from "./Recipes.vue";
import axios from "axios";

export default {
  data() {
    return {
      cat: "All",
      categories: []
    };
  },
  mounted() {
    axios
      .get("categories")
      .then(res => {
        this.categories = res.data;
      })
      .catch(e => console.log(`😡 Error: ${err}`));
  },
  methods: {
    goToCreateRecipe() {
      this.$router.push("/createRecipe");
    },
    setAll() {
      this.cat = "All";
    },
    setCat(category) {
      this.cat = category;
    }
  },
  components: {
    recipes: Recipes
  }
};
</script>
