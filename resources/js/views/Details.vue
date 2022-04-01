<template>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Details:Ticket{{ticket_id}}ID </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th>Ticket Number</th>
                  <th>Title</th>
                  <th>Created</th>
                  <th>Changed</th>
                  <th>State</th>
                  <th>Queue</th>
                  <th>Owner</th>
                  <th>Priority</th>
                  <th>Lock</th>
                  <th>Age</th>
                  <th>Responsible</th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      {{ tickets.ticket_number}}
                    </td>
                    <td>
                      {{ tickets.title }}
                    </td>
                    <td>
                      {{ tickets.created }}
                    </td>
                    <td>
                      {{ tickets.changed }}
                    </td>
                    <td>
                      {{ tickets.state_type }}
                    </td>
                    <td>
                      {{ tickets.queue }}
                    </td>
                    <td>
                      {{ tickets.owner }}
                    </td>
                    <td>
                      {{ tickets.priority }}
                    </td>
                    <td>
                      {{ tickets.lock }}
                    </td>
                    <td>
                      {{ ((tickets.age * 0.000116) / 10).toFixed(1) }} D.H
                    </td>
                    <td>
                      {{ tickets.responsible }}
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
export default {
  props:['id'],
  data: () => ({
    tickets: [],
  }),
    mounted() {
    axios.get('/details/'+ this.id).then((res) => {
      this.tickets = res.data;
    });

   }
};

</script>

<style>
</style>