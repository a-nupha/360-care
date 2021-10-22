<template>
<div>
    <v-btn color="info" @click="dialogFull = true">Please fill in the information</v-btn>

    <v-dialog v-model="dialogFull" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-toolbar dark color="blue">
            <v-btn icon dark @click="closeDialogFull()">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn dark flat @click="putdataInsert()">Save</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card>
            <v-layout mr-4>
        <v-text-field prepend-icon=" " mask="#############" counter="13" label="barcodetracking" v-model="databarcodeInput1" />
        <v-btn color="info" @click="openQuagga()">
            <v-icon justify-center>mdi-barcode-scan</v-icon>
        </v-btn>
    </v-layout>
    <v-layout>
        <v-flex>
            <v-layout mr-5>
                <v-select :items="items" prepend-icon=" " item-value="id" v-model="value" item-text="name" label="Type" single-line return-object />
                <v-flex xs7 mr-3>
                    <v-text-field type="number" label="QtyType" prepend-icon=" " :counter="7" mask="#######" v-model="QtyType" required />
                </v-flex>
            </v-layout>
            <v-layout>
                <v-flex xs10 mr-3>
                    <v-text-field type="number" label="Qty" prepend-icon=" " :counter="7" mask="#######" v-model="Qty" required />
                </v-flex>
            </v-layout>
            <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="price"
        type="number"
        suffix="Baht" :counter="6" mask="######" name="input-7-4" label="Price/Type"></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="cost"
        type="number"
        suffix="Baht" :counter="6" mask="######" name="input-7-4" label="cost/Type"></v-text-field>
      </v-flex>
    </v-layout>
            <v-layout mr-4>
                <v-text-field prepend-icon=" " mask="#############" counter="13" label="barcodeitems" v-model="databarcodeInput2" />
                <v-btn color="info" @click="openQuagga2()">
                    <v-icon justify-center>mdi-barcode-scan</v-icon>
                </v-btn>
            </v-layout>
            <!-- <v-layout>
                <v-flex xs10>
                    <v-text-field type="number" prepend-icon=" " label="qty" :counter="7" mask="#######" suffix="Piece" v-model="qty" />
                </v-flex>
            </v-layout> -->
            <v-layout>
                <v-flex xs10>
                    <v-text-field prepend-icon=" " label="Name" v-model="name" />
                </v-flex>
                </v-layout>
                <v-layout>
      <v-flex xs10>
      <v-select
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
    <v-flex>
    </v-flex>
    <v-dialog v-model="dialogScan" fullscreen hide-overlay transition="dialog-bottom-transition">
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
                <quagga-scanner v-if="!databarcode" :onDetected="logIt" class="videoo" :readerSize="readerSize" :readerType="'ean_reader'">
                    <video v-if="!databarcode" class="videoo" ></video>
                </quagga-scanner>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-layout>
                    <v-flex>
                        <v-layout>
                            <v-flex xs10>
                                dialog1
                                <v-text-field type="number" prepend-icon=" " :counter="13" mask="#############" label="Barcode" v-model="databarcode" />
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <!-- =================================================== -->
    <v-dialog v-model="dialogScan2" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-toolbar dark color="blue">
            <v-btn icon dark @click="closeDialog2()">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Settings</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn dark flat @click="putdata2()">Save</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card>
            <v-card-text>
                <quagga-scanner v-if="!databarcode2" :onDetected="logIt2" class="videoo2" :readerSize="readerSize" :readerType="'ean_reader'">
                    <video v-if="!databarcode2" class="videoo2" ></video>
                </quagga-scanner>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-layout>
                    <v-flex>
                        <v-layout>
                            <v-flex xs10>
                                dialog2
                                <v-text-field prepend-icon=" " :counter="13" mask="#############" label="Barcode" v-model="databarcode2" />
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-card-actions>
        </v-card>
    </v-dialog>
        </v-card>
    </v-dialog>
</div>
</template>

<script>
import {
  toNumber,
} from 'lodash'
import {
  QuaggaScanner,
} from 'vue-quaggajs';
import moment from 'moment'
import Quagga from 'quagga';
import functions from '../plugins/functions'
import controlData from './getApiData/controlData'


export default {
  components: {
    QuaggaScanner,
  },
  data() {
    return {
      getCate: null,
      dialogFull: false,
      readerSize: {
        width: 50,
        height: 100,
      },
      dialogScan2: false,
      dialogScan: false,
      databarcodeInput2: null,
      databarcodeInput1: null,
      databarcode: null,
      databarcode2: null,
      price: '',
      cost: '',
      name: '',
      qty: '',
      QtyType: '',
      detailItems: '',
      Store: this.$store.state,
      value: '',
      items: [{
        name: 'crate',
        id: 1,
      },
      {
        name: 'pack',
        id: 2,
      },
      {
        name: 'Wrap',
        id: 3,
      },
      {
        name: 'bag',
        id: 4,
      },
      {
        name: 'box',
        id: 5,
      },

      ],
    }
  },
  mounted() {
    controlData.getCate().then((response) => {
      const retData = response.data
      this.getCate = retData
      console.log('daTAaPIsERCH', this.getCate)
    });
  },
  methods: {
    logIt(data) {
      this.databarcode = data.codeResult.code
    },
    logIt2(data) {
      this.databarcode2 = data.codeResult.code
    },
    putdata() {
      this.databarcodeInput1 = this.databarcode
      this.databarcode2 = null
      this.dialogScan = false
    },
    putdata2() {
      this.databarcodeInput2 = this.databarcode2
      this.databarcode2 = null
      this.dialogScan2 = false
    },
    openQuagga() {
      this.dialogScan = true
      this.databarcode = null
      Quagga.start()
    },
    openQuagga2() {
      console.log('test')
      this.dialogScan2 = true
      console.log('test')
      this.databarcode2 = null
      console.log('test')
      Quagga.start()
    },
    closeDialog() {
      this.dialogScan = false
      this.databarcode = null
    },
    closeDialog2() {
      this.dialogScan2 = false
      this.databarcode2 = null
    },
    closeDialogFull() {
      this.dialogFull = false
    },
    putdataInsert() {
      this.dialogFull = false
      const obj = {
        databarcodeTracking: this.databarcodeInput1,
        TypeName: this.value.name,
        TypeId: this.value.id,
        price: toNumber(this.price),
        cost: toNumber(this.cost),
        price_Piece: this.price / (this.Qty * this.QtyType),
        cost_Piece: this.cost / (this.Qty * this.QtyType),
        QtyType: toNumber(this.QtyType),
        Qty: toNumber(this.Qty),
        Qty_Piece: this.Qty * this.QtyType,
        barcodeItems: this.databarcodeInput2,
        name: this.name,
        cate_id: this.cate_value.cate_id,
        cate_name: this.cate_value.cate_name,
        detailItems: this.detailItems,
      }
      console.log(obj)
      this.Store.dataScan2.push(obj)
    },
  },

}
</script>
