<template>
  <div>
    <v-layout>
<v-layout>
  <v-flex ma-4>
  <v-flex ma-5 pa-5>
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
    </v-flex>
</v-layout>

    </v-layout>
<v-dialog v-model="dialogScan"  fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-toolbar dark color="blue">
            <v-btn icon dark @click="closeDialog()">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Settings</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn dark flat @click="putdata()">Save</v-btn>
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
        <v-text-field type="number" prepend-icon=" " :disabled="disabledApi" :counter="13" mask="#############" label="Barcode" v-model="databarcode" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="Name" :disabled="disabledApi" v-model="name" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="price" :disabled="disabledApi"
        type="number"
        suffix="Baht"  :counter="6" mask="######" name="input-7-4" label="Price"></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="cost" :disabled="disabledApi"
        type="number"
        suffix="Baht"  :counter="6" mask="######" name="input-7-4" label="Cost"></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field type="number"
        prepend-icon=" " label="Qty" suffix="Piece" :counter="7" mask="#######" v-model="qty" required/>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
      <v-select
      :disabled="disabledApi"
                :items="getCate"
                prepend-icon=" "
                item-value="cate_id"
                v-model="cate_value"
                item-text="cate_name"
                label="category"
                single-line
                return-object
                />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-textarea prepend-icon=" " v-model="detailItems" :disabled="disabledApi"
        box name="input-7-4" label="Description" auto-grow></v-textarea>
      </v-flex>
    </v-layout>
            </v-flex>
          </v-layout>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { toNumber } from 'lodash'
import {
  QuaggaScanner,
} from 'vue-quaggajs';
import Axios from 'axios';
import Quagga from 'quagga';
import moment from 'moment'
// import swal from 'sweetalert';
import { sync } from 'vuex-pathify'
// import store from '../store/store'
import controlData from './getApiData/controlData'
import functions from '../plugins/functions'


export default {
  name: 'VueBarcodeTest',
  data() {
    return {
      cate_value: '',
      time: moment().format('hmmss'),
      nowDate: functions.moment(moment().format('YYYYMMDD')),
      select: '01',
      items: [
        'ขาย',
        'สูญหาย',
        'ชำรุด',
      ],
      disabledApi: false,
      Store: this.$store.state,
      cost: null,
      price: null,
      qty: null,
      detailItems: null,
      dialogScan: false,
      model: 'tab-2',
      decoder: {
        readers: ['ean_reader', 'ean_8_reader', 'code_39_reader', 'code_39_vin_reader', 'codabar_reader', 'upc_reader', 'upc_e_reader', 'i2of5_reader', '2of5_reader', 'code_93_reader'],
      },
      databarcode: null,
      readerSize: {
        width: 50,
        height: 100,
      },
      detecteds: [],
      getCate: null,
    };
  },
  components: {
    QuaggaScanner,
  },
  watch: {
    async databarcode() {
      if (this.databarcode.length === 13) {
        console.log('this.Store.dataBranch[0].branch_id', this.Store.dataBranch[0].branch_id)
        // await controlData.getDataBarcode(this.databarcode, this.Store.dataBranch[0].branch_id).then((response) => {
        //   console.log(response.data)
        // });
        const api = 'https://a-nuphasupit58.000webhostapp.com/php/getDataBarcodeScan.php';
        const params = new URLSearchParams();
        params.append('barcode', this.databarcode)
        const response = await Axios.post(api, params)
        console.log('response', response)
        this.name = response.data[0].name
        this.detailItems = response.data[0].desc
        // eslint-disable-next-line prefer-destructuring
        this.cate_value = response.data[0]
        console.log(response.data[0])
        this.cost = response.data[0].cost
        this.price = response.data[0].price
        if (response.data !== 'error') {
          this.disabledApi = true
        }
      }
    },

  },
  computed: {
    ...sync('*'),
  },
  mounted() {
    controlData.getCate().then((response) => {
      const retData = response.data
      this.getCate = retData
      console.log('daTAaPIsERCH', this.getCate)
    });
  },
  created() {
  },
  methods: {
    closeDialog() {
      this.name = ''
      this.detailItems = ''
      this.cate_value = ''
      this.cost = ''
      this.price = ''
      this.qty = ''
      this.dialogScan = false
      this.disabledApi = false
    },
    putdata() {
      console.log('0000000', this.Store.dataBranch[0].branch_id)
      console.log('time', this.time)
      // console.log('this.Store.dataBranch[0].pid', this.Store.dataBranch[0].pid)
      // console.log('this.cate_value.cate_id', this.cate_value.cate_id)
      // if(this.disabledApi = true ){
      //   this.cate_value.cate_id = ''
      //   this.cate_value.cate_id = this.cate_value
      // }
      const obj = {
        barcode: String(this.databarcode),
        name: String(this.name),
        desc: String(this.detailItems),
        cate_id: this.cate_value.cate_id,
        price: toNumber(this.price),
        cost: toNumber(this.cost),
        remark: '',
        branch_id: toNumber(this.Store.dataBranch[0].branch_id),
        quantity_stock: toNumber(this.qty),
        date_in: functions.moment(moment().format('YYYYMMDD')),
        add_time: moment().format('hmmss'),
        status_id: String(this.select),
        approve_id: '01',
        pid_user: String(this.Store.dataLogin[0].pid),
        pid_approve: String(this.Store.dataLogin[0].pid),
      }
      console.log(obj)
      this.Store.dataScan.push(obj)
      // console.log('this.$store.state.dataScan', this.$store.state.dataScan)
      this.name = ''
      this.detailItems = ''
      this.cate_value = ''
      this.cost = ''
      this.price = ''
      this.qty = ''
      this.dialogScan = false
      this.disabledApi = false
    },
    openQuagga() {
      this.dialogScan = true
      this.databarcode = null
      Quagga.start()
    },
    logIt(data) {
      this.databarcode = data.codeResult.code
    },
  },
}
</script>
<style>


</style>
