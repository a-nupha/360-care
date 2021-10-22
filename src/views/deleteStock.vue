<template>
  <div>
    <v-layout>
<v-layout>
  <v-flex >
  <v-flex >
 <v-btn
      large
      block
      color="blue-grey"
      class="white--text"
      @click="openQuagga()"
    >
      Scan
      <v-icon right dark>mdi-barcode-scan</v-icon>
    </v-btn>
    </v-flex>
    <v-toolbar flat color="white">
                                    <v-toolbar-title>
                                        <v-flex xs12 subheader class="blue--text" ma-1>
                                            sale
                                        </v-flex>
                                    </v-toolbar-title>
                                    <v-divider class="mx-2" inset vertical></v-divider>
                                    <v-spacer></v-spacer>
                                    <div v-if="dataScanOut != ''">
                                    <v-btn class="white--text" color="blue" @click="confirm()">confirm</v-btn>
                                    </div>
                                </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="dataScanOut"
      :loading="true"
      class="elevation-1"
    >
      <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
      <template slot="items" slot-scope="props">
        <td class="text-xs-center">{{ props.item.databarcode }}</td>
        <td class="text-xs-center">{{ props.item.name }}</td>
        <td class="text-xs-center">{{ props.item.quantity }}</td>
        <td><v-btn icon>
        <v-icon color="red" @click="deleteItem(props.item)">mdi-delete</v-icon>            </v-btn></td>
      </template>
    </v-data-table>
    </v-flex>
</v-layout>
    </v-layout>
<v-dialog v-model="dialogScan"  fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-toolbar dark color="blue">
            <v-btn icon dark @click="closeDialogScan()">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Settings</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn dark flat @click="putdata()" :disabled="!valid">Save</v-btn>
            </v-toolbar-items>
            </v-toolbar>
      <v-card>
        <v-card-text>
          <quagga-scanner v-if="!databarcode"
            :onDetected="logIt" class="videoo" :readerSize="readerSize" :readerType="'ean_reader'">
            <video class="videoo" ></video>
            </quagga-scanner>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-layout>
            <v-flex>
              <v-layout>
      <v-flex xs10>
        <v-text-field type="number" :disabled="disbleBtn" prepend-icon=" " label="Barcode" :counter="13" mask="#############" v-model="databarcode" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field :disabled="disbleBtn" prepend-icon=" " label="Name" v-model="nameItems" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
        <v-text-field prepend-icon=" " suffix="Piece" label="Qty" :counter="7" mask="#######" v-model="qty" :rules="rules" required/>
        </v-form>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-combobox
          v-model="select"
          :items="items"
          prepend-icon=" "
          label="Event"
        ></v-combobox>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-textarea prepend-icon=" " :disabled="disbleBtn" v-model="detailItems" box name="input-7-4" label="Description" auto-grow></v-textarea>
      </v-flex>
    </v-layout>
            </v-flex>
          </v-layout>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
            <v-layout justify-center><span>success</span></v-layout>
          </v-card-title>
          </v-flex>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="setMenuRequest()">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>





<v-dialog v-model="openDialogNotmatch" persistent max-width="400px">
        <v-card>
          <v-flex>
          <v-card-title
          :class="'red'"
          primary-title
          flat>
          <v-icon class="mr-3" color="white">mdi-information</v-icon>
          <v-flex class=""><v-flex class="white--text">INFORMATION</v-flex></v-flex>
        </v-card-title>
          <v-card-title>
            <v-layout justify-center><span>barcode is not match</span></v-layout>
          </v-card-title>
          </v-flex>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="setMenuRequest()">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>








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
import {
  mapActions,
} from 'vuex'
import Axios from 'axios';
import { toNumber } from 'lodash'
import moment from 'moment'
import {
  QuaggaScanner,
} from 'vue-quaggajs';
import Quagga from 'quagga';
import { sync } from 'vuex-pathify'
import functions from '../plugins/functions'
import controlData from './getApiData/controlData'

export default {
  data() {
    return {
      disbleBtn: false,
      nowDate: functions.moment(moment().format('YYYYMMDD')),
      valid: true,
      openDialogNotmatch: false,
      nameItems: '',
      timeout: 5000,
      select: 'ขาย',
      openDialog: false,
      items: [
        'ขาย',
        'สูญหาย',
        'ชำรุด',
      ],
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
      cost: null,
      price: null,
      qty: 1,
      detailItems: null,
      dialogScan: false,
      databarcode: null,
      readerSize: {
        width: 50,
        height: 100,
      },

      detecteds: [],
      getdataTable: [],
      msgSnackBar: '',
      snackฺฺฺBarBool: false,
      Store: this.$store.state,

      confirmData: '',
      qtyBase: '',
      getDataBarcode: [],
      disble: false,
      time: moment().format('hmmss'),
      qtyRules: [
        v => !!v || 'qty is required' ],
    };
  },
  components: {
    QuaggaScanner,
  },
  async created() {
    await this.getBranch()
  },
  computed: {
    ...sync('*'),
    rules() {
      const rules = []
      if (Number(this.qtyBase)) {
        const rule = v => (Number(this.qtyBase)) >= Number(this.qty) || 'Values do not match'
        rules.push(rule)
      }
      return rules
    },

  },
  watch: {
    async databarcode() {
      if (this.databarcode.length === 13) {
        console.log('this.Store.dataBranch[0].branch_id', this.Store.dataBranch[0].branch_id)
        const api = 'https://a-nuphasupit58.000webhostapp.com/php/getDataBarcode.php';
        const params = new URLSearchParams();
        params.append('barcode', this.databarcode)
        console.log('this.Store.dataBranch[0].branch_id', this.Store.dataBranch[0].branch_id)
        params.append('branch_id', this.Store.dataBranch[0].branch_id)
        const response = await Axios.post(api, params)
        console.log('response', response)
        this.nameItems = response.data[0].name
        this.detailItems = response.data[0].desc
        this.qtyBase = response.data[0].quantity_stock
        this.price = response.data[0].price
        this.cost = response.data[0].cost
        console.log('price', response.data[0].price)
        console.log('cost', response.data[0].cost)
        if (response.data !== 'error') {
          this.disbleBtn = true
        } else {
          this.openDialogNotmatch = true
        }
      }
    },

  },
  methods: {
    ...mapActions({
      SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),
    setMenuRequest() {
      this.openDialog = false
      const menu = 'Menu'
      this.setDataLogin(menu);
      this.openDialogNotmatch = false
      this.Store.dataScanOut = []
    },
    getBranch() {
      controlData.selectBranch(Number(this.Store.dataLogin[0].rcode_id))
    },
    closeDialogScan() {
      this.dialogScan = false
      this.nameItems = ''
      this.databarcode = ''
      this.detailItems = ''
      this.qty = 1
      this.disbleBtn = false
    },
    putdata() {
      const obj = {
        databarcode: this.databarcode,
        add_date: functions.moment(moment().format('YYYYMMDD')),
        add_time: moment().format('hmmss'),
        branch_id: toNumber(this.Store.dataBranch[0].branch_id),
        quantity: this.qty,
        name: this.nameItems,
        status_id: this.select,
        approve_id: functions.tranStatusCode(String(this.select)),
        pid_user: String(this.Store.dataLogin[0].pid),
        pid_approve: String(this.Store.dataLogin[0].pid),
        detailItems: this.detailItems,
        price: this.price,
        cost: this.cost,
      }
      this.$store.state.dataScanOut.push(obj)
      this.nameItems = ''
      this.databarcode = ''
      this.detailItems = ''
      this.qty = 1
      this.dialogScan = false
      this.disbleBtn = false
    },
    openQuagga() {
      this.dialogScan = true
      this.databarcode = null
      Quagga.start()
    },
    logIt(data) {
      this.databarcode = data.codeResult.code
    },
    deleteItem(item) {
      this.getdataTable = item
      this.msgSnackBar = 'Are you sure you want to delete this item?'
      this.snackฺฺฺBarBool = true
    },
    deleteItemS() {
      const index = this.Store.dataScanOut.indexOf(this.getdataTable)
      this.Store.dataScanOut.splice(index, 1)
      this.snackฺฺฺBarBool = false
    },
    confirm() {
      this.openDialog = true
      const dataError = []
      const dataSecess = []
      for (let i = 0; i < this.dataScanOut.length; i += 1) {
        if (String(this.dataScanOut[i].status_id) === 'สูญหาย' || String(this.dataScanOut[i].status_id) === 'ชำรุด') {
          dataError.push(this.dataScanOut[i])
        } else {
          dataSecess.push(this.dataScanOut[i])
        }
      }
      console.log('dataError', dataError)
      console.log('dataSecess', dataSecess)
      this.insertSecess(dataSecess, dataError)
    },
    insertSecess(dataSecess, dataError) {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/insertItemsOut.php';
      const dataParams = new URLSearchParams();
      const dataSecessInsert = JSON.stringify(dataSecess)
      const dataErrorInsert = JSON.stringify(dataError)
      dataParams.append('dataSuccess', dataSecessInsert)
      dataParams.append('dataError', dataErrorInsert)
      Axios.post(api, dataParams)
        .then((response) => {
          console.log(response.data)
        })
    },

    validateField() {
      this.$refs.form.validate()
    },
  },
}
</script>
