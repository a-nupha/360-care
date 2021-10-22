<template>
    <div>
           <v-data-table
      :headers="headers"
      :items="dataScan"
      :loading="true"
      class="elevation-1"
    >
      <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
      <template slot="items" slot-scope="props">
        <td>{{ props.item.barcode }}</td>
        <td class="text-xs-center">{{ props.item.name }}</td>
        <td class="text-xs-center">{{ props.item.quantity_stock }}</td>
        <td><v-btn icon>
            <v-icon color="red" @click="deleteItem(props.item)">mdi-delete</v-icon>
            </v-btn></td>
      </template>
    </v-data-table>
    <!-- {{dataScan}} -->
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
        @click="deleteItemS()"
      >
        yes
      </v-btn></v-flex></v-layout>
  </v-snackbar>
    </div>
</template>
<script>
import { sync } from 'vuex-pathify'
// import controlData from './getApiData/controlData.js'
// import store from '../store/store'

export default {
  data() {
    return {
      timeout: 5000,
      Store: this.$store.state,
      msgSnackBar: '',
      snackฺฺฺBarBool: false,
      getdataTable: [],
      headers: [
        {
          text: 'Barcode',
          align: 'center',
          sortable: false,
          value: 'name',
        },
        {
          text: 'name', value: 'calories', align: 'center', sortable: false,
        },
        {
          text: 'QTY', value: 'calories', align: 'center', sortable: false,
        },
        {
          text: 'Delete', value: 'calories', align: 'center', sortable: false,
        },
      ],
    }
  },
  computed: {
    ...sync('*'),
  },
  created() {
    this.addIndex()
  },
  methods: {
    addIndex() {
      for (let i = 0; i < this.Store.dataScan.length; i += 1) {
        this.$set(this.Store.dataScan, i, { ...this.Store.dataScan[i], index: i })
      }
    },
    deleteItem(item) {
      this.getdataTable = item
      this.msgSnackBar = 'Are you sure you want to delete this item?'
      this.snackฺฺฺBarBool = true
    },
    deleteItemS() {
      const index = this.Store.dataScan.indexOf(this.getdataTable)
      this.Store.dataScan.splice(index, 1)
      this.snackฺฺฺBarBool = false
    },
  },

}

</script>
