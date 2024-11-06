<template>
  <header class="top-header">
    <nav class="navbar navbar-expand">
      <div class="mobile-toggle-icon d-xl-none">
        <i class="bi bi-list"></i>
      </div>
      <div class="top-navbar-right ms-3 ms-auto">
        <ul class="navbar-nav align-items-center">
          <!-- Dark Mode Toggle -->
          <li class="nav-item dropdown dropdown-large">
            <a id="darkModeButton" class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="user-setting d-flex align-items-center gap-1">
                <img id="moonIcon" src="/images/noimage.png" class="user-img" alt="Light Mode">
                <div class="user-name d-none d-sm-block">Light</div>
              </div>
            </a>
          </li>
          <!-- View Website Link -->
          <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="" target="_blank">
              <div class="user-setting d-flex align-items-center gap-1">
                <img src="/images/noimage.png" class="user-img" alt="View Website">
                <div class="user-name d-none d-sm-block">View Website</div>
              </div>
            </a>
          </li>
          <!-- User Profile Dropdown -->
          <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="user-setting d-flex align-items-center gap-1">
                <img :src="user?.imageUrl || '/images/noimage.png'" class="user-img" alt="User Profile" />
                <div class="user-name d-none d-sm-block">{{ user?.name || 'Guest' }}</div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  <div class="d-flex align-items-center">
                    <img :src="user?.imageUrl || '/images/noimage.png'" class="rounded-circle" width="60" height="60" />
                    <div class="ms-3">
                      <h6 class="mb-0 dropdown-user-name">{{ user?.name || 'Guest' }}</h6>
                      <small class="mb-0 dropdown-user-designation text-secondary">{{ user?.role || 'Guest' }}</small>
                    </div>
                  </div>
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <router-link class="dropdown-item" :to="{ name: 'users.profile.update' }">
                  <div class="d-flex align-items-center">
                    <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                    <div class="setting-text ms-3"><span>Update Profile</span></div>
                  </div>
                </router-link>
              </li>
              <li>
                <router-link class="dropdown-item" :to="{ name: 'users.password.update' }">
                  <div class="d-flex align-items-center">
                    <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                    <div class="setting-text ms-3"><span>Change Password</span></div>
                  </div>
                </router-link>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="#" @click.prevent="logout">
                  <div class="d-flex align-items-center">
                    <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                    <div class="setting-text ms-3"><span>Logout</span></div>
                  </div>
                </a>
              </li>
            </ul>
          </li>
          <!-- Messages Notification -->
          <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="messages">
                <span class="notify-badge">2</span>
                <i class="bi bi-chat"></i>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0">
              <div class="p-2 border-bottom m-2">
                <h5 class="h5 mb-0">Return Orders</h5>
              </div>
              <div class="header-message-list p-2">
                <a class="dropdown-item" href="#">
                  <div class="d-flex align-items-center">
                    <img src="/images/noimage.png" alt="" class="rounded-circle" width="52" height="52">
                    <div class="ms-3 flex-grow-1">
                      <h6 class="mb-0 dropdown-msg-user">Suresh<span class="msg-time float-end text-secondary">2 m</span></h6>
                      <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Damage</small>
                    </div>
                  </div>
                </a>
              </div>
              <div class="p-2">
                <div><hr class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <div class="text-center">View All Notifications</div>
                </a>
              </div>
            </div>
          </li>
          <!-- Notifications -->
          <li class="nav-item dropdown dropdown-large d-none d-sm-block">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="notifications">
                <span class="notify-badge">4</span>
                <i class="bi bi-bell-fill"></i>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0">
              <div class="p-2 border-bottom m-2">
                <h5 class="h5 mb-0">Order Notifications</h5>
              </div>
              <div class="header-notifications-list p-2">
                <a class="dropdown-item" href="#">
                  <div class="d-flex align-items-center">
                    <div class="notification-box"><i class="bi bi-basket2-fill"></i></div>
                    <div class="ms-3 flex-grow-1">
                      <h6 class="mb-0 dropdown-msg-user">New Orders No. 00<span class="msg-time float-end text-secondary">6 hours ago</span></h6>
                      <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have received new orders</small>
                    </div>
                  </div>
                </a>
              </div>
              <div class="p-2">
                <div><hr class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <div class="text-center">View All Notifications</div>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
import axios from '../axios';
import toastr from 'toastr';

export default {
  name: 'AdminHeader',
  props: {
    user: {
      type: Object,
      default: () => ({}), // Provide a default empty object
    },
  },
  methods: {
    async logout() {
      try {
        const response = await axios.post('/admin/logout');
        localStorage.removeItem('admin_token');
        toastr.success(response.data.msg);
        this.$router.push({ name: 'admin.login' });
      } catch (error) {
        toastr.error('Logout failed');
      }
    },
  },
};
</script>

<style scoped>
/* Add your styles here if needed */
</style>
