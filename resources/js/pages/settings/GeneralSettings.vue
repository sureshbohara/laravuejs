<template>
  <main class="page-content">
    <!-- Breadcrumb Navigation -->
    <Breadcrumb :breadcrumbs="breadcrumbs" />

    <!-- Loader (this will be shown while data is loading) -->
    <div v-if="loading" class="text-center">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <p>Loading settings...</p>
    </div>

    <!-- Card to hold the form (only shown when data is loaded) -->
    <div v-else class="card">
      <div class="card-header d-flex align-items-center justify-content-between bg-custom">
        <h6 class="mb-0 text-light">Update General Settings</h6>
      </div>

      <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
        <div class="card-body">
          <div class="row g-3">
            <!-- Basic Settings Section -->
            <div class="col-md-4 col-12">
              <h5>Conac Settings</h5>
              <div class="form-group mb-2">
                <label for="system_name" class="form-label">System Name</label>
                <input
                  id="system_name"
                  v-model="settings.system_name"
                  type="text"
                  class="form-control"
                  placeholder="Enter system name"
                  required
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <input
                  id="email"
                  v-model="settings.email"
                  type="email"
                  class="form-control"
                  placeholder="Enter email address"
                  required
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="phone" class="form-label">Phone 1</label>
                <input
                  id="phone"
                  v-model="settings.phone"
                  type="tel"
                  class="form-control"
                  placeholder="Enter phone number"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="phone1" class="form-label">Phone 2</label>
                <input
                  id="phone1"
                  v-model="settings.phone1"
                  type="tel"
                  class="form-control"
                  placeholder="Enter phone number"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="address" class="form-label">Address</label>
                <input
                  id="address"
                  v-model="settings.address"
                  type="text"
                  class="form-control"
                  placeholder="Enter address"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="opening_hr" class="form-label">Opening Hours</label>
                <input
                  id="opening_hr"
                  v-model="settings.opening_hr"
                  type="text"
                  class="form-control"
                  placeholder="Enter opening hours"
                  :disabled="loading"
                />
              </div>
            </div>

            <!-- Social Media Section -->
            <div class="col-md-4 col-12">
              <h5>Social Media Settings</h5>
              <div class="form-group mb-2">
                <label for="facebook" class="form-label">Facebook</label>
                <input
                  id="facebook"
                  v-model="settings.facebook"
                  type="text"
                  class="form-control"
                  placeholder="Enter Facebook URL"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="twitter" class="form-label">Twitter</label>
                <input
                  id="twitter"
                  v-model="settings.twitter"
                  type="text"
                  class="form-control"
                  placeholder="Enter Twitter URL"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="linkedin" class="form-label">LinkedIn</label>
                <input
                  id="linkedin"
                  v-model="settings.linkedin"
                  type="text"
                  class="form-control"
                  placeholder="Enter LinkedIn URL"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="instagram" class="form-label">Instagram</label>
                <input
                  id="instagram"
                  v-model="settings.instagram"
                  type="text"
                  class="form-control"
                  placeholder="Enter Instagram URL"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="youtube" class="form-label">YouTube</label>
                <input
                  id="youtube"
                  v-model="settings.youtube"
                  type="text"
                  class="form-control"
                  placeholder="Enter YouTube URL"
                  :disabled="loading"
                />
              </div>

              <div class="form-group mb-2">
                <label for="tiktok" class="form-label">TikTok</label>
                <input
                  id="tiktok"
                  v-model="settings.tiktok"
                  type="text"
                  class="form-control"
                  placeholder="Enter TikTok URL"
                  :disabled="loading"
                />
              </div>
            </div>

            <!-- Section Activation Settings -->
            <div class="col-md-4 col-12">
              <h5>Activation Settings</h5>
              <div class="form-group mb-2" v-for="(section, index) in sectionOptions" :key="index">
                <label :for="'section' + index" class="form-label">{{ section.name }}</label>
                <select
                  :id="'section' + index"
                  class="form-select"
                  v-model="settings['is_section' + (index + 1)]"
                  required
                  :disabled="loading"
                >
                  <option value="1">YES</option>
                  <option value="0">NO</option>
                </select>
              </div>
            </div>

            <!-- Title Settings -->
            <div class="col-12">
              <h5>Title Settings</h5>
              <div class="row">
                <div
                  class="form-group mb-2 col-md-6"
                  v-for="(title, index) in titleOptions"
                  :key="index"
                >
                  <label :for="'title' + (index + 1)" class="form-label">Title {{ index + 1 }}</label>
                  <input
                    :id="'title' + (index + 1)"
                    v-model="settings['title' + (index + 1)]"
                    type="text"
                    class="form-control"
                    :placeholder="'Enter title' + (index + 1)"
                    :disabled="loading"
                  />
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Footer with Submit Button -->
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary" :disabled="submitting || loading">
            <span v-if="submitting">Submitting...</span>
            <span v-else>Update Settings</span>
          </button>
        </div>
      </form>
    </div>
  </main>
</template>

<script>
import Breadcrumb from '../../components/Breadcrumb.vue';
import axios from '../../axios';
import toastr from 'toastr';

export default {
  components: { Breadcrumb },
  data() {
    return {
      breadcrumbs: [
        { text: 'Settings', link: { name: 'settings.general' } },
        { text: 'General Settings', link: null },
      ],
      settings: {
        system_name: '',
        email: '',
        phone: '',
        address: '',
        opening_hr: '',
        facebook: '',
        twitter: '',
        linkedin: '',
        instagram: '',
        youtube: '',
        tiktok: '',
        is_section1: false,
        is_section2: false,
        is_section3: false,
        is_section4: false,
        is_section5: false,
        is_section6: false,
        title1: '',
        title2: '',
        title3: '',
        title4: '',
        title5: '',
        title6: '',
      },
      sectionOptions: [
        { name: 'Section 1' },
        { name: 'Section 2' },
        { name: 'Section 3' },
        { name: 'Section 4' },
        { name: 'Section 5' },
        { name: 'Section 6' },
      ],
      titleOptions: [
        { name: 'Title 1' },
        { name: 'Title 2' },
        { name: 'Title 3' },
        { name: 'Title 4' },
        { name: 'Title 5' },
        { name: 'Title 6' },
      ],
      loading: true,  // Loading state for showing spinner
      submitting: false,  // Submitting state to disable the button
    };
  },
  created() {
    this.getSettings();
  },
  methods: {
    // Fetch the current settings from the backend
    getSettings() {
      axios.get('/admin/settings')
        .then(response => {
          this.settings = response.data.data || {};  // Store the settings in the component state
          this.loading = false;  // Hide the loader when the data is loaded
        })
        .catch(error => {
          console.error("Error fetching settings:", error);
          toastr.error('Failed to load settings.');
          this.loading = false;  // Hide the loader even if there was an error
        });
    },

    // Handle the form submission
    handleSubmit() {
      this.submitting = true;  // Disable button when submitting
      axios.post('/admin/settings', this.settings)
        .then(response => {
          toastr.success('Settings updated successfully!');
          this.submitting = false;  // Enable button again after submission
        })
        .catch(error => {
          console.error("Error updating settings:", error);
          toastr.error('Failed to update settings.');
          this.submitting = false;  // Enable button again after submission
        });
    }
  }
};
</script>

<style scoped>
/* Custom styles for loader */
.spinner-border {
  width: 3rem;
  height: 3rem;
}
</style>
