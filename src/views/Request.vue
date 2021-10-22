<template>
<div>
    <v-content>
        <v-container>
            <v-layout align-center justify-center>
                <v-flex class="grey lighten-4">
                    <v-container>
                        <v-card flat>
                            <div>
                                <v-toolbar flat color="white">
                                    <v-toolbar-title>
                                        <v-flex xs12 subheader class="blue--text" ma-1>
                                            Items has a problem
                                        </v-flex>
                                    </v-toolbar-title>
                                    <v-divider class="mx-2" inset vertical></v-divider>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-data-table :headers="headers"
                                :items="desserts" class="elevation-1">
                                    <template slot="items" slot-scope="props">
                                        <td class="text-xs-center">{{ props.item.barcode }}</td>
                                        <td class="text-xs-center">{{ props.item.status }}</td>
                                        <td class="text-xs-center">{{ props.item.total }}</td>
                                        <td class="text-xs-center">
                                            <v-btn icon>
                                            <v-icon color="green"
                                            @click="Confirm(props.item)">mdi-check</v-icon>
                                            </v-btn>
                                        </td>
                                        <td class="text-xs-center">
                                          <v-btn icon>
                                            <v-icon color="red"
                                            @click="deleteItem(props.item)">mdi-delete</v-icon>
                                            </v-btn>
                                        </td>
                                    </template>
                                </v-data-table>
                            </div>
                        </v-card>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    <!-- <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-toolbar dark color="blue">
            <v-btn slot="activator" color="blue" dark class="mb-2">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn dark flat @click="dialog = false;save()">Save</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 sm6 md4>
                            <v-text-field disabled
                            v-model="editedItem.Barcode" label="Barcode"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field disabled
                            v-model="editedItem.calories" label="Branch"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field disabled
                            v-model="editedItem.fat" label="Status"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedItem.carbs" label="Quanity"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field disabled
                            v-model="editedItem.protein" label="Name"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog> -->
    <v-snackbar
    :vertical="true"
    v-model="snackฺฺฺBarBool"
    color="orange"
    :timeout="timeout"
    bottom>
    <v-flex >{{msgSnackBar}}</v-flex>
    <v-layout><v-flex><v-btn
        color="white"
        flat
        @click="snackฺฺฺBarBool = false "
      >
        no
      </v-btn></v-flex>
    <v-flex><v-btn
        color="white"
        flat
        @click="ApproveItems()"
      >
        yes
      </v-btn></v-flex></v-layout>
  </v-snackbar>

  <v-snackbar
    :vertical="true"
    v-model="snackฺฺฺBarBoolError"
    color="orange"
    :timeout="timeout"
    bottom>
    <v-flex >{{msgSnackBar}}</v-flex>
    <v-layout><v-flex><v-btn
        color="white"
        flat
        @click="snackฺฺฺBarBoolError = false "
      >
        no
      </v-btn></v-flex>
    <v-flex><v-btn
        color="white"
        flat
        @click="deleteItemS()"
      >
        yes
      </v-btn></v-flex></v-layout>
  </v-snackbar>
  <!-- {{getdataTable}} -->
</div>
</template>

<script>
import moment from 'moment'

import {
  mapActions,
} from 'vuex'
import Axios from 'axios';
import {
  sync,
} from 'vuex-pathify'
import store from '../store/store'
import functions from '../plugins/functions'

export default {
  name: 'Request',
  components: {
    // tab,
  },
  data() {
    return {
      getdataTable: [],
      nowDate: functions.moment(moment().format('YYYYMMDD')),
      time: moment().format('hmmss'),
      snackฺฺฺBarBoolError: false,
      Store: this.$store.state,
      timeout: 5000,
      confirm: false,
      snackฺฺฺBarBool: '',
      msgSnackBar: '',
      dialog: false,
      headers: [{
        text: 'Barcode',
        align: 'center',
        sortable: false,
        value: 'name',
      },
      {
        text: 'Status',
        value: 'fat',
        sortable: false,
        align: 'center',
      },
      {
        text: 'Qty',
        value: 'protein',
        align: 'center',
        sortable: false,
      },
      {
        text: 'Approved',
        value: 'name',
        sortable: false,
        align: 'center',
      },
      {
        text: 'Delete',
        value: 'name',
        sortable: false,
        align: 'center',
      },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
    }
  },
  computed: {
    ...sync('*'),
  },
  watch: {
    // dialog(val) {
    //   val || this.close()
    // },
  },

  async created() {
    await this.getdataReq()
  },
  methods: {
    ...mapActions({
      // SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),
    async getdataReq() {
      console.log('data login', store.state.dataLogin[0].rcode_id)
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/getDataItemsApp.php';
      const params = new URLSearchParams();
      params.append('branch_id', Number(store.state.dataLogin[0].rcode_id))
      const response = await Axios.post(api, params)
      console.log('response', response.data)
      this.desserts = response.data
    },
    Confirm(item) {
      console.log('=====>', item)
      const rcodeid = Number(store.state.dataLogin[0].rcode_id)
      this.getdataTable = item
      console.log('00000000000', item.status)
      console.log('test', store.state.dataLogin[0])
      this.$set(this.getdataTable, 'add_date', functions.moment(moment().format('YYYYMMDD')))
      this.$set(this.getdataTable, 'add_time', moment().format('hmmss'))
      this.$set(this.getdataTable, 'branch_id', rcodeid)
      this.$set(this.getdataTable, 'quantity', item.total)
      this.$set(this.getdataTable, 'status_id', item.status)
      this.$set(this.getdataTable, 'pid_user', store.state.dataLogin[0].pid)
      this.$set(this.getdataTable, 'pid_approve', store.state.dataLogin[0].pid)
      this.$set(this.getdataTable, 'approve_id', 'ไม่ปกติ')
      this.$set(this.getdataTable, 'remark', ' ')
      console.log('getdataTable', this.getdataTable)
      this.msgSnackBar = 'Are you sure you want to Approved this item?'
      this.snackฺฺฺBarBool = true
    },
    deleteItem(item) {
      this.getdataTable = item
      console.log(this.getdataTable.length)
      this.getdataTable = item
      console.log('test', store.state.dataLogin[0])
      const rcodeid = Number(store.state.dataLogin[0].rcode_id)
      this.$set(this.getdataTable, 'add_date', functions.moment(moment().format('YYYYMMDD')))
      this.$set(this.getdataTable, 'add_time', moment().format('hmmss'))
      this.$set(this.getdataTable, 'branch_id', rcodeid)
      this.$set(this.getdataTable, 'quantity', item.total)
      this.$set(this.getdataTable, 'status_id', item.status)
      this.$set(this.getdataTable, 'pid_user', store.state.dataLogin[0].pid)
      this.$set(this.getdataTable, 'pid_approve', store.state.dataLogin[0].pid)
      this.$set(this.getdataTable, 'approve_id', 'ไม่ปกติ')
      this.$set(this.getdataTable, 'remark', ' ')
      console.log('getdataTable', this.getdataTable)
      this.msgSnackBar = 'Are you sure you want to delete this item?'
      this.snackฺฺฺBarBoolError = true
    },
    deleteItemS() {
      const index = this.desserts.indexOf(this.getdataTable)
      this.desserts.splice(index, 1)
      this.deleteItemData()
      this.snackฺฺฺBarBool = false
    },
    ApproveItems() {
      console.log(this.getdataTable)
      const index = this.desserts.indexOf(this.getdataTable)
      this.desserts.splice(index, 1)
      console.log('desserts', this.desserts)
      this.appProve()
      this.snackฺฺฺBarBool = false
    },
    async appProve() {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/insertItemApp.php';
      // const fromData = new FormData();
      const Empparams = new URLSearchParams();
      const az = JSON.stringify(this.getdataTable)
      console.log(az)
      Empparams.append('data_approve', az)
      await Axios.post(api, Empparams)
        .then((response) => {
          console.log(response.data);
        })
    },
    async deleteItemData() {
      console.log('test')
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/DeleteAppProveItems.php';
      // const fromData = new FormData();
      const Empparams = new URLSearchParams();
      const az = JSON.stringify(this.getdataTable)
      Empparams.append('data_approve', az)
      await Axios.post(api, Empparams)
        .then((response) => {
          console.log(response.data);
        })
    },
    close() {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.desserts.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>

<style>
.theme--light .v-datatable thead th.column,
.theme--light .v-datatable thead th.column.sortable.active,
.theme--light .v-datatable thead th.column.sortable:hover,
.theme--light .v-datatable thead th.column.sortable.active i {
    color: white;
    background-color: #0091ea;
    font-size: 16px;
}

.table.v-table thead td:not(:nth-child(1)),
table.v-table tbody td:not(:nth-child(1)),
table.v-table thead th:not(:nth-child(1)),
table.v-table tbody th:not(:nth-child(1)),
table.v-table thead td:first-child,
table.v-table tbody td:first-child,
table.v-table thead th:first-child,
table.v-table tbody th:first-child {
    padding: 0 7px;
    font-size: 13px;
}
</style>
