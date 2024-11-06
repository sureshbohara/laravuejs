<template>
  <form @submit.prevent="handleSubmit">
    <div class="card-body">
      <div class="col-12 col-lg-12 mb-2">
        <div class="row">
          <div class="form-group col-lg-12 col-12 mb-4">
            <label>User Role Type</label>
            <select v-model="selectedRole" class="form-control rounded-0 select2">
              <option value="">--- select role ---</option>
              <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
            </select>
          </div>

          <div class="form-group col-lg-12 col-12 mb-4">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th>
                    <i class="bi bi-unlock" aria-hidden="true"></i> Access || Select All 
                    <input type="checkbox" @change="toggleAllPermissions" v-model="selectAll" />
                  </th>
                  <th v-for="action in actions" :key="action">
                    <i class="bi" :class="getIconClass(action)"></i>
                    {{ ucfirst(action) }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in categories" :key="category">
                  <th scope="col">{{ ucfirst(category) }}</th>
                  <td v-for="action in actions" :key="action">
                    <input
                      type="checkbox"
                      :checked="permissions[category][action] === 1" 
                      @change="updatePermission(category, action, $event.target.checked)"
                    />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer bg-light">
      <button type="submit" class="btn btn-primary">Submit Data</button>
    </div>
  </form>
</template>

<script>
import axios from '../../axios';
import toastr from 'toastr';

export default {
  data() {
    return {
      roles: [],
      categories: ['user', 'role', 'permission', 'setting'],
      actions: ['add', 'edit', 'view', 'delete'],
      selectedRole: '',
      permissions: {},
      selectAll: false,
    };
  },
  created() {
    this.fetchRoles();
    this.initializePermissions();
  },
  methods: {
    async fetchRoles() {
      try {
        const response = await axios.get('/admin/roles');
        this.roles = response.data;
      } catch (error) {
        toastr.error('Failed to load user roles.');
      }
    },
    initializePermissions() {
      this.categories.forEach(category => {
        this.permissions[category] = {};
        this.actions.forEach(action => {
          this.permissions[category][action] = 0; // Initialize to 0
        });
      });
    },
    toggleAllPermissions() {
      this.categories.forEach(category => {
        this.actions.forEach(action => {
          this.permissions[category][action] = this.selectAll ? 1 : 0; // Set to 1 or 0
        });
      });
    },
    updatePermission(category, action, isChecked) {
      this.permissions[category][action] = isChecked ? 1 : 0; // Set to 1 or 0 based on checkbox state
    },
    async handleSubmit() {
      console.log('Submitting permissions:', this.permissions); // Debug log
      try {
        await axios.post('/admin/permissions', {
          role_id: this.selectedRole,
          permission: this.permissions,
        });
        toastr.success('Permissions saved successfully.');
        this.$emit('permissionCreated');
        this.initializePermissions(); // Reset permissions
        this.selectedRole = ''; // Reset selected role
        this.selectAll = false; // Reset select all
      } catch (error) {
        toastr.error(error.response?.data?.msg || 'Failed to save permissions.');
      }
    },
    ucfirst(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    },
    getIconClass(action) {
      switch (action) {
        case 'add':
          return 'bi-plus-circle';
        case 'edit':
          return 'bi-pencil';
        case 'view':
          return 'bi-eye';
        case 'delete':
          return 'bi-trash';
        default:
          return '';
      }
    },
  },
};
</script>

<style scoped>
/* Add any additional scoped styles here */
</style>
