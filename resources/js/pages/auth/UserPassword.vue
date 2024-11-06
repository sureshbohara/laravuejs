<template>
  <main class="page-content">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="card">
      <div class="card-header bg-custom">
        <h6 class="mb-0 text-light">Update Your Password</h6>
      </div>
      <div class="row">
        <!-- Form Column -->
        <div class="col-12 col-lg-6">
          <form @submit.prevent="updatePassword">
            <input type="text" v-model="username" style="display: none;" autocomplete="username" />
            <div class="card-body row g-3">
              <div class="col-12">
                <label class="form-label">Current Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input 
                    :type="currentPasswordVisible ? 'text' : 'password'" 
                    v-model="currentPassword" 
                    class="form-control" 
                    required 
                    autocomplete="current-password"
                  />
                  <button 
                    type="button" 
                    class="btn btn-outline-secondary" 
                    @click="togglePasswordVisibility('currentPassword')"
                  >
                    <i class="bi" :class="{'bi-eye-slash': currentPasswordVisible, 'bi-eye': !currentPasswordVisible}"></i>
                  </button>
                </div>
              </div>

              <div class="col-12">
                <label class="form-label">New Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input 
                    :type="newPasswordVisible ? 'text' : 'password'" 
                    v-model="newPassword" 
                    class="form-control" 
                    required 
                    autocomplete="new-password"
                  />
                  <button 
                    type="button" 
                    class="btn btn-outline-secondary" 
                    @click="togglePasswordVisibility('newPassword')"
                  >
                    <i class="bi" :class="{'bi-eye-slash': newPasswordVisible, 'bi-eye': !newPasswordVisible}"></i>
                  </button>
                </div>
              </div>

              <div class="col-12">
                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input 
                    :type="confirmPasswordVisible ? 'text' : 'password'" 
                    v-model="confirmPassword" 
                    class="form-control" 
                    required 
                    autocomplete="new-password"
                  />
                  <button 
                    type="button" 
                    class="btn btn-outline-secondary" 
                    @click="togglePasswordVisibility('confirmPassword')"
                  >
                    <i class="bi" :class="{'bi-eye-slash': confirmPasswordVisible, 'bi-eye': !confirmPasswordVisible}"></i>
                  </button>
                </div>
              </div>

              <div v-if="serverMessage" class="col-12">
                <div :class="{'text-success': serverStatus === 200, 'text-danger': serverStatus !== 200}">
                  {{ serverMessage }}
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn bg-custom text-light">Save & Update</button>
            </div>
          </form>
        </div>

        <!-- Instructions Column -->
        <div class="col-12 col-lg-6">
          <div class="card-body">
            <h6>Password Change Instructions</h6>
            <p>Please follow these instructions to change your password:</p>
            <ol class="instructions-list">
              <li>Enter your current password in the "Current Password" field.</li>
              <li>Enter your new password in the "New Password" field.</li>
              <li>Confirm your new password by retyping it in the "Confirm Password" field.</li>
              <li>Click on the "Save & Update" button to update your password.</li>
              <li>Ensure your new password is at least 8 characters long.</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>


<script>
import Breadcrumb from '../../components/Breadcrumb.vue';
import axios from '../../axios';
import toastr from 'toastr';

export default {
  name: 'UserPassword',
  components: { Breadcrumb },
  data() {
    return {
      breadcrumbs: [
        { text: 'Users', link: { name: 'users.index' } },
        { text: 'Update User Password', link: null },
      ],
      currentPassword: '',
      newPassword: '',
      confirmPassword: '',
      currentPasswordVisible: false,
      newPasswordVisible: false,
      confirmPasswordVisible: false,
      username: '', // Added for accessibility
      serverMessage: '',
      serverStatus: null,
    };
  },
  methods: {
    async updatePassword() {
      // Basic front-end validation
      if (this.newPassword !== this.confirmPassword) {
        this.serverMessage = 'New password and confirmation do not match.';
        this.serverStatus = 400; // Bad request
        return;
      }

      try {
        const response = await axios.post('/admin/password/update', {
          current_password: this.currentPassword,
          new_password: this.newPassword,
          confirm_password: this.confirmPassword,
        });

        this.serverMessage = response.data.msg;
        this.serverStatus = response.status;
        toastr.success(this.serverMessage);

        this.resetForm();
      } catch (error) {
        this.serverMessage = error.response?.data.msg || 'An error occurred. Please try again.';
        this.serverStatus = error.response?.status || 500; // Internal Server Error
      }
    },
    resetForm() {
      this.currentPassword = '';
      this.newPassword = '';
      this.confirmPassword = '';
    },
    togglePasswordVisibility(field) {
      if (field === 'currentPassword') {
        this.currentPasswordVisible = !this.currentPasswordVisible;
      } else if (field === 'newPassword') {
        this.newPasswordVisible = !this.newPasswordVisible;
      } else if (field === 'confirmPassword') {
        this.confirmPasswordVisible = !this.confirmPasswordVisible;
      }
    },
  },
};
</script>

