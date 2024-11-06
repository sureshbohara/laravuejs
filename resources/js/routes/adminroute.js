import { createRouter, createWebHistory } from 'vue-router';
import AdminLayout from '../layouts/AdminLayout.vue';
import AdminLogin from '../pages/auth/AdminLogin.vue';
import UserProfile from '../pages/auth/UserProfile.vue';
import UserPassword from '../pages/auth/UserPassword.vue';
import Dashboard from '../pages/auth/Dashboard.vue';
import NotFound from '../pages/auth/NotFound.vue';
import { AuthService } from '../services/auth';
// user pages
import UserIndex from '../pages/users/UserIndex.vue';
import CreateUser from '../pages/users/CreateUser.vue'; 
import EditUser from '../pages/users/EditUser.vue';

 // permissions pages
import PermissionsIndex from '../pages/permissions/PermissionsIndex.vue';
import PermissionsCreate from '../pages/permissions/PermissionsCreate.vue'; 
import PermissionsEdit from '../pages/permissions/PermissionsEdit.vue';

import GeneralSettings from '../pages/settings/GeneralSettings.vue';
import SeoSettings from '../pages/settings/SeoSettings.vue';
import SmtpSettings from '../pages/settings/SmtpSettings.vue';
import MediaSettings from '../pages/settings/MediaSettings.vue';

const routes = [
  { 
    path: '/admin', 
    component: AdminLogin, 
    name: 'admin.login' 
  },
  {
    path: '/admin',
    component: AdminLayout,
    meta: { requiresAuth: true },
    children: [
      { path: 'dashboard', component: Dashboard, name: 'admin.dashboard' },
      { path: 'users', component: UserIndex, name: 'users.index' },
      { path: 'users/create', component: CreateUser, name: 'users.create' },
      { path: 'users/edit/:id', component: EditUser, name: 'users.edit' } ,
      { path: 'users/profile/update', component: UserProfile, name: 'users.profile.update' },
      { path: 'users/password/update', component: UserPassword, name: 'users.password.update' },

      // permissions
      { path: 'permissions', component: PermissionsIndex, name: 'permissions.index' },
      { path: 'permissions/create', component: PermissionsCreate, name: 'permissions.create' },
      { path: 'permissions/edit/:id', component: PermissionsEdit, name: 'permissions.edit' },
      //settings 
      { path: 'settings/general', component: GeneralSettings, name: 'settings.general' },
      { path: 'settings/seo', component: SeoSettings, name: 'settings.seo' },
      { path: 'settings/smtp', component: SmtpSettings, name: 'settings.smtp' },
      { path: 'settings/media', component: MediaSettings, name: 'settings.media' },

    ]
  },
  { path: '/admin/:catchAll(.*)', component: NotFound }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Navigation guard to check authentication
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !AuthService.isAuthenticated()) {
    next({ name: 'admin.login' });
  } else {
    next();
  }
});

export default router;
