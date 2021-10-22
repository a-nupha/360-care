<template>
  <div>
    <div>
    <v-flex>
    </v-flex></div>
                <v-subheader>date in</v-subheader>
              <v-flex xs5 md2>
                <v-layout justify-start>
        <GlobalDate :value.sync="Store.aDateIn" />

                </v-layout>
      </v-flex>
        <v-subheader>date out</v-subheader>
              <v-flex xs5 md2>
        <GlobalDate :value.sync="Store.aDateOut" />
      </v-flex>
      <v-flex ma-1>
        <v-layout>
          <v-flex xs5>

            <v-btn dark color="blue" @click="getdataReport()">submit
        </v-btn>
          </v-flex>
      </v-layout>
      </v-flex>
    <v-flex v-if="this.chart == true">
    <donut-chart
      id="donut"
      :data="donutData"
      colors='[ "#FF6384", "#36A2EB", "#FFCE56" ]'
      resize="true">
    </donut-chart>
    <cerprint/>
    </v-flex>
    <!-- {{dataTranIn}}
    =========================================-->
    <!-- {{dataStock}} -->

  </div>
</template>

<script>
import Raphael from 'raphael/raphael'
import Axios from 'axios';
import { sync } from 'vuex-pathify'
import { DonutChart } from 'vue-morris'
import cerprint from './cer.vue'
import store from '../store/store'


global.Raphael = Raphael

export default {
  name: 'VueChartJS',
  msgSnackBar: 'test',
  components: {
    cerprint,
    DonutChart,
  },
  data() {
    return {
      dataTranIn: [],
      dataStock: [],
      openDialog: true,
      chart: false,
      Store: this.$store.state,
      dialog: true,
      dataChat: [],
      donutData: [
        { label: 'Input', value: 50 },
        { label: 'Output', value: 40 },
        { label: 'Stock', value: 40 },
        
      ],
    }
  },
  watch: {
  },
  computed: {
    ...sync('*'),
  },
  methods: {
    test() {
      this.chart = true
    },
    async getdataReport() {
      this.chart = true
      const apiStock = 'https://a-nuphasupit58.000webhostapp.com/php/getdataReportStock.php';
      const paramsStock = new URLSearchParams();
      paramsStock.append('branch_id', Number(store.state.dataLogin[0].rcode_id))
      paramsStock.append('date_in', this.Store.aDateIn)
      paramsStock.append('date_out', this.Store.aDateOut)
      const responseStock = await Axios.post(apiStock, paramsStock)
      this.Store.dataStock = responseStock.data
      // console.log()
      console.log('----Get_API--STOCK---', responseStock.data)

      const api = 'https://a-nuphasupit58.000webhostapp.com/php/getdataReportChat.php';
      const params = new URLSearchParams();
      params.append('branch_id', Number(store.state.dataLogin[0].rcode_id))
      params.append('date_in', this.Store.aDateIn)
      params.append('date_out', this.Store.aDateOut)
      const response = await Axios.post(api, params)
      this.dataChat = response.data
      console.log(this.dataChat)
      console.log(this.dataChat[0].SUM_IN)
      console.log(this.dataChat[0].SUM_OUT)
      console.log(this.dataChat[0].sum_stock)
      this.donutData[0].value = this.dataChat[0].SUM_IN
      this.donutData[1].value = this.dataChat[0].SUM_OUT
      this.donutData[2].value = this.dataChat[0].sum_stock
      this.Store.output = this.dataChat[0].SUM_IN
      this.Store.Input = this.dataChat[0].SUM_OUT
      this.Store.Stock = this.dataChat[0].sum_stock
    },
  },
}
</script>

<style scoped>
  ul {
    list-style-type: none;
    padding: 0;
  }

  li {
    display: inline-block;
    margin: 0 10px;
  }

  a {
    color: #42b983;
  }
</style>
