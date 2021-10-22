<template>
<div>
    <v-card >
    <v-layout md12>
      <v-flex xs12>
        <v-tabs
        color="blue lighten-1"
        dark
        slider-color="yellow"
          v-model="active">
          <v-tab :key="'Barnch'"  >
            CONFIG
          </v-tab>
           <v-tab-item :key="'Barnch'">
            <Branch/>
          </v-tab-item>
          <v-tab :key="'Scan'" >
            SCAN
          </v-tab>
             <v-tab-item :key="'Scan'">
            <Scan v-if="active==1"/>
          </v-tab-item>
          <v-tab :key="'Syn'">
            ITEM
          </v-tab>
            <v-tab-item :key="'Syn'">
            <Syn v-if="active==2"/>
          </v-tab-item>
        </v-tabs>
      </v-flex >

    </v-layout>
    <v-flex><v-btn dark large @click="next()" block color="blue" >{{button}}</v-btn></v-flex>
     <v-dialog v-model="openDialog" persistent max-width="400px">
        <v-card>
          <v-flex>
          <v-card-title
          :class="'green'"
          primary-title
          flat>
          <v-icon class="mr-3" color="white">mdi-information</v-icon>
          <v-flex class=""><v-flex class="white--text">INFORMATION</v-flex></v-flex>
        </v-card-title>
          <v-card-title>
            <v-layout justify-center><span>{{msg}}</span></v-layout>
          </v-card-title>
          </v-flex>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="setMenuRequest()">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

    </v-card>
  </div>
</template>
<script>
import {
  mapActions,
} from 'vuex'
import Axios from 'axios';
import Scan from './Scan.vue'
import Branch from './Branch.vue'
import Syn from './Syn.vue'

// import controlData from './getApiData/controlData'


export default {
  name: 'tab',
  data() {
    return {
      openDialog: false,
      active: 0,
      button: 'ถัดไป',
      Store: this.$store.state,
      msg: '',
      color: '',
    }
  },
  components: {
    Scan,
    Branch,
    Syn,

  },
  watch: {
    active() {
      if (Number(this.active) === 2) {
        this.button = 'SAVE'
      } else {
        this.button = 'NEXT'
      }
    },
  },
  methods: {
    ...mapActions({
      SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),
    setMenuRequest() {
      const menu = 'Menu'
      this.setDataLogin(menu);
      this.Store.dataScan = []
    },
    insert() {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/Edit_20190405.php';
      const dataParams = new URLSearchParams();
      const dataInsert = JSON.stringify(this.Store.dataScan)
      console.log('this.Store.dataScan', this.Store.dataScan)
      dataParams.append('dataInsert', dataInsert)
      Axios.post(api, dataParams)
        .then((response) => {
          console.log('-=-=-==-')
          console.log(response.data)
          this.insertsuccess = response.data
          if (Boolean(this.insertsuccess) === true) {
            // alert('สำเร็จ')
            this.msg = 'success'
            this.color = 'green'
            this.openDialog = true
          } else {
            this.msg = 'unsuccessful'
            this.color = 'red'
            this.openDialog = true
          }
        })
    },
    next() {
      const active = Number(this.active);
      if (Number(this.active === 2)) {
        this.insert()
      } else {
        this.active = active + 1;
      }
    },
  },
}
</script>
