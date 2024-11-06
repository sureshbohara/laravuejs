<template>
  <div class="background">
    <div class="container">
      <div class="row justify-content-center">
        <div class="card shadow">
          <div class="card-body">
            <div class="mb-3 text-center">
              <h2 class="mb-4">Admin Login</h2>
              <img src="/images/noimage.png" alt="Logo" class="logo" width="40%" />
            </div>
            <hr />
            <form @submit.prevent="login">
              <div class="mb-3">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="username-addon">✉</span>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Enter Your Email"
                    v-model="email"
                    required
                    aria-label="Email"
                    :disabled="loading"
                    autocomplete="username"
                  />
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="password-addon">🔒</span>
                  <input
                    :type="showPassword ? 'text' : 'password'"
                    class="form-control"
                    placeholder="Enter Your Password"
                    v-model="password"
                    required
                    aria-label="Password"
                    :disabled="loading"
                    autocomplete="current-password"
                  />
                  <span class="passwordShow" @click="togglePasswordVisibility">
                    <i class="bi" :class="showPassword ? 'bi-eye' : 'bi-eye-slash'" id="eye"></i>
                  </span>
                </div>
              </div>
              <div v-if="error" class="alert alert-danger text-center">{{ error }}</div>
              <button type="submit" class="btn btn-primary w-100 mb-2" :disabled="loading">
                <i class="bi bi-box-arrow-in-right"></i>
                <span v-if="loading">Loading...</span>
                <span v-else>Login</span>
              </button>
              <p class="text-center">or</p>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary">
                  <i class="bi bi-person-plus"></i> Register
                </button>
                <button type="button" class="btn btn-link">
                  <i class="bi bi-lock"></i> Forgot Password?
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { AuthService } from '../../services/auth';
import axios from '../../axios';
import toastr from 'toastr';

export default {
  name: 'AdminLogin',
  data() {
    return {
      email: '',
      password: '',
      loading: false,
      showPassword: false,
      error: null,
    };
  },
  methods: {
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    async login() {
      this.loading = true;
      this.error = null; // Clear previous errors
      try {
        const response = await axios.post('/admin/login', {
          email: this.email,
          password: this.password,
        });
        AuthService.login(response.data.token);
        toastr.success(response.data.msg);
        this.$router.push({ name: 'admin.dashboard' });
      } catch (error) {
        this.error = error.response?.data?.msg || 'Login failed';
        toastr.error(this.error);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
.background {
  background-image: url('/images/bgimg.jpg');
  background-size: cover;
  background-position: center;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.container {
  max-width: 450px;
  width: 100%;
  margin: auto;
}

.passwordShow {
  cursor: pointer;
}
</style>
