<template>
  <div class="not-found-container">
    <i class="bi bi-exclamation-triangle not-found-icon"></i>
    <h2>404 - Not Found</h2>
    <p>The page you are looking for does not exist.</p>
    <router-link :to="{ name: 'admin.login' }" class="admin-link text-white">
      <i class="bi bi-box-arrow-in-left"></i> Go to Admin Login
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>

<style scoped>
.not-found-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f8f9fa;
  text-align: center;
}

.not-found-icon {
  font-size: 5rem;
  color: red;
  margin-bottom: 1rem;
}

h2 {
  color: red;
  font-size: 3rem;
  margin: 0.5rem 0;
}

p {
  font-size: 1.5rem;
  margin: 1rem 0;
}

.admin-link {
  padding: 0.5rem 1rem;
  background-color: #007bff; 
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s;
}


</style>
