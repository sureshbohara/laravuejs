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

      <!-- Form to handle general settings -->
      <form @submit.prevent="handleSubmit">
        <div class="card-body">
          <div class="row">

            <!-- SMTP Settings Section -->
            <div class="col-12 col-lg-6">
              <div class="col-12 mb-3">
                <label for="mail_transport" class="form-label">Mail Transport</label>
                <input
                  type="text"
                  id="mail_transport"
                  name="mail_transport"
                  v-model="settings.mail_transport"
                  class="form-control"
                  placeholder="Mail Transport"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="mail_host" class="form-label">Mail Host</label>
                <input
                  type="text"
                  id="mail_host"
                  name="mail_host"
                  v-model="settings.mail_host"
                  class="form-control"
                  placeholder="Mail Host"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="mail_port" class="form-label">Mail Port</label>
                <input
                  type="text"
                  id="mail_port"
                  name="mail_port"
                  v-model="settings.mail_port"
                  class="form-control"
                  placeholder="Mail Port"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="mail_username" class="form-label">Mail Username</label>
                <input
                  type="text"
                  id="mail_username"
                  name="mail_username"
                  v-model="settings.mail_username"
                  class="form-control"
                  placeholder="Mail Username"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="mail_password" class="form-label">Mail Password</label>
                <input
                  type="password"
                  id="mail_password"
                  name="mail_password"
                  v-model="settings.mail_password"
                  class="form-control"
                  placeholder="Mail Password"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="mail_encryption" class="form-label">Mail Encryption</label>
                <input
                  type="text"
                  id="mail_encryption"
                  name="mail_encryption"
                  v-model="settings.mail_encryption"
                  class="form-control"
                  placeholder="Mail Encryption"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="mail_from" class="form-label">Mail From</label>
                <input
                  type="text"
                  id="mail_from"
                  name="mail_from"
                  v-model="settings.mail_from"
                  class="form-control"
                  placeholder="Mail From"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="mail_from_name" class="form-label">Mail From Name</label>
                <input
                  type="text"
                  id="mail_from_name"
                  name="mail_from_name"
                  v-model="settings.mail_from_name"
                  class="form-control"
                  placeholder="Mail From Name"
                />
              </div>

              <div class="col-12 mb-3">
                <label for="smtp_check" class="form-label">SMTP Check</label>
                <select
                  id="smtp_check"
                  name="smtp_check"
                  v-model="settings.smtp_check"
                  class="form-select"
                >
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>
            </div>

            <!-- SMTP Instructions Section -->
            <div class="col-12 col-lg-6">
              <h6 class="mb-4">SMTP Instructions</h6>
              <p class="text-danger">Please be careful when configuring SMTP. Incorrect configurations will result in errors when placing orders, registering new users, or sending newsletters.</p>
              <h6 class="text-muted">For Non-SSL:</h6>
              <ul class="list-group">
                <li class="list-group-item text-dark">Select "sendmail" for Mail Driver if you face any issue after configuring SMTP as Mail Driver.</li>
                <li class="list-group-item text-dark">Set Mail Host according to your server Mail Client Manual Settings.</li>
                <li class="list-group-item text-dark">Set Mail Port to 587.</li>
                <li class="list-group-item text-dark">Set Mail Encryption to "ssl" if you face issues with "tls".</li>
              </ul>
              <br>
              <h6 class="text-muted">For SSL:</h6>
              <ul class="list-group">
                <li class="list-group-item text-dark">Select "sendmail" for Mail Driver if you face any issue after configuring SMTP as Mail Driver.</li>
                <li class="list-group-item text-dark">Set Mail Host according to your server Mail Client Manual Settings.</li>
                <li class="list-group-item text-dark">Set Mail Port to 465.</li>
                <li class="list-group-item text-dark">Set Mail Encryption to "ssl".</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Form Footer -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm" :disabled="submitting || loading">Save & Update</button>
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
        { text: 'General Settings' },
      ],
      settings: {
        mail_transport: '',
        mail_host: '',
        mail_port: '',
        mail_username: '',
        mail_password: '',
        mail_encryption: '',
        mail_from: '',
        mail_from_name: '',
        smtp_check: '0',
      },
      loading: true,
      submitting: false,
    };
  },
  created() {
    this.fetchSettings();
  },
  methods: {
    fetchSettings() {
      axios.get('/admin/settings')
        .then(({ data }) => this.settings = data.data || {})
        .catch(() => toastr.error('Failed to load settings'))
        .finally(() => this.loading = false);
    },

    handleSubmit() {
      this.submitting = true;
      axios.post('/admin/settings', this.settings)
        .then(() => toastr.success('Settings updated successfully!'))
        .catch(() => toastr.error('Failed to update settings'))
        .finally(() => this.submitting = false);
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
