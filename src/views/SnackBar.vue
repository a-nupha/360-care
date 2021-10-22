<template>
  <v-snackbar
    v-model="z"
    color="orange"
    :timeout="timeout"
    bottom>
    <v-flex>{{msgSnackBar}}</v-flex>
    <v-flex text-xs-right>
      <v-btn
        color="btnColor"
        class="pa-2"
        dark
        icon
        @click="close()"
        flat
        v-text="`ปิด`
        "/>
    </v-flex>
  </v-snackbar>
</template>
<script>
import {
  sync,
} from 'vuex-pathify'
import store from '../store/store'

export default {
  data() {
    return {
      timeout: 10000,
      z: null,
      multiLine: true,
    }
  },
  computed: {
    ...sync('*'),
  },
  watch: {
    snack() {
      if (store.state.snackBarBool == true) {
        console.log(store.state.snackBarBool)
        this.z = true
      }
    },
  },
  methods: {
    close() {
      store.state.msgSnackBar = null
      store.state.snackBarBool = false
    },
  },

}
</script>
