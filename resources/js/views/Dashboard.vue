<template>
  <div class="content">
    <div class="row position-absolute" style="margin-top: -56px; width: 80%;">
      <div class="col-md-3">
        <div class="card card-chart">
          <div class="card-header">
            Average first reply time
          </div>
          <div class="card-body">
              <h3>{{new Date((somaReplyTime/calls.length)*1000).toISOString().substr(14,5)}} min</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-chart">
          <div class="card-header">
            Average full resolve time
          </div>
          <div class="card-body">
              <h3>{{new Date((somaDuration/calls.length)*1000).toISOString().substr(14,5)}} min</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="padding-top: 96px;">
      <div class="col-md-12">
            <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">{{queue}}</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <button v-for="q in queues" :key="q" :value="q" class="dropdown-item" @click="queue = q" >{{q}}</button>
                <!-- <button value="total" class="dropdown-item" @click="queue = 'total'" >Total</button> -->
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="card-footer">
              <table class="table">
                    <thead class=" text-primary">
                      <th>
                        New
                      </th>
                      <th>
                        Open
                      </th>
                      <th>
                        Closed
                      </th>
                      <th>
                        Pending Reminder
                      </th>
                      <th class="text-right">
                        Total
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          {{ ticketsQueueStateNew }}
                        </td>
                        <td>
                          {{ ticketsQueueStateOpen }}
                        </td>
                        <td>
                          {{ ticketsQueueStateClose }}
                        </td>
                        <td>
                          {{ ticketsQueueStatePending }}
                        </td>
                        <td class="text-right">
                          {{ ticketsQueueStateTotal }}
                        </td>
                      </tr>                      
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Primeiro grafico -->
      <div class="col-lg-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Ticket Resolution {{queue2}}</h4>
          </div>
          <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <button v-for="q in queues" :key="q" :value="q" class="dropdown-item" @click="queue2 = q" >{{q}}</button>
                <button value="total" class="dropdown-item" @click="queue2 = 'total'" >Total</button>
              </div>
            </div>
          <pie-chart
            :data="[
              ['Opened Tickets', (resolutionPercentage[0]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],
              ['Resolved Tickets', (resolutionPercentage[1]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],
              ['New Tickets', (resolutionPercentage[2]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],
              ['Pending Reminder Tickets', (resolutionPercentage[3]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],              
            ]"
          >
          </pie-chart>
          <br /><br />
        </div>
      </div>
      <!-- Segundo grafico -->
      <div class="col-lg-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Ticket Overview Queue ({{stateType}})</h4>
          </div>
          <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <button v-for="s in stateTypes" :key="s" :value="s" class="dropdown-item" @click="stateType = s" >{{s}}</button>
              </div>
            </div>
          <column-chart 
            :data="TicketQueue.map(ticket=>[ticket.queue,ticket.total])">
          </column-chart>
          <br /><br />
        </div>
      </div>
      <!-- Extras -->
      <!-- <div class="col-lg-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Ticket Resolution {{queue2}}</h4>
          </div>
          <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <button v-for="q in queues" :key="q" :value="q" class="dropdown-item" @click="queue2 = q" >{{q}}</button>
                <button value="total" class="dropdown-item" @click="queue2 = 'total'" >Total</button>
              </div>
            </div>
          <pie-chart
            :data="[
              ['Opened Tickets', (resolutionPercentage[0]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],
              ['Resolved Tickets', (resolutionPercentage[1]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],
              ['New Tickets', (resolutionPercentage[2]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],
              ['Pending Reminder Tickets', (resolutionPercentage[3]*100/(resolutionPercentage[0]+resolutionPercentage[1]+resolutionPercentage[2]+resolutionPercentage[3])).toFixed(1)],              
            ]"
          >
          </pie-chart>
          <br /><br />
        </div>
      </div> -->
      <!-- Tempo de chamada por cliente -->
      <div class="col-lg-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Tempo de chamada por cliente</h4>
          </div>
          <br>
          <line-chart :data="calls.map(call=>[call.collaborator,new Date((call.duration)*1000).toISOString().substr(14,5)])"> </line-chart>
        </div>
      </div>
      <!-- Satisfação do cliente -->
      <div class="col-lg-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Satisfação do cliente</h4>
          </div>
          <pie-chart
            :data="[
              ['bom', satisfaction[0]],
              ['mau', satisfaction[1]],
            ]"
          >
          </pie-chart>
          <br>
        </div>
      </div>
      <!-- Extra 2 Tickets resolvidos por dia -->
        <div class="col-lg-12">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Tickets solved per month</h4>
          </div>
          <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <button value="2020" class="dropdown-item" @click="ano = '2020'" >2020</button>
                <button value="2019" class="dropdown-item" @click="ano = '2019'" >2019</button>
                <button value="2018" class="dropdown-item" @click="ano = '2018'" >2018</button>
                <button value="2017" class="dropdown-item" @click="ano = '2017'" >2017</button>
                <button value="2016" class="dropdown-item" @click="ano = '2016'" >2016</button>
                <button value="2015" class="dropdown-item" @click="ano = '2015'" >2015</button>
                <button value="2014" class="dropdown-item" @click="ano = '2014'" >2014</button>
                <button value="2013" class="dropdown-item" @click="ano = '2013'" >2013</button>
                <button value="2012" class="dropdown-item" @click="ano = '2012'" >2012</button>
                <button value="2011" class="dropdown-item" @click="ano = '2011'" >2011</button>
                <button value="2010" class="dropdown-item" @click="ano = '2010'" >2010</button>
              </div>
            </div>
          <br>
          <line-chart :data="[
            ['January', (datascounts[0]-datascounts2[0])],
            ['February', (datascounts[1]-datascounts2[1])],
            ['March', (datascounts[2]-datascounts2[2])],
            ['April', (datascounts[3]-datascounts2[3])],
            ['May', (datascounts[4]-datascounts2[4])],
            ['June', (datascounts[5]-datascounts2[5])],
            ['July ', (datascounts[6]-datascounts2[6])],
            ['August', (datascounts[7]-datascounts2[7])],
            ['September', (datascounts[8]-datascounts2[8])],
            ['October', (datascounts[9]-datascounts2[9])],
            ['November', (datascounts[10]-datascounts2[10])],
            ['December', (datascounts[11]-datascounts2[11])],
          ]"> </line-chart>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: () => ({
    resolutionPercentage:[],
    satisfaction: [],
    ticketsQueueStateNew: null,
    ticketsQueueStateOpen: null,
    ticketsQueueStateClose: null,
    ticketsQueueStateTotal: null,
    ticketsQueueStatePending:null,
    queue2:'CORE',
    queues: null,
    queue:'CORE',
    stateType: 'new',
    stateTypes: null,
    calls: [],
    collaborators:null,
    duration:null,
    somaDuration: [],
    somaReplyTime: [],
    TicketQueue:[],
    datas:[],
    datascounts:[],
    datascounts2:[],
    tickets:[],
    ano:'2020',
  }),
  mounted() {
    this.updatequeue();
    this.updatequeue2();
    this.updatestate();
    this.updateano();
    axios.get("/satisfaction_score").then((res) => {
      this.satisfaction = res.data;
    });
    axios.get("/calls").then((res) => {
      this.calls = res.data;
    });
     axios.get("/somaDuration").then((res) => {
      this.somaDuration = res.data;
    });
    axios.get("/somaReplyTime").then((res) => {
      this.somaReplyTime = res.data;
    });
    axios.get("/queues").then((res) => {
      this.queues = res.data;
    });
    axios.get("/stateTypes").then((res) => {
      this.stateTypes = res.data;
    });
    axios.get("/collaborator").then((res) => {
      this.collaborators = res.data;
    });
    axios.get("/duration").then((res) => {
      this.duration = res.data;
    });
    axios.get("/data").then((res) => {
      this.datas = res.data;
    });
    axios.get("/dataCount/2021").then((res) => {
      this.datascounts = res.data;
    });
  },
  watch:{
    ano(){
      this.updateano();
    },
    queue(){
      this.updatequeue();
    },
    stateType(){
      this.updatestate();
    },
    queue2(){
      this.updatequeue2();
    },
  },
  methods: {
    updatestate(){
      axios.get("/TicketQueue/"+this.stateType).then((res) => {
        this.TicketQueue = res.data;
      });
    },
    updatequeue(){
      axios.get("/queueSate/"+this.queue+"/new").then((res) => {
        this.ticketsQueueStateNew = res.data;
      });
      axios.get("/queueSate/"+this.queue+"/open").then((res) => {
        this.ticketsQueueStateOpen = res.data;
      });
      axios.get("/queueSate/"+this.queue+"/closed").then((res) => {
        this.ticketsQueueStateClose = res.data;
      });
      axios.get("/queueSate/"+this.queue+"/pending reminder").then((res) => {
        this.ticketsQueueStatePending = res.data;
      });
      axios.get("/queueTotal/"+this.queue).then((res) => {
        this.ticketsQueueStateTotal = res.data;
      });
      
    },
    updateano(){
      axios.get("/dataCount/"+this.ano).then((res) => {
        this.datascounts2 = res.data;
      });
    },
    updatequeue2(){
      axios.get("/ResolutionScore/"+this.queue2).then((res) => {
      this.resolutionPercentage = res.data;
    });
    },
  },
};
</script>
    
<style>
</style>