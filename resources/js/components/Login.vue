<template>
  <div>
    <el-card class="box-card small-box">
      <div slot="header" class="clearfix">
        <h4 :style="{textAlign: 'center'}">Login</h4>
      </div>
      <el-alert v-if="error" type="error">
        <p>There was an error, unable to sign in with those credentials.</p>
      </el-alert>

      <el-form ref="form" method="post">
        <el-form-item label="E-mail">
          <el-input type="email" id="email" placeholder="user@example.com" v-model="email" required></el-input>
        </el-form-item>
        <el-form-item label="Password">
          <el-input type="password" id="password" v-model="password" required></el-input>
        </el-form-item>
        <el-form-item>
          <el-button :style="{width: '100%'}" type="primary" @click.prevent="onSubmit">Sign In</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<style>
.small-box {
  max-width: 500px;
  margin: 0 auto;
}
</style>


<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      error: false
    };
  },
  methods: {
    onSubmit() {
      var app = this;
      this.$auth.login({
        params: {
          email: app.email,
          password: app.password
        },
        success: function() {},
        error: function() {},
        rememberMe: true,
        redirect: "/dashboard",
        fetchUser: true
      });
    }
  }
};
</script>
