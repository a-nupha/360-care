<template>
    <div>
        <v-flex>
            Barcode packet
        </v-flex>
        <v-btn color="red" @click="openQuagga()"/>

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
import moment from 'moment'
import Quagga from 'quagga';
import functions from '../plugins/functions'

export default {
  components: {
    QuaggaScanner,
  },
  data() {
    return {
      databarcode: null,
      price: '',
      cost: '',
      name: '',
      qty: '',
      detailItems: '',
      dialogScan: false,
    }
  },
  methods: {
    logIt(data) {
      this.databarcode = data.codeResult.code
    },
    putdata() {
      const obj = {
        barcode: String(this.databarcode),
        name: String(this.name),
        desc: String(this.detailItems),
        // cate_id: this.cate_value.cate_id,
        price: toNumber(this.price),
        cost: toNumber(this.cost),
        remark: '',
        branch_id: toNumber(this.Store.dataBranch[0].branch_id),
        quantity_stock: toNumber(this.qty),
        date_in: functions.moment(moment().format('YYYYMMDD')),
        add_time: moment().format('hmmss'),
        // status_id: String(this.select),
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
    //   this.disabledApi = false
    },
    openQuagga() {
      this.dialogScan = true
      this.databarcode = null
      Quagga.start()
    },
    closeDialog() {
      this.name = ''
      this.detailItems = ''
      this.cate_value = ''
      this.cost = ''
      this.price = ''
      this.qty = ''
      this.dialogScan = false
    //   this.disabledApi = false
    },
  },

}
</script>
