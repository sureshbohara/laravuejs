<template>
    <main class="page-content">
        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <div class="card mt-2">
            <div class="card-header d-flex align-items-center justify-content-between bg-custom">
                <h6 class="mb-0 text-light">Edit User Permissions</h6>
                <router-link :to="{ name: 'permissions.index' }" class="btn btn-default btn-sm">System Permission List</router-link>
            </div>
            <div class="card-body">
                <div v-if="error" class="alert alert-danger">{{ error }}</div>
                <form @submit.prevent="handleSubmit">
                    <div class="form-group">
                        <label>User Role Type</label>
                        <select v-model="selectedRole" class="form-control rounded-0 select2">
                            <option value="">--- select role ---</option>
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </select>
                    </div>

                    <div class="form-group" v-if="permissionsLoaded">
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
                                            :checked="permissions[category]?.[action] === 1"
                                            @change="updatePermission(category, action, $event.target.checked)"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer bg-light">
                        <button type="submit" class="btn btn-primary">Save & Update Data</button>
                    </div>
                </form>
            </div>
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
                { text: 'Users', link: { name: 'users.index' } },
                { text: 'Edit User Permission', link: null },
            ],
            permissions: {},
            roles: [],
            selectedRole: '',
            categories: ['user', 'role', 'permission', 'setting'],
            actions: ['add', 'edit', 'view', 'delete'],
            selectAll: false,
            error: null,
            permissionsLoaded: false,
        };
    },
    async mounted() {
        await this.fetchRoles();
        await this.fetchPermissions();
    },
    methods: {
        async fetchRoles() {
            try {
                const response = await axios.get('/admin/roles');
                this.roles = response.data;
            } catch (error) {
                this.error = 'Failed to load user roles.';
                console.error(this.error, error);
                toastr.error(this.error);
            }
        },
        async fetchPermissions() {
            try {
                const response = await axios.get(`/admin/permissions/${this.$route.params.id}`);
                this.permissions = response.data.permissions || {};
                this.selectedRole = response.data.role_id;
                this.permissionsLoaded = true;
                this.checkSelectAll();
            } catch (error) {
                this.error = error.response?.data?.msg || 'Failed to fetch permissions.';
                console.error(this.error, error);
                toastr.error(this.error);
            }
        },
        toggleAllPermissions() {
            const value = this.selectAll ? 1 : 0;
            this.categories.forEach(category => {
                if (!this.permissions[category]) {
                    this.$set(this.permissions, category, {});
                }
                this.actions.forEach(action => {
                    this.$set(this.permissions[category], action, value);
                });
            });
        },
        updatePermission(category, action, isChecked) {
            if (!this.permissions[category]) {
                this.$set(this.permissions, category, {});
            }
            this.$set(this.permissions[category], action, isChecked ? 1 : 0);
            this.checkSelectAll();
        },
        checkSelectAll() {
            this.selectAll = this.categories.every(category =>
                this.actions.every(action => this.permissions[category]?.[action] === 1)
            );
        },
        async handleSubmit() {
            try {
                await axios.put(`/admin/permissions/${this.$route.params.id}`, {
                    role_id: this.selectedRole,
                    permissions: this.permissions,
                });
                toastr.success('Permissions updated successfully.');
                this.$router.push({ name: 'permissions.index' });
            } catch (error) {
                toastr.error(error.response?.data?.msg || 'Failed to update permissions.');
                console.error('Update error:', error);
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
/* Add your styles here */
</style>
