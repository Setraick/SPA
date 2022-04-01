<template>
  <div class="sidebar" data-color="orange">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
      <a>
        <img src="/images/Kyntech_orange_on_White.png" />
      </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        <router-link tag="li" to="/dashboard" active-class="active">
          <a>
            <i class="now-ui-icons design_app"></i>
            <p>Dashboard</p>
          </a>
        </router-link>
        <router-link tag="li" to="/Search1" active-class="active">
          <a>
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>Search</p>
          </a> 
        </router-link>
        <li class="">
          <a href="http://localhost:8000/full-calender">
            <i class="now-ui-icons education_agenda-bookmark"></i>
            <p>Calendar</p>
          </a>
        </li>

        <li v-if="allowed" class="">
          <a href="http://localhost:8000/admin/users">
            <i class="now-ui-icons users_circle-08"></i>
            <p>Users</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data: ()=>({
    allowed:false,
  }),
  mounted(){
    axios.get("/allowed").then((res) => {
      this.allowed = res.data;
    });
  }
};
</script>

<style>
</style>