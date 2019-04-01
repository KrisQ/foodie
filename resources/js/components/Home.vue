<template>
  <div>
    <el-row>
      <el-col :xs="24" :sm="12" :md="12">
        <h2 :style="{flexGrow: '1'}">Welcome & Bon Appétit 😀</h2>
      </el-col>
      <el-col :xs="24" :sm="12" :md="12">
        <div :style="{display: 'flex'}">
          <div class="flex-grow-md"></div>
          <div class="mt-20">
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
          </div>
        </div>
      </el-col>
    </el-row>

    <br>
    <recipes :filter="'all'" :category="cat"></recipes>
  </div>
</template>

<style>
.mt-20 {
  margin-top: 20px;
}

@media (min-width: 768px) {
  .flex-grow-md {
    flex-grow: 1;
  }
}
</style>


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
  components: {
    recipes: Recipes
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
    setAll() {
      this.cat = "All";
    },
    setCat(category) {
      this.cat = category;
    }
  }
};
</script>
