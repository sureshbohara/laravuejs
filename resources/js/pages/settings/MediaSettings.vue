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
        <h6 class="mb-0 text-light">Update Media Settings</h6>
      </div>

      <!-- Form to handle media settings -->
      <form @submit.prevent="handleSubmit" enctype="multipart/form-data" ref="form">
        <div class="card-body row">
          <!-- Favicon -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="favicon" class="form-label">WEBSITE FAVICON</label>
                  <img 
                    :src="settings.favicon ? '/storage/images/' + settings.favicon : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="favicon" 
                  name="favicon" 
                  ref="favicon" 
                />
              </div>
            </div>
          </div>

          <!-- Logo -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="logo" class="form-label">WEBSITE LOGO</label>
                  <img 
                    :src="settings.logo ? '/storage/images/' + settings.logo : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="logo" 
                  name="logo" 
                  ref="logo" 
                />
              </div>
            </div>
          </div>

          <!-- Loader Image -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="loader" class="form-label">WEBSITE LOADER</label>
                  <img 
                    :src="settings.loader ? '/storage/images/' + settings.loader : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="loader" 
                  name="loader" 
                  ref="loader" 
                />
              </div>
            </div>
          </div>

          <!-- Background Image -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="bg_image" class="form-label">LOGIN PAGE BACKGROUND</label>
                  <img 
                    :src="settings.bg_image ? '/storage/images/' + settings.bg_image : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="bg_image" 
                  name="bg_image" 
                  ref="bg_image" 
                />
              </div>
            </div>
          </div>

          <!-- Image 1 (Upcoming Departures) -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="image1" class="form-label">Upcoming Departures</label>
                  <img 
                    :src="settings.image1 ? '/storage/images/' + settings.image1 : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="image1" 
                  name="image1" 
                  ref="image1" 
                />
              </div>
            </div>
          </div>

          <!-- Image 2 (First Parallax) -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="image2" class="form-label">First Parallax</label>
                  <img 
                    :src="settings.image2 ? '/storage/images/' + settings.image2 : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="image2" 
                  name="image2" 
                  ref="image2" 
                />
              </div>
            </div>
          </div>

          <!-- Image 3 (Second Parallax) -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="image3" class="form-label">Second Parallax</label>
                  <img 
                    :src="settings.image3 ? '/storage/images/' + settings.image3 : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="image3" 
                  name="image3" 
                  ref="image3" 
                />
              </div>
            </div>
          </div>

          <!-- Image 4 (Blogs Page) -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="image4" class="form-label">Blogs Page</label>
                  <img 
                    :src="settings.image4 ? '/storage/images/' + settings.image4 : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="image4" 
                  name="image4" 
                  ref="image4" 
                />
              </div>
            </div>
          </div>

          <!-- Image 5 (About Us Page) -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="image5" class="form-label">About Us Page</label>
                  <img 
                    :src="settings.image5 ? '/storage/images/' + settings.image5 : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="image5" 
                  name="image5" 
                  ref="image5" 
                />
              </div>
            </div>
          </div>

          <!-- Image 6 (Our Team Page) -->
          <div class="col-12 col-lg-3 mb-3">
            <div class="card shadow-none bg-light border">
              <div class="card-body">
                <div class="col-12 mb-3">
                  <label for="image6" class="form-label">Our Team Page</label>
                  <img 
                    :src="settings.image6 ? '/storage/images/' + settings.image6 : '/images/noimage.png'" 
                    class="image-preview"
                  />
                </div>
              </div>
              <div class="card-footer">
                <input 
                  type="file" 
                  id="image6" 
                  name="image6" 
                  ref="image6" 
                />
              </div>
            </div>
          </div>
        </div>

        <!-- Form Footer -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm" :disabled="submitting">Save & Update</button>
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
        { text: 'Media Settings' },
      ],
      settings: {},   // Store the current settings
      loading: true,   // Flag to show loader until data is loaded
      submitting: false, // Flag to disable button while submitting
    };
  },
  created() {
    this.fetchSettings();  // Fetch the settings when the component is created
  },
  methods: {
    // Fetch the existing settings from the backend
    fetchSettings() {
      axios.get('/admin/settings')
        .then(({ data }) => {
          this.settings = data.data || {};  // Populate the settings
        })
        .catch(() => toastr.error('Failed to load settings'))
        .finally(() => this.loading = false);  // Hide the loader
    },

    // Handle form submission
    handleSubmit() {
      this.submitting = true;  // Disable submit button during submission

      // Prepare FormData to include both form fields and file data
      const formData = new FormData();

      // Get files from form input using refs
      const fileInputs = [
        this.$refs.favicon,
        this.$refs.logo,
        this.$refs.loader,
        this.$refs.bg_image,
        this.$refs.image1,
        this.$refs.image2,
        this.$refs.image3,
        this.$refs.image4,
        this.$refs.image5,
        this.$refs.image6
      ];

      // Append each file (if selected) to FormData
      fileInputs.forEach(input => {
        if (input && input.files && input.files[0]) {
          formData.append(input.name, input.files[0]);
        } else {
          console.warn(`No file selected for ${input?.name}`);
        }
      });

      // Make the request with FormData
      axios.post('/admin/settings', formData)
        .then(() => toastr.success('Settings updated successfully!'))
        .catch(() => toastr.error('Failed to update settings'))
        .finally(() => this.submitting = false);  // Enable submit button again
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

/* Set a fixed height for all images */
.image-preview {
  width: 100%;
  height: 200px; /* Adjust to your preferred height */
  object-fit: cover; /* Ensure images cover the area without stretching */
}
</style>
