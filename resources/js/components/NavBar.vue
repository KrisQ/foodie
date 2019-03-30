<template>
  <div>
    <el-menu
      :default-active="activeIndex2"
      class="nav-flex"
      mode="horizontal"
      @select="handleSelect"
      :router="true"
    >
      <!-- background-color="#545c64"
      text-color="#fff"
      active-text-color="#ffd04b"-->

      <el-menu-item index="/">Home 🥐</el-menu-item>
      <div class="nav-flex-grow"></div>
      <el-menu-item v-if="!$auth.check()" index="/login">Login 👩‍🍳</el-menu-item>
      <el-menu-item v-if="!$auth.check()" index="/register">Register 👨‍🍳</el-menu-item>
      <el-menu-item v-if="$auth.check()" index="/dashboard">My Recipes 📝</el-menu-item>
      <el-menu-item v-if="$auth.check()" @click="logout">Logout 👋</el-menu-item>
    </el-menu>
  </div>
</template>

<style>
.nav-flex {
  display: flex;
}
.nav-flex-grow {
  flex-grow: 1;
}
</style>


<script>
export default {
  data() {
    return {
      activeIndex: "1",
      activeIndex2: "1"
    };
  },
  methods: {
    handleSelect(key, keyPath) {
      console.log(key, keyPath);
    },
    logout() {
      this.$auth.logout();
    }
  }
};
</script>
