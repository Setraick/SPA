<template>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Search:</h4>
            <div class="float-right d-flex align-items-end">
              <button v-if="page>1" @click=" ()=>ready?page--:null" type="button" class="btn btn-round btn-outline-default btn-simple btn-icon no-caret">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
              </button>
              <h5 class="mx-2">{{page}}</h5>
              <button @click="()=>ready?page++:null" type="button" class="btn btn-round btn-outline-default btn-simple btn-icon no-caret">
                <i class="now-ui-icons arrows-1_minimal-right"></i>
              </button>
            </div>
            <br />
          <input type="text" v-model="search" placeholder="search titles" />
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th>Ticket Number</th>
                  <th>Title</th>
                  <th>State</th>
                  <th>Queue</th>
                  <th>Priority</th>
                </thead>
                <tbody>
                  <tr v-for="ticket in filteredTicket1" :key="ticket.id">
                    <td>
                      <a :href="`/Details/${ticket.ticket_id}`">{{
                        ticket.ticket_number
                      }}</a>
                    </td>
                    <td>
                      {{ ticket.title }}
                    </td>
                    <td>
                      {{ ticket.state_type }}
                    </td>
                    <td>
                      {{ ticket.queue }}
                    </td>
                    <td>
                      {{ ticket.priority }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Button from '../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue';
export default {
  components: { Button },
  data: () => ({
    search: "",
    page:1,
    ready: false,
    tickets: [],
  }),
  mounted() {
    this.loadpage();
  },
  watch:{
    page(){
      this.loadpage();
    },
    search(){
      this.loadpage();
    },
  },
  methods: {
    loadpage(){
      this.ready = false;
      axios.get("/ticket/"+(this.search==''?'*':this.search)+"?page="+this.page).then((res) => {
      this.tickets = res.data.data;
      this.page = res.data.current_page;
      this.ready = true;
    });
    },
  },
  computed: {
    filteredTicket1: function () {
      return this.tickets;
    },
  },
};
</script>

<style>
</style>