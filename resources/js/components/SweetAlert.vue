<template>
  <div></div> 
</template>

<script>
import Swal from 'sweetalert2';

export default {
  methods: {
    async showConfirmation(title, text) {
      const result = await Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
      });
      return result.isConfirmed;
    },
    showToast(title, message, type) {
      Swal.fire({
        title: title,
        text: message,
        icon: type,
        timer: 2000,
        showConfirmButton: false,
      });
    },
  },
};
</script>
