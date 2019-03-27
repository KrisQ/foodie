<template>
  <div>
    <nav-bar></nav-bar>
    <el-container>
      <el-main>
        <router-view></router-view>
      </el-main>
    </el-container>
  </div>
</template>

<script>
import NavBar from "./components/NavBar.vue";
export default {
  name: "App",
  components: {
    "nav-bar": NavBar
  }
};
</script>

