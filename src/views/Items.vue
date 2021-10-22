<template>
<div>
  <v-form
      ref="form"
      v-model="valid"
      lazy-validation
      >

    <v-content>
        <v-container>
            <v-layout align-center justify-center>
                <v-flex class="grey lighten-4">
                    <v-container>
                        <v-card flat>


                                    <v-btn large block color="blue-grey"
                                      class="white--text" @click="dialogFull = true">
                                      creat Items
                                      <v-icon right dark>mdi-file-document</v-icon>
                                    </v-btn>

                                      <v-flex>
                                        <v-toolbar flat color="white">
                                        <v-toolbar-title>
                                            <v-flex xs12 subheader class="blue--text" ma-1>
                                                sale
                                            </v-flex>
                                        </v-toolbar-title>
                                        <v-divider class="mx-2" inset vertical></v-divider>
                                        <v-spacer></v-spacer>
                                        <div v-if="Store.dataScan2 != ''">
                                            <v-btn class="white--text"
                                            color="blue" @click="confirm()">confirm</v-btn>
                                        </div>
                                    </v-toolbar>
                                      </v-flex>
                                    <v-data-table :headers="headers"
                                    :items="Store.dataScan2"
                                    :loading="true" class="elevation-1">
                                        <v-progress-linear slot="progress"
                                        color="blue" indeterminate></v-progress-linear>
                                        <template slot="items"
                                        slot-scope="props">
                                            <td class="text-xs-center">
                                              {{ props.item.databarcodeTracking }}</td>
                                            <td class="text-xs-center">
                                              {{ props.item.name }}</td>
                                            <td class="text-xs-center">
                                              {{ props.item.QtyType }}</td>
                                            <td class="text-xs-center">
                                              {{ props.item.qty }}</td>
                                            <td>
                                                <v-btn icon>
                                                    <v-icon color="red"
                                                    @click="deleteItem(props.item)">
                                                    mdi-delete</v-icon>
                                                </v-btn>
                                            </td>
                                        </template>
                                    </v-data-table>
                            <v-dialog v-model="dialogFull"
                            fullscreen hide-overlay
                            transition="dialog-bottom-transition">
                                <v-toolbar dark color="blue">
                                    <v-btn icon dark @click="closeDialogFull()">
                                        <v-icon>mdi-close</v-icon>
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                    <v-toolbar-items>
                                        <v-btn dark flat :disabled="!valid"  @click="validate()">Save</v-btn>
                                    </v-toolbar-items>
                                </v-toolbar>
                                <v-card>

                                    <v-layout mr-4>
                                        <v-text-field prepend-icon=" "
                                        :rules="databarcodeInput1Rules"
                                        :disabled="disabledApi"
                                        mask="#############" counter="13"
                                        label="Barcodetracking" v-model="databarcodeInput1" />
                                        <v-btn color="info"
                                        @click="openQuagga()">
                                            <v-icon justify-center>
                                              mdi-barcode-scan
                                              </v-icon>
                                        </v-btn>
                                    </v-layout>
                                    <v-layout>
                                        <v-flex>
                                            <v-layout mr-5>
                                                <v-select :items="items"
                                                :disabled="disabledApi"
                                                :rules="TypeNameRules"
                                                prepend-icon=" " item-value="id"
                                                v-model="value" item-text="name"
                                                label="Unit" single-line return-object />
                                                <v-flex xs7 mr-3>
                                                    <v-text-field
                                                    type="number" label="Qty/Unit"
                                                    :rules="QtyTypeRules"
                                                    prepend-icon=" "
                                                    :counter="7" mask="#######"
                                                    v-model="QtyType" required />
                                                </v-flex>
                                            </v-layout>
                                            <v-layout>
                                                <v-flex xs10 mr-3>
                                                    <v-text-field type="number"
                                                    :disabled="disabledApi"
                                                    :rules="qtyRules"
                                                    suffix="price"
                                                    label="Qty" prepend-icon=" "
                                                    :counter="7" mask="#######"
                                                    v-model="qty" required />
                                                </v-flex>
                                            </v-layout>
                                            <v-layout>
                                                <v-flex xs10>
                                                    <v-text-field prepend-icon=" "
                                                    :disabled="disabledApi"
                                                    :rules="priceRules"
                                                    v-model="price" type="number"
                                                    suffix="Baht" :counter="6" mask="######"
                                                    name="input-7-4"
                                                    label="Price/Unit"></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                            <v-layout>
                                                <v-flex xs10>
                                                    <v-text-field prepend-icon=" "
                                                    :disabled="disabledApi"
                                                    :rules="costRules"
                                                    v-model="cost" type="number"
                                                    suffix="Baht" :counter="6"
                                                    mask="######" name="input-7-4"
                                                    label="cost/Unit"></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                            <v-layout mr-4>
                                                <v-text-field prepend-icon=" "
                                                mask="#############" counter="13"
                                                :rules="BarcodeItemsRules"
                                                :disabled="disabledApi"
                                                label="barcodeitems" v-model="databarcodeInput2" />
                                                <v-btn color="info" @click="openQuagga2()">
                                                    <v-icon justify-center>mdi-barcode-scan</v-icon>
                                                </v-btn>
                                            </v-layout>
                                            <v-layout>
                                                <v-flex xs10>
                                                    <v-text-field prepend-icon=" "
                                                    :rules="nameRules"
                                                    :disabled="disabledApi"
                                                    label="Name" v-model="name" />
                                                </v-flex>
                                            </v-layout>
                                            <v-layout>
                                                <v-flex xs10>
                                                    <v-select :items="getCate"
                                                    :rules="cateRules"
                                                    :disabled="disabledApi"
                                                    prepend-icon=" " item-value="cate_id"
                                                    v-model="cate_value" item-text="cate_name"
                                                    label="category" single-line return-object />
                                                </v-flex>
                                            </v-layout>
                                            <v-layout>
                                                <v-flex xs10>
                                                    <v-textarea prepend-icon=" "
                                                    :disabled="disabledApi"
                                                    v-model="detailItems" box name="input-7-4"
                                                    label="Description" auto-grow></v-textarea>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                    </v-layout>
                                    <v-flex>
                                    </v-flex>
                                    <v-dialog v-model="dialogScan"
                                    fullscreen hide-overlay transition="dialog-bottom-transition">
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
                                                :onDetected="logIt" class="videoo"
                                                :readerSize="readerSize"
                                                :readerType="'ean_reader'">
                                                    <video v-if="!databarcode"
                                                    class="videoo" ></video>
                                                </quagga-scanner>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-layout>
                                                    <v-flex>
                                                        <v-layout>
                                                            <v-flex xs10>
                                                                <v-text-field
                                                                type="number" prepend-icon=" "
                                                                :counter="13" mask="#############"
                                                                label="Barcode"
                                                                v-model="databarcode" />
                                                            </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                    <!-- =================================================== -->
                                    <v-dialog v-model="dialogScan2"
                                    fullscreen hide-overlay transition="dialog-bottom-transition">
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
                                                <quagga-scanner v-if="!databarcode2"
                                                :onDetected="logIt2" class="videoo2"
                                                :readerSize="readerSize"
                                                :readerType="'ean_reader'">
                                                    <video v-if="!databarcode2"
                                                    class="videoo2" ></video>
                                                </quagga-scanner>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-layout>
                                                    <v-flex>
                                                        <v-layout>
                                                            <v-flex xs10>
                                                                <v-text-field prepend-icon=" "
                                                                :counter="13" mask="#############"
                                                                label="Barcode"
                                                                v-model="databarcode2" />
                                                            </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-card>
                            </v-dialog>
                            <v-snackbar :vertical="true"
                            v-model="snackฺฺฺBarBool" color="orange" bottom>
                                <v-flex>{{msgSnackBar}}</v-flex>
                                <v-layout>
                                    <v-flex>
                                        <v-btn color="white" flat @click="snackฺฺฺBarBool = false ">
                                            no
                                        </v-btn>
                                    </v-flex>
                                    <v-flex>
                                        <v-btn color="white" flat @click="deleteItemS()">
                                            yes
                                        </v-btn>
                                    </v-flex>
                                </v-layout>
                            </v-snackbar>

                        </v-card>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
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
      </v-form>
</div>
</template>

<script>
import {
  mapActions,
} from 'vuex'
import {
  toNumber,
} from 'lodash'
import {
  QuaggaScanner,
} from 'vue-quaggajs';
import moment from 'moment'
import Quagga from 'quagga';
import { sync } from 'vuex-pathify'
import Axios from 'axios';
import functions from '../plugins/functions'
import controlData from './getApiData/controlData'
// import Axios from 'axios';

export default {
  components: {
    QuaggaScanner,
  },
  data() {
    return {
      nameRules: [
        v => !!v || 'Name is required'],
      databarcodeInput1Rules: [
        v => !!v || 'databarcodeTracking is required'],
      TypeNameRules: [
        v => !!v || 'TypeName is required'],
      priceRules: [
        v => !!v || 'price is required'],
      costRules: [
        v => !!v || 'cost is required'],
      QtyTypeRules: [
        v => !!v || 'QtyType is required'],
      qtyRules: [
        v => !!v || 'QTY is required'],
      barcodeItemsRules: [
        v => !!v || 'barcodeItems is required'],
      cateRules: [
        v => !!v || 'catetagory is required'],
      valid: true,
      time: moment().format('hmmss'),
      nowDate: functions.moment(moment().format('YYYYMMDD')),
      msgSnackBar: '',
      snackฺฺฺBarBool: false,
      cate_value: '',
      getCate: null,
      dialogFull: false,
      readerSize: {
        width: 50,
        height: 100,
      },
      headers: [{
        text: 'BarcodeTrack',
        align: 'left',
        sortable: false,
        value: 'databarcodeTracking',
      },
      {
        text: 'name',
        value: 'name',
      },
      {
        text: 'QtyType',
        value: 'QtyType',
      },
      {
        text: 'Qty',
        value: 'Qty',
      },
      {
        text: 'Delete',
        value: 'protein',
      },
      ],
      dialogScan2: false,
      dialogScan: false,
      databarcodeInput2: null,
      databarcodeInput1: null,
      databarcode: null,
      databarcode2: null,
      disabledApi: false,
      getdataTable: [],
      price: '',
      cost: '',
      name: '',
      qty: '',
      QtyType: '',
      detailItems: '',
      openDialog: false,
      Store: this.$store.state,
      value: '',
      items: [{
        name: 'crate',
        id: '1',
      },
      {
        name: 'pack',
        id: '2',
      },
      {
        name: 'Wrap',
        id: '3',
      },
      {
        name: 'bag',
        id: '4',
      },
      {
        name: 'box',
        id: '5',
      },

      ],
    }
  },
  computed: {
    ...sync('*'),
  },
  watch: {
    async databarcodeInput1() {
      // console.log('test')
      console.log('test-API', this.databarcodeInput1)
      if (this.databarcodeInput1.length === 13) {
        const api = 'https://a-nuphasupit58.000webhostapp.com/php/selectItemCenter.php';
        const params = new URLSearchParams();
        params.append('barcode', this.databarcodeInput1)
        const response = await Axios.post(api, params)
        console.log('response', response.data)
        // eslint-disable-next-line no-cond-assign
        if (response.data[0].TypeId = '1') {
          this.value = {
            name: 'crate',
            id: '1',
          }
          console.log(this.value)
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].TypeId = '2') {
          this.value = {
            name: 'pack',
            id: '2',
          }
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].TypeId = '3') {
          this.value = {
            name: 'Wrap',
            id: '3',
          }
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].TypeId = '4') {
          this.value = {
            name: 'bag',
            id: '4',
          }
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].TypeId = '5') {
          this.value = {
            name: 'box',
            id: '5',
          }
        }
        this.qty = response.data[0].qty
        this.databarcodeInput2 = response.data[0].barcodeItems
        this.name = response.data[0].name
        this.price = response.data[0].price
        this.cost = response.data[0].cost
        // eslint-disable-next-line no-cond-assign
        if (response.data[0].cate_id = '1') {
          this.cate_value = {
            cate_name: 'อาหารเเละเครื่องดื่ม',
            cate_id: '1',
          }
          console.log(this.value)
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].cate_id = '2') {
          this.cate_value = {
            cate_name: 'อุปกรณ์อิเล็กทรอนิกส์',
            cate_id: '2',
          }
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].cate_id = '3') {
          this.cate_value = {
            cate_name: 'ผลิตภัณฑ์เกี่ยวกับผิว',
            cate_id: '3',
          }
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].cate_id = '4') {
          this.cate_value = {
            cate_name: 'เครื่องแต่งกาย',
            cate_id: '4',
          }
        // eslint-disable-next-line no-cond-assign
        } else if (response.data[0].cate_id = '5') {
          this.cate_value = {
            cate_name: 'อื่นๆ',
            cate_id: '5',
          }
        }
        this.detailItems = response.data[0].desc
        if (response.data !== 'error') {
          this.disabledApi = true
        }
      }
    },

  },
  mounted() {
    controlData.getCate().then((response) => {
      const retData = response.data
      this.getCate = retData
      console.log('daTAaPIsERCH', this.getCate)
    });
  },
  methods: {
    ...mapActions({
      SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),
    validate() {
      if (this.$refs.form.validate()) {
        this.putdataInsert()
      }
    },
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
      console.log(this.Store.dataLogin[0].rcode_id)
      const obj = {
        databarcodeTracking: this.databarcodeInput1,
        TypeName: this.value.name,
        TypeId: this.value.id,
        price: toNumber(this.price),
        cost: toNumber(this.cost),
        price_Piece: toNumber(this.price) / (toNumber(this.qty) * toNumber(this.QtyType)),
        cost_Piece: toNumber(this.cost) / (toNumber(this.qty) * toNumber(this.QtyType)),
        QtyType: toNumber(this.QtyType),
        qty: toNumber(this.qty),
        Qty_Piece: toNumber(this.qty) * toNumber(this.QtyType),
        barcodeItems: this.databarcodeInput2,
        name: this.name,
        cate_id: this.cate_value.cate_id,
        cate_name: this.cate_value.cate_name,
        detailItems: this.detailItems,
        date_in: functions.moment(moment().format('YYYYMMDD')),
        add_time: moment().format('hmmss'),
        branch_id: toNumber(this.Store.dataLogin[0].rcode_id),
        remark: '',
        status_id: '01',
        approve_id: '01',
        pid_user: String(this.Store.dataLogin[0].pid),
        pid_approve: String(this.Store.dataLogin[0].pid),
      }
      this.Store.dataScan2.push(obj)
      console.log(obj)
      this.databarcodeInput1 = ''
      this.databarcodeInput2 = ''
      this.name = ''
      this.value = ''
      this.price = ''
      this.cost = ''
      this.QtyType = ''
      this.qty = ''
      this.cate_value = ''
      this.detailItems = ''
    },
    deleteItem(item) {
      this.getdataTable = item
      this.msgSnackBar = 'Are you sure you want to delete this item?'
      this.snackฺฺฺBarBool = true
    },
    deleteItemS() {
      const index = this.Store.dataScan2.indexOf(this.getdataTable)
      this.Store.dataScan2.splice(index, 1)
      this.snackฺฺฺBarBool = false
    },
    confirm() {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/InsertItemsNewFeeger.php';
      const dataParams = new URLSearchParams();
      const dataInsert = JSON.stringify(this.Store.dataScan2)
      console.log('this.Store.dataScan', this.Store.dataScan)
      dataParams.append('dataInsert', dataInsert)
      Axios.post(api, dataParams)
        .then((response) => {
          console.log('-=-=-==-')
          console.log(response.data)
        })
      this.insertItemsCenter()
      this.openDialog = true
      // ==========================================
    },
    insertItemsCenter() {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/InsertItemsCenter.php';
      const dataParams = new URLSearchParams();
      const dataInsert2 = JSON.stringify(this.Store.dataScan2)
      dataParams.append('dataInsert', dataInsert2)
      Axios.post(api, dataParams)
        .then((response) => {
          console.log('-=-=-==-')
          console.log(response.data)
        })
    },
    setMenuRequest() {
      this.openDialog = false
      const menu = 'Menu'
      this.setDataLogin(menu);
      this.Store.dataScan2 = []
    },
  },

}
</script>
