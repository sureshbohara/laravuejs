<template>
    <div class="col-12 col-lg-12">
        <div v-if="error" class="alert alert-danger" role="alert">{{ error }}</div>
        <div v-if="loading" class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <table v-if="!loading && !error" class="table align-middle table-striped">
            <thead>
                <tr>
                    <th>Profiles</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in userList" :key="user.id">
                    <td><img :src="user.imageUrl" width="50" height="50" class="img-circle" alt="Profile image of {{ user.name }}"/></td>
                    <td>{{ user.role }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>

                    <td>
                        <label class="switch">
                            <input
                                type="checkbox"
                                :checked="user.status === 1" 
                                @change="handleToggle(user)"
                            />
                            <span class="slider round"></span>
                        </label>
                    </td>

                    <td>
                        <div class="btn-group">

                            <router-link class="font-18 btn btn-success btn-sm text-light" :to="{ name: 'users.edit', params: { id: user.id }}">
                                <i class="bi bi-pencil"></i>
                            </router-link>

                            <button @click="confirmDelete(user.id)" class="btn btn-danger btn-sm">
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
import toastr from 'toastr';
import SweetAlert from '../../components/SweetAlert.vue';

export default {
    components: { SweetAlert },
    data() {
        return {
            userList: [],
            loading: true,
            error: null
        };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
        async fetchUsers() {
            try {
                const response = await axios.get('/admin/users');
                this.userList = response.data.data || [];
            } catch (error) {
                this.error = 'Failed to fetch users.';
            } finally {
                this.loading = false;
            }
        },

        async confirmDelete(id) {
            const confirmed = await this.$refs.sweetAlert.showConfirmation('Are you sure?', 'You won\'t be able to revert this!');
            if (confirmed) {
                await this.deleteUser(id);
            }
        },
        
        async deleteUser(id) {
            try {
                await axios.delete(`/admin/users/delete/${id}`);
                this.userList = this.userList.filter(user => user.id !== id);
                this.$refs.sweetAlert.showToast('Deleted!', 'User deleted successfully.', 'success');
            } catch (error) {
                this.$refs.sweetAlert.showToast('Error!', 'Failed to delete user.', 'error');
            }
        },

        async handleToggle(user) {
            const newStatus = user.status === 1 ? 0 : 1;
            user.status = newStatus;
            
            try {
                const response = await axios.post(`/admin/status/users/${user.id}`, { status: newStatus });
                user.status = response.data.data.status;
                this.$refs.sweetAlert.showToast('Updated!', 'User status updated successfully.', 'success');
            } catch (error) {
                user.status = newStatus === 1 ? 0 : 1; 
                this.$refs.sweetAlert.showToast('Error!', 'Failed to update user status.', 'error');
            }
        }
    }
};
</script>

<style scoped>
</style>
