<template>
  <div>
    <a href="javascript:void(0);" class="back-to-top" @click="scrollToTop" aria-label="Back to Top">
      <i class='bx bxs-up-arrow-alt'></i>
    </a>
  </div>
</template>

<script>
export default {
  name: 'AdminFooter',
  methods: {
    scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }
}
</script>

<style scoped>

</style>
