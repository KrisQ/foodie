<template>
  <div>
    <el-card class="box-card small-box">
      <div slot="header" class="clearfix">
        <h4 :style="{textAlign: 'center'}">Register</h4>
      </div>
      <el-alert v-if="error && !success" type="error">
        <p>There was an error, unable to complete registration.</p>
      </el-alert>

      <el-alert v-if="success" type="success">
        <p>
          Registration completed. You can now
          <router-link :to="{name:'login'}">sign in.</router-link>
        </p>
      </el-alert>

      <el-form ref="form" label-width="120px" v-if="!success" method="post">
        <el-form-item label="Name">
          <el-input type="text" id="name" placeholder="John" v-model="name" required></el-input>
          <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
        </el-form-item>

        <el-form-item label="E-mail">
          <el-input type="email" id="email" placeholder="user@example.com" v-model="email" required></el-input>
          <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
        </el-form-item>
        <el-form-item label="Password">
          <el-input type="password" id="password" v-model="password" required></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click.prevent="register">Sign In</el-button>
        </el-form-item>
      </el-form>
    </el-card>

    <!-- <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
      <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" v-model="name" required>
        <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
      </div>
      <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
        <label for="email">E-mail</label>
        <input
          type="email"
          id="email"
          class="form-control"
          placeholder="user@example.com"
          v-model="email"
          required
        >
        <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
      </div>
      <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" v-model="password" required>
        <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      error: false,
      errors: {},
      success: false
    };
  },
  methods: {
    register() {
      var app = this;
      this.$auth.register({
        data: {
          name: app.name,
          email: app.email,
          password: app.password
        },
        success: function() {
          app.success = true;
        },
        error: function(resp) {
          app.error = true;
          app.errors = resp.response.data.errors;
        },
        redirect: null
      });
    }
  }
};
</script>
