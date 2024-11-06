<template>
  <main class="page-content">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="card">
      <div class="card-header bg-custom">
        <h6 class="mb-0 text-light">Update Your Profile</h6>
      </div>
      <div v-if="loading" class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <form @submit.prevent="updateProfile" enctype="multipart/form-data" v-if="!loading">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-4">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" v-model="user.name" required />
            </div>
            <div class="col-4">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" v-model="user.email" required />
            </div>
            <div class="col-4">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" v-model="user.address" placeholder="Enter Address" />
            </div>
            <div class="col-4">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" v-model="user.mobile" placeholder="Enter Phone" />
            </div>
            <div class="col-4">
              <label class="form-label">Gender</label>
              <select class="form-select" v-model="user.gender" required>
                <option value="" disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-4">
              <label class="form-label">Facebook</label>
              <input type="text" class="form-control" v-model="user.facebook" placeholder="Facebook Link" />
            </div>
            <div class="col-4">
              <label class="form-label">Instagram</label>
              <input type="text" class="form-control" v-model="user.instagram" placeholder="Instagram Link" />
            </div>
            <div class="col-4">
              <label class="form-label">WhatsApp</label>
              <input type="text" class="form-control" v-model="user.whatsapp" placeholder="WhatsApp No." />
            </div>
            <div class="col-4">
              <label class="form-label">Profile Image</label>
              <input id="image" type="file" class="form-control" @change="onFileChange" />
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Current Image</label>
              <img :src="user.imageUrl" width="100" height="100" alt="User Image" class="preview" />
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" v-model="user.info" rows="3" placeholder="Profile Description"></textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn bg-custom text-light" :disabled="loading">Save & Update</button>
        </div>
      </form>
      <div v-if="!loading && !user.name" class="text-warning">
        <p>No user profile found. Please check back later.</p>
      </div>
    </div>
  </main>
</template>

<script>
import Breadcrumb from '../../components/Breadcrumb.vue';
import axios from '../../axios';
import toastr from 'toastr';

export default {
  name: 'UserProfile',
  components: { Breadcrumb },
  data() {
    return {
      breadcrumbs: [
        { text: 'Users', link: { name: 'users.index' } },
        { text: 'Update User Profiles', link: null },
      ],
      user: {
        name: '',
        email: '',
        address: '',
        mobile: '',
        gender: '',
        facebook: '',
        instagram: '',
        whatsapp: '',
        info: '',
        image: null,
      },
      loading: true,
    };
  },
  methods: {
    async updateProfile() {
      const formData = new FormData();
      Object.entries(this.user).forEach(([key, value]) => {
        if (key === 'image' && value) {
          formData.append(key, value);
        } else if (key !== 'image') {
          formData.append(key, value);
        }
      });

      try {
        const response = await axios.post('/admin/profile/update', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        toastr.success(response.data.msg);
      } catch (error) {
        toastr.error(error.response?.data.msg || 'An error occurred');
      }
    },

    async fetchUserProfile() {
      try {
        const response = await axios.get('/admin/profile');
        this.user = response.data.data;
      } catch (error) {
        toastr.error('Failed to fetch user profile');
      } finally {
        this.loading = false;
      }
    },

    onFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.user.image = file; // Store the file in user object
      }
    },
  },
  mounted() {
    this.fetchUserProfile();
  },
};
</script>

<style scoped>
/* Add your styles here if needed */
</style>
