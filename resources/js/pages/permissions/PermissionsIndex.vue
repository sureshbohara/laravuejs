<template>
    <main class="page-content">
        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <div class="card mb-2">
            <div class="card-header d-flex align-items-center justify-content-between bg-custom">
                <h6 class="mb-0 text-light">System Users Permission</h6>
            </div>
            <div class="card-body">
                <PermissionTable :permissions="permissions" @permissionDeleted="fetchPermissions" />
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header d-flex align-items-center justify-content-between bg-custom">
                <h6 class="mb-0 text-light">Create System Users Permission</h6>
            </div>
            <PermissionsCreate @permissionCreated="fetchPermissions" />
        </div>
    </main>
</template>

<script>
import Breadcrumb from '../../components/Breadcrumb.vue';
import PermissionTable from './PermissionTable.vue';
import PermissionsCreate from './PermissionsCreate.vue';
import axios from '../../axios';
import toastr from 'toastr';

export default {
    components: { PermissionTable, PermissionsCreate, Breadcrumb },
    data() {
        return {
            breadcrumbs: [
                { text: 'Users', link: { name: 'users.index' } },
                { text: 'User Permission', link: null },
            ],
            permissions: [],  // Add permissions data property
        };
    },
    mounted() {
        this.fetchPermissions(); // Fetch permissions on mount
    },
    methods: {
        async fetchPermissions() {
            try {
                const response = await axios.get('/admin/permissions');
                this.permissions = response.data.data || [];
            } catch (error) {
                toastr.error(error.response?.data?.msg || 'Failed to fetch permissions.');
            }
        }
    }
};
</script>

<style scoped>
/* Add your styles here */
</style>
