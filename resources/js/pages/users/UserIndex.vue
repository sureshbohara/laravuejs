<template>
    <main class="page-content">

        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between bg-custom">
                <h6 class="mb-0 text-light"> System Users List </h6>
               <router-link :to="{ name: 'users.create' }" class="btn btn-default btn-sm">Create New User</router-link>
            </div>
            <div class="card-body">
                <UserTable />
            </div>
        </div>
    </main>
</template>

<script>
import Breadcrumb from '../../components/Breadcrumb.vue';
import UserTable from './UserTable.vue';
export default {
    components: { UserTable, Breadcrumb },
    data() {
        return {
            breadcrumbs: [
                { text: 'Users', link: { name: 'users.index' } },
                { text: 'User List', link: null },
            ],
        };
    },
};
</script>

<style scoped>
/* Add your styles here */
</style>
