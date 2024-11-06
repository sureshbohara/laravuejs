<template>
  <div class="wrapper">
    <Header :user="user" />
    <Sidebar />
    <main>
      <router-view :key="$route.path" />
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from '../components/AdminHeader.vue';
import Sidebar from '../components/AdminSidebar.vue';
import Footer from '../components/AdminFooter.vue';
import { AuthService } from '../services/auth'; 
import axios from '../axios';

export default {
  components: {
    Header,
    Sidebar,
    Footer,
  },
  data() {
    return {
      user: null, 
    };
  },
  methods: {
    async fetchUserProfile() {
      try {
        const response = await axios.get('/admin/profile');
        this.user = response.data.data;
      } catch (error) {
        console.error('Error fetching user profile:', error);
      }
    },
    logout() {
      AuthService.logout(); 
      this.$router.push({ name: 'admin.login' });
    },
  },
  created() {
    this.fetchUserProfile(); 
  },
}
</script>
