<template>
  <div class="about">
    <v-flex ma-1 color="primary">
      <v-card>
        <v-flex>
          <v-layout>
            <v-flex ma-3> <span>{{ moment().format('MMMM Do YYYY, h:mm:ss a') }}</span></v-flex>
          </v-layout>
          <v-layout align-center justify-center>
            <v-flex xs10 >
              <v-text-field v-model="Store.dataBranch[0].branch_id" disabled prepend-icon="mdi-city" name="Branch" label="Branch"></v-text-field>
            </v-flex>
          </v-layout>
          <!-- <v-layout align-center justify-center>
            <v-flex xs10>
              <v-text-field prepend-icon="mdi-package-variant-closed"
              name="batch" label="batch"></v-text-field>
            </v-flex>
          </v-layout> -->
          <v-layout align-center justify-center>
            <v-flex xs10>
              <v-text-field prepend-icon="mdi-map-marker"
              v-model="Store.dataBranch[0].branch_name" disabled
              name="location" label="location"></v-text-field>
            </v-flex>
          </v-layout>
          <v-flex xs2>
              <v-btn icon label="ถัดไป">
              </v-btn>
            </v-flex>
        </v-flex>
      </v-card>
    </v-flex>
  </div>
</template>

<script>
import moment from 'moment'
import controlData from './getApiData/controlData'
// import Quagga from 'quagga';

export default {
  data() {
    return {
      Store: this.$store.state,
    }
  },
  name: 'abount',
  async created() {
    await this.getBranch()
  },
  methods: {
    getBranch() {
      controlData.selectBranch(Number(this.Store.dataLogin[0].rcode_id))
    },
    moment() {
      return moment();
    },
  },
}
</script>
