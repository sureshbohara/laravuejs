<template>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin.dashboard' }">Dashboard</router-link>
                </li>
                
                <li class="breadcrumb-item" v-for="(item, index) in breadcrumbs" :key="index">
                    <router-link v-if="item.link" :to="item.link">{{ item.text }}</router-link>
                    <span v-else>{{ item.text }}</span>
                </li>
            </ol>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        breadcrumbs: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped>
/* Add your styles here */
</style>
