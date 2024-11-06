<template>
    <main class="page-content">
        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between bg-custom">
                <h6 class="mb-0 text-light">Create New System User</h6>
                <router-link :to="{ name: 'users.index' }" class="btn btn-default btn-sm">System User List</router-link>
            </div>
            <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-4 col-6">
                            <label for="role_id" class="form-label">User Role <span class="text-danger">*</span></label>
                            <select id="role_id" class="form-select" v-model="users.role_id">
                                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                            </select>

                            <small v-if="errors.role_id" class="text-danger">{{ errors.role_id[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" v-model="users.name" placeholder="Enter name" required />
                            <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control" v-model="users.email" placeholder="Enter email" required />
                            <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input id="password" type="password" class="form-control" v-model="users.password" placeholder="Enter password" required />
                            <small v-if="errors.password" class="text-danger">{{ errors.password[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input id="address" type="text" class="form-control" v-model="users.address" placeholder="Enter address" required />
                            <small v-if="errors.address" class="text-danger">{{ errors.address[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="mobile" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input id="mobile" type="text" class="form-control" v-model="users.mobile" placeholder="Enter phone number" required />
                            <small v-if="errors.mobile" class="text-danger">{{ errors.mobile[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select id="gender" class="form-select" v-model="users.gender" required>
                                <option value="" disabled>Select Option ===</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <small v-if="errors.gender" class="text-danger">{{ errors.gender[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input id="facebook" type="text" class="form-control" v-model="users.facebook" placeholder="Facebook Link" />
                            <small v-if="errors.facebook" class="text-danger">{{ errors.facebook[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input id="instagram" type="text" class="form-control" v-model="users.instagram" placeholder="Instagram Link" />
                            <small v-if="errors.instagram" class="text-danger">{{ errors.instagram[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="whatsapp" class="form-label">Whatsapp</label>
                            <input id="whatsapp" type="text" class="form-control" v-model="users.whatsapp" placeholder="Whatsapp No." />
                            <small v-if="errors.whatsapp" class="text-danger">{{ errors.whatsapp[0] }}</small>
                        </div>

                        <div class="col-md-4 col-6">
                            <label for="image" class="form-label">Profile Image</label>
                            <input id="image" type="file" class="form-control" @change="onFileChange" />
                            <small v-if="errors.image" class="text-danger">{{ errors.image[0] }}</small>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Current Image</label>
                            <img src="/images/noimage.png" width="100" height="100" alt="No Image" class="preview" />
                        </div>

                        <div class="col-12">
                            <label for="info" class="form-label">Description</label>
                            <textarea id="info" class="form-control" v-model="users.info" rows="3" placeholder="User Description"></textarea>
                            <small v-if="errors.info" class="text-danger">{{ errors.info[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer mt-2">
                    <button type="submit" class="btn bg-custom text-light" :disabled="isLoading">
                        <span v-if="isLoading">Saving...</span>
                        <span v-else>Save & Create</span>
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
    name: "CreateUser",
    components: { Breadcrumb },
    data() {
        return {
            breadcrumbs: [
                { text: 'Users', link: { name: 'users.index' } },
                { text: 'User Created', link: null },
            ],
            users: {
                name: "",
                email: "",
                password: "",
                address: "",
                mobile: "",
                gender: "",
                facebook: "",
                instagram: "",
                whatsapp: "",
                image: null,
                info: "",
                role_id: null
            },
            roles: [],
            isLoading: false,
            errors: {},
        };
    },
    created() {
        this.fetchRoles();
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
        onFileChange(event) {
            this.users.image = event.target.files[0];
            const preview = document.querySelector('.preview');
            if (preview && this.users.image) {
                preview.src = URL.createObjectURL(this.users.image);
            }
        },
        async handleSubmit() {
            this.isLoading = true;
            this.errors = {};

            const formData = new FormData();
            Object.keys(this.users).forEach(key => {
                if (key === 'image' && !this.users.image) {
                    return;
                }
                formData.append(key, this.users[key]);
            });

            try {
                const response = await axios.post('/admin/users/save', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                toastr.success(response.data.msg);
                this.resetForm();
                this.$router.push({ name: "users.index" });
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    toastr.error('An unexpected error occurred.');
                }
            } finally {
                this.isLoading = false;
            }
        },
        resetForm() {
            this.users = {
                name: "",
                email: "",
                password: "",
                address: "",
                mobile: "",
                gender: "",
                facebook: "",
                instagram: "",
                whatsapp: "",
                image: null,
                info: "",
                role_id: null
            };
        }
    }
}
</script>

<style scoped>
.text-danger {
    font-size: 0.875em;
}
</style>
