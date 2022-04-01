<template>
  <div class="wrapper ">
    <Sidebar />
    <div class="main-panel" id="main-panel">
      <Navbar/>
      <div class="panel-header panel-header-sm">
      </div>
      <router-view />
      <footer class="footer">
        <div class=" container-fluid ">
        </div>
      </footer>
    </div>
  </div>
  
</template>

<script>
import Sidebar from './Sidebar.vue'
import Navbar from './Navbar.vue'
export default {
  
    components: { 
        Sidebar,
        Navbar,
    },
    name: "App",
}
</script>

<style scoped>
</style>