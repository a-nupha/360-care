<template>
<div>
    <v-content>
        <v-container>
            <v-layout align-center justify-center>
                <v-flex class="grey lighten-4">
                    <v-container>
                        <v-card flat class="elevation-5">
                            <v-layout ml-5 mr-5>
                                <v-flex>
                                    <v-text-field prepend-icon=" " v-model="data1" />
                                </v-flex>
                                <v-btn icon>
                                    <v-icon color="red" @click="openDialog()">mdi-barcode-scan</v-icon>
                                </v-btn>
                            </v-layout>
                              <v-layout ml-5 mr-5>
                                <v-flex>
                                    <v-text-field prepend-icon=" " v-model="data2" />
                                </v-flex>
                                <v-btn icon>
                                    <v-icon color="blue" @click="openDialog2()">mdi-barcode-scan</v-icon>
                                </v-btn>
                            </v-layout>
                        </v-card>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    ===============================================
    <v-btn color="red" @click="dialogScan2 = true "></v-btn>
    <v-dialog v-model="dialogScan" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-toolbar dark color="blue">
            <v-btn icon dark @click="closeDialogScan()">
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
                    <video class="videoo" ></video>
                </quagga-scanner>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-layout>
                    <v-flex xs10>
                        <v-text-field type="number" :disabled="disbleBtn" prepend-icon=" " label="Barcode" :counter="13" mask="#############" v-model="databarcode" />
                    </v-flex>
                </v-layout>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <!-- ========================================================== -->
    <v-dialog v-model="dialogScan2" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-toolbar dark color="blue">
            <v-btn icon dark @click="closeDialogScan2()">
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
                <quagga-scanner v-if="!databarcode2" :onDetected="logIt2" class="videoo" :readerSize="readerSize2" :readerType="'ean_reader'">
                    <video class="videoo" ></video>
                </quagga-scanner>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-layout>
                    <v-flex xs10>
                        <v-text-field type="number" prepend-icon=" " label="Barcode" :counter="13" mask="#############" v-model="databarcode2" />
                    </v-flex>
                </v-layout>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>
</template>

<script>
import {
  mapActions,
} from 'vuex'
import {
  sync,
} from 'vuex-pathify'
import {
  QuaggaScanner,
} from 'vue-quaggajs';

export default {
  data() {
    return {
      databarcode: null,
      dialogScan: '',
      databarcode2: null,
      dialogScan2: '',
      mapActions,
      readerSize: {
        width: 50,
        height: 100,
      },
      readerSize2: {
        width: 50,
        height: 100,
      },

    }
  },
  components: {
    QuaggaScanner,
  },
  computed: {
    ...sync('*'),
  },
  methods: {
    closeDialogScan() {
      this.dialogScan = false
      this.databarcode = null
    },
    closeDialogScan2() {
      this.dialogScan2 = false
      this.databarcode2 = null
    },
    // openQuagga() {
    //   this.dialogScan = true
    //   this.databarcode = null
    // },
    // openQuagga2() {
    //   this.dialogScan2 = true
    //   this.databarcode2 = null
    // },
    logIt(data) {
      this.databarcode = data.codeResult.code
    },
    logIt2(data) {
      this.databarcode2 = data.codeResult.code
    },
    putdata() {
      this.data1 = this.databarcode
      this.databarcode = null
      this.dialogScan = false
    },
    putdata2() {
      this.data2 = this.databarcode2
      this.databarcode2 = null
      this.dialogScan2 = false
    },
    openDialog() {
      this.dialogScan = true
      this.databarcode = null
    },
    openDialog2() {
      this.dialogScan2 = true
      this.databarcode2 = null
    },
  },
}
</script>
