<template>
    <div class="col-12 col-lg-12">
        <div v-if="error" class="alert alert-danger" role="alert">{{ error }}</div>
        <table v-if="!error" class="table align-middle table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in permissions" :key="data.id">
                    <td>{{ data.role }}</td>
                    <td>
                        <div class="btn-group">
                            <router-link class="font-18 btn btn-success btn-sm text-light" :to="{ name: 'permissions.edit', params: { id: data.id }}">
                                <i class="bi bi-pencil"></i>
                            </router-link>
                            <button @click="confirmDelete(data.id)" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <SweetAlert ref="sweetAlert" />
    </div>
</template>

<script>
import axios from '../../axios';
import SweetAlert from '../../components/SweetAlert.vue';
import toastr from 'toastr';

export default {
    components: { SweetAlert },
    props: {
        permissions: {  // Accept permissions as a prop
            type: Array,
            required: true
        }
    },
    data() {
        return {
            error: null,
        };
    },
    methods: {
        async confirmDelete(id) {
            const confirmed = await this.$refs.sweetAlert.showConfirmation('Are you sure?', 'You won\'t be able to revert this!');
            if (confirmed) {
                await this.deletePermission(id);
            }
        },
        async deletePermission(id) {
            try {
                await axios.delete(`/admin/permissions/${id}`);
                this.$refs.sweetAlert.showToast('Deleted!', 'Permission deleted successfully.', 'success');
                this.$emit('permissionDeleted'); // Emit event to refresh permissions in parent
            } catch (error) {
                this.$refs.sweetAlert.showToast('Error!', error.response?.data?.msg || 'Failed to delete permission.', 'error');
            }
        },
    }
};
</script>

<style scoped>
/* Add any additional scoped styles here */
</style>
