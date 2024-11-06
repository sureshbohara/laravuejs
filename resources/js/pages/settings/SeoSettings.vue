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
        <h6 class="mb-0 text-light">Update SEO Settings</h6>
      </div>

      <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
        <div class="card-body">
          <div class="row g-3">
            <!-- SEO Settings -->
            <div class="col-12">
              <div class="row">

                <div class="form-group mb-2">
                  <label for="meta_author" class="form-label">Meta Author</label>
                  <input
                    id="meta_author"
                    v-model="settings.meta_author"
                    type="text"
                    class="form-control"
                    placeholder="Enter meta author"
                    :class="{'is-invalid': errors.meta_author}"
                  />
                  <span class="form-text text-muted">Enter the name of the author or website owner.</span>
                  <div v-if="errors.meta_author" class="invalid-feedback">{{ errors.meta_author }}</div>
                </div>

                <div class="form-group mb-2">
                  <label for="meta_title" class="form-label">Meta Title</label>
                  <input
                    id="meta_title"
                    v-model="settings.meta_title"
                    type="text"
                    class="form-control"
                    placeholder="Enter meta title"
                    :class="{'is-invalid': errors.meta_title}"
                  />
                  <span class="form-text text-muted">This is the title of your page, shown in search engine results.</span>
                  <div v-if="errors.meta_title" class="invalid-feedback">{{ errors.meta_title }}</div>
                </div>

                <div class="form-group mb-2">
                  <label for="meta_keywords" class="form-label">Meta Keywords</label>
                  <input
                    id="meta_keywords"
                    v-model="settings.meta_keywords"
                    type="text"
                    class="form-control"
                    placeholder="Enter meta keywords"
                    :class="{'is-invalid': errors.meta_keywords}"
                  />
                  <span class="form-text text-muted">Add keywords separated by commas to describe your page content.</span>
                  <div v-if="errors.meta_keywords" class="invalid-feedback">{{ errors.meta_keywords }}</div>
                </div>

                <div class="form-group mb-2">
                  <label for="meta_description" class="form-label">Meta Description</label>
                  <textarea
                    id="meta_description"
                    v-model="settings.meta_description"
                    class="form-control"
                    placeholder="Enter meta description"
                    rows="5"
                    :maxlength="metaDescriptionMaxLength"
                    :class="{'is-invalid': errors.meta_description}"
                  ></textarea>
                  <span class="form-text text-muted">
                    Write a short description of your page content (under 160 characters).
                  </span>
                  <!-- Character count with warning if over limit -->
                  <div class="text-end mt-2">
                    <small :class="{'text-danger': metaDescriptionLength > metaDescriptionMaxLength}">
                      {{ metaDescriptionLength }} / {{ metaDescriptionMaxLength }} characters
                    </small>
                  </div>
                  <div v-if="errors.meta_description" class="invalid-feedback">{{ errors.meta_description }}</div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Footer with Submit Button -->
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary" :disabled="submitting || loading || isFormInvalid">
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
        { text: 'SEO Settings', link: null },
      ],
      settings: {
        meta_author: '',
        meta_title: '',
        meta_keywords: '',
        meta_description: '',
      },
      loading: true,
      submitting: false,
      errors: {},
      metaDescriptionMaxLength: 160,
    };
  },
  computed: {
    metaDescriptionLength() {
      return this.settings.meta_description.length;
    },
    isFormInvalid() {
      return this.metaDescriptionLength > this.metaDescriptionMaxLength || Object.keys(this.errors).length > 0;
    }
  },
  created() {
    this.getSettings();
  },
  methods: {
    getSettings() {
      axios.get('/admin/settings')
        .then(response => {
          this.settings = response.data.data || {};  // Safeguard in case data is not available
          this.loading = false;
        })
        .catch(error => {
          console.error("Error fetching settings:", error);
          toastr.error('Failed to load settings. Please try again.');
          this.loading = false;
        });
    },

    validateForm() {
      this.errors = {};
      if (!this.settings.meta_author) this.errors.meta_author = "Meta Author is required.";
      if (!this.settings.meta_title) this.errors.meta_title = "Meta Title is required.";
      if (!this.settings.meta_keywords) this.errors.meta_keywords = "Meta Keywords are required.";
      if (this.metaDescriptionLength === 0) {
        this.errors.meta_description = "Meta Description cannot be empty.";
      } else if (this.metaDescriptionLength > this.metaDescriptionMaxLength) {
        this.errors.meta_description = `Meta Description cannot exceed ${this.metaDescriptionMaxLength} characters.`;
      }
    },

    handleSubmit() {
      this.validateForm();

      if (Object.keys(this.errors).length === 0) {
        this.submitting = true;
        axios.post('/admin/settings', this.settings)
          .then(response => {
            toastr.success('Settings updated successfully!');
            this.submitting = false;
          })
          .catch(error => {
            console.error("Error updating settings:", error);
            toastr.error('Failed to update settings. Please try again.');
            this.submitting = false;
          });
      } else {
        toastr.warning('Please correct the errors in the form.');
      }
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

.invalid-feedback {
  display: block;
}
</style>
