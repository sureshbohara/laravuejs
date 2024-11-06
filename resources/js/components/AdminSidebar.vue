<template>
  <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
            <div>
              <img src="/images/noimage.png" class="logo-icon" alt="logo icon">
            </div>
            <div>
              <h4 class="logo-text">Larave-Vue</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
            </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">

            <li>
              <router-link :to="{ name: 'admin.dashboard' }">
                <div class="parent-icon"><i class="bi bi-speedometer2"></i>
                </div>
                <div class="menu-title">Main Dashboard</div>
              </router-link>
            </li>

            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-person"></i>
                </div>
                <div class="menu-title">System Users</div>
              </a>
              <ul>

                <li> 
                   <router-link :to="{ name: 'users.index' }">
                    <i class="bi bi-arrow-right-short"></i>
                     User List
                  </router-link>
                </li>

                <li>
                  <router-link :to="{ name: 'permissions.index' }">
                  <i class="bi bi-arrow-right-short"></i>
                  Permission
                </router-link>
                </li>

              </ul>
            </li>


             <li>
               <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-ui-checks"></i></div>
                <div class="menu-title">System Settings</div>
              </a>
              <ul>

                <li> 
                   <router-link :to="{ name: 'settings.general' }">
                    <i class="bi bi-arrow-right-short"></i>
                      General Settings
                  </router-link>
                 </li>


                  <li> 
                   <router-link :to="{ name: 'settings.seo' }">
                    <i class="bi bi-arrow-right-short"></i>
                      Seo Settings
                  </router-link>
                 </li>

                 <li> 
                   <router-link :to="{ name: 'settings.smtp' }">
                    <i class="bi bi-arrow-right-short"></i>
                      Smtp Settings
                  </router-link>
                 </li>

                 <li> 
                   <router-link :to="{ name: 'settings.media' }">
                    <i class="bi bi-arrow-right-short"></i>
                      Media Settings
                  </router-link>
                 </li>



              </ul>
            </li>

         
        
           
  
  
        
    
          </ul>

       </aside> 
</template>

<script>
export default {
  name: 'AdminSidebar',
}
</script>

<style scoped>
/* Add any additional styles here */
</style>
