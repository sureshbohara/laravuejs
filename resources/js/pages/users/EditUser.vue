<template>
    <main class="page-content">
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between bg-custom">
                <h6 class="mb-0 text-light">Edit System User</h6>
                <router-link :to="{ name: 'users.index' }" class="btn btn-default btn-sm">System User List</router-link>
            </div>

            <!-- Form for editing user details -->
            <form @submit.prevent="updateUser" enctype="multipart/form-data" v-if="!loading">
                <div class="card-body">
                    <div class="row g-3">
                        <!-- User Role Selection -->
                        <div class="col-md-4 col-6">
                            <label for="role_id" class="form-label">User Role <span class="text-danger">*</span></label>
                            <select id="role_id" class="form-select" v-model="user.role_id">
                                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                            </select>
                            <small v-if="errors.role_id" class="text-danger">{{ errors.role_id[0] }}</small>
                        </div>

                        <!-- User Name Input -->
                        <div class="col-md-4 col-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" v-model="user.name" required />
                            <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                        </div>

                        <!-- User Email Input -->
                        <div class="col-md-4 col-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control" v-model="user.email" required />
                            <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                        </div>

                        <!-- User Address Input -->
                        <div class="col-md-4 col-6">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input id="address" type="text" class="form-control" v-model="user.address" required />
                            <small v-if="errors.address" class="text-danger">{{ errors.address[0] }}</small>
                        </div>

                        <!-- User Phone Input -->
                        <div class="col-md-4 col-6">
                            <label for="mobile" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input id="mobile" type="tel" class="form-control" v-model="user.mobile" required />
                            <small v-if="errors.mobile" class="text-danger">{{ errors.mobile[0] }}</small>
                        </div>

                        <!-- Gender Selection -->
                        <div class="col-md-4 col-6">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select id="gender" class="form-select" v-model="user.gender" required>
                                <option value="" disabled>Select Option</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <small v-if="errors.gender" class="text-danger">{{ errors.gender[0] }}</small>
                        </div>

                        <!-- Social Media Links -->
                        <div class="col-md-4 col-6">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input id="facebook" type="text" class="form-control" v-model="user.facebook" placeholder="Facebook Link" />
                            <small v-if="errors.facebook" class="text-danger">{{ errors.facebook[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input id="instagram" type="text" class="form-control" v-model="user.instagram" placeholder="Instagram Link" />
                            <small v-if="errors.instagram" class="text-danger">{{ errors.instagram[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="whatsapp" class="form-label">WhatsApp</label>
                            <input id="whatsapp" type="text" class="form-control" v-model="user.whatsapp" placeholder="WhatsApp No." />
                            <small v-if="errors.whatsapp" class="text-danger">{{ errors.whatsapp[0] }}</small>
                        </div>

                        <!-- Profile Image Upload -->
                        <div class="col-md-4 col-6">
                            <label for="image" class="form-label">Profile Image</label>
                            <input id="image" type="file" class="form-control" @change="onFileChange" />
                            <small v-if="errors.image" class="text-danger">{{ errors.image[0] }}</small>
                        </div>

                        <!-- Current Profile Image -->
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Current Image</label>
                            <img :src="user.imageUrl" width="100" height="100" alt="User Image" class="preview" />
                        </div>

                        <!-- User Description -->
                        <div class="col-12">
                            <label for="info" class="form-label">Description</label>
                            <textarea id="info" class="form-control" v-model="user.info" rows="3" placeholder="User Description"></textarea>
                            <small v-if="errors.info" class="text-danger">{{ errors.info[0] }}</small>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="card-footer mt-2">
                    <button type="submit" class="btn bg-custom text-light" :disabled="isLoading">
                        <span v-if="isLoading">Updating...</span>
                        <span v-else>Save & Update</span>
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
                { text: 'Users', link: { name: 'users.index' } },
                { text: 'Update User Info', link: null },
            ],
            user: {},
            loading: true,
            errors: {},
            isLoading: false,
            roles: [], // To store user roles
            selectedFile: null, // For storing the selected file
        };
    },
    mounted() {
        const userId = this.$route.params.id; // Get user ID from route parameters
        if (userId) {
            this.fetchUser(userId); // Fetch user data
            this.fetchRoles(); // Fetch roles for the dropdown
        }
    },
    methods: {
        // Fetch user details by ID
        async fetchUser(id) {
            try {
                const response = await axios.get(`/admin/users/get/${id}`);
                this.user = response.data.data; // Populate user data
            } catch (error) {
                console.error('Failed to fetch user', error);
            } finally {
                this.loading = false; // Set loading to false
            }
        },
        // Fetch available roles
        async fetchRoles() {
            try {
                const response = await axios.get('/admin/roles');
                this.roles = response.data; // Populate roles
            } catch (error) {
                toastr.error('Failed to load user roles.');
            }
        },
        // Handle form submission for updating user
        async updateUser() {
            this.isLoading = true; // Show loading state
            this.errors = {}; // Clear previous errors

            const formData = new FormData();
            // Append user data to FormData
            for (const key in this.user) {
                if (this.user[key] !== undefined) {
                    formData.append(key, this.user[key]);
                }
            }

            // Append selected file if exists
            if (this.selectedFile) {
                formData.append('image', this.selectedFile);
            }

            try {
                await axios.post(`/admin/users/update/${this.user.id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                toastr.success('User updated successfully!'); // Success message
                this.$router.push({ name: 'users.index' }); // Redirect to user list
            } catch (error) {
                this.errors = error.response.data.errors || {}; // Capture errors
            } finally {
                this.isLoading = false; // Reset loading state
            }
        },
        // Handle file input change
        onFileChange(event) {
            this.selectedFile = event.target.files[0]; // Store the selected file
        }
    }
};
</script>

<style scoped>
.text-danger {
    font-size: 0.875em; /* Style for error messages */
}
</style>
