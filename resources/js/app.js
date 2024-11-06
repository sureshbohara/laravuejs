import { createApp } from 'vue';
import App from './App.vue';
import router from './routes/adminroute'; 
import toastr from 'toastr'; 
import 'toastr/build/toastr.min.css'; 

// Toastr options
toastr.options = {
  closeButton: true,
  debug: false,
  newestOnTop: false,
  progressBar: true,
  positionClass: 'toast-top-right',
  preventDuplicates: false,
  timeOut: '5000', // 5 seconds
  extendedTimeOut: '1000',
  showEasing: 'swing',
  hideEasing: 'linear',
  showMethod: 'fadeIn',
  hideMethod: 'fadeOut',
};

createApp(App)
    .use(router)
    .mount('#app');
