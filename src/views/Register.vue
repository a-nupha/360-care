<template>
<div>
  <v-container>
    <v-layout row>
      <v-flex xs12 sm6 offset-sm3>
        <v-card>
          <v-card-text>
            <v-container>
              <form>
                <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                    prepend-icon="mdi-account-box"

        v-model="username"
        :counter="15"
        :rules="nameRules"
        label="Name"
        required
      ></v-text-field>
                    <!-- <v-text-field
                      prepend-icon="mdi-account-box"
                      label="Username"
                      v-model="username"
                      rules="nameRules"
                      required>
                    </v-text-field> -->
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-lock-question"
                      v-model="password"
                      label="password"
                      :rules="passRules"
                      type="password"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon= "mdi-alert-octagon"
                      label="Validate Password"
                      v-model="confirmPassword"
                      type="password"
                      :rules="[comparePasswords]"></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                    prepend-icon="mdi-email"
                    v-model="email"
                    :rules="emailRules"
                    label="E-mail"
                    required
                  ></v-text-field>
                    <!-- <v-text-field
                    rules="emailRules"
                      prepend-icon="mdi-email"
                      label="Your E-mail"
                      v-model="email"
                      required></v-text-field> -->
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-account"
                      name="FirstName"
                      label="FirstName"
                      :rules="fnameRules"
                      id="name"
                      v-model="fname"
                      type="text"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon=" "
                      label="LastName"
                      v-model="lname"
                      :rules="lnameRules"
                      type="text"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                    prepend-icon="mdi-account-card-details"
                      label="Pid"
                      :rules="pidRules"
                      v-model="pid"
                      mask="#-####-#####-##-#"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <!-- <v-text-field
                    prepend-icon="mdi-account-card-details"
                      label="id branch"
                      v-model="branch"
                      mask="####"
                      required></v-text-field> -->
                       <!-- {{cate_value}} -->
                       <v-select
                       :rules="branchRules"
                :items="getBranch"
                prepend-icon=" "
                item-value="branch_id"
                key="branch_id"
                v-model="cate_value"
                item-text="branch_name"
                label="branch"
                single-line
                return-object
                />
                  </v-flex>
                </v-layout>
                <v-layout>
                  <v-flex>
                  </v-flex>
                </v-layout>
              <v-layout wrap>
              <v-flex xs12>
                <v-radio-group v-model="tname" row>
                  <v-radio required prepend-icon=" "  color="blue" label="Mr." value="Mr."/>
                  <v-radio required prepend-icon=" "  color="blue" label="Mrs." value="Mrs."/>
                  <v-radio required prepend-icon=" "  color="blue" label="Ms." value="Ms."/>
                </v-radio-group>
              </v-flex>
              </v-layout>
              <v-layout>
                <v-radio-group v-model="select" row>
                  <v-radio required prepend-icon=" "  color="blue" label="Manager" value="01"/>
                  <v-radio required prepend-icon=" "  color="blue" label="Empooyee" value="02"/>
                </v-radio-group>
              </v-layout>
              <v-layout ma-0>
                  <v-flex xs12 ma-0>
                    <v-btn color="blue" dark large block :loading='loadingbtn'
                    @click="validate()" :disabled="!valid" >Register</v-btn>
                  </v-flex>
                </v-layout>
                <v-flex xs12>
                </v-flex>
                </v-form>
              </form>
            </v-container>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
  <v-layout row justify-center>
      <v-dialog v-model="snackฺฺฺBarBool" persistent max-width="400px">
        <v-card>
          <v-flex>
          <v-card-title
          :class='color'
          primary-title
          flat>
          <v-icon class="mr-3" color="white">mdi-information</v-icon>
          <v-flex class=""><v-flex class="white--text">INFORMATION</v-flex></v-flex>
        </v-card-title>
          <v-card-title>
            <v-layout justify-center><span>{{msgSnackBar}}</span></v-layout>
          </v-card-title>
          </v-flex>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="success()">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
</div>
</template>

<script>
import {
  mapActions,
} from 'vuex'
import {
  sync,
} from 'vuex-pathify'
import moment from 'moment'
import Axios from 'axios';
import controlData from './getApiData/controlData'
import store from '../store/store'
import functions from '../plugins/functions'


export default {
  data() {
    return {
      cate_value: '',
      valid: true,
      color: '',
      branchName: '',
      snackฺฺฺBarBool: null,
      timeout: 10000,
      select: '02',
      items: [
        'Empooyee',
        'Manager',
      ],
      selected: '',
      confirmPassword: '',
      getBranch: '',
      LastName: '',
      username: '',
      nameRules: [
        v => !!v || 'Name is required',
      ],
      branchRules: [
        v => !!v || 'branch is required',
      ],
      pidRules: [
        v => !!v || 'pid is required',
        v => (v && v.length === 13) || 'pid is not match',
      ],
      passRules: [
        v => !!v || 'password is required',
      ],
      fnameRules: [
        v => !!v || 'firstName is required',
      ],
      lnameRules: [
        v => !!v || 'lastName is required',
      ],
      password: '',
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid',
      ],
      fname: '',
      lname: '',
      tname: 'Mr.',
      branch: '',
      pid: '',
      msgSnackBar: '',
      loadingbtn: null,
      // nowDate: functions.moment('YYYYMMDD'),
      nowDate: functions.moment(moment().format('YYYYMMDD')),
    }
  },
  computed: {
    ...sync('*'),
    comparePasswords() {
      return this.password !== this.confirmPassword ? 'Passwords do not match.' : true
    },
  },
  watch: {
  },
  created() {
    this.getDataBranch()
  },
  methods: {
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    validate() {
      if (this.$refs.form.validate()) {
        this.dataInsert()
      }
    },
    async dataInsert() {
      if (this.username || this.password || this.fname || this.pid) {
        this.loadingbtn = true
        const obj = {
          username: this.username,
          password: this.password,
          email: this.email,
          fname: this.fname,
          lname: this.lname,
          tname: this.tname,
          pid: this.pid,
          flag_id: this.select,
          now_date: this.nowDate,
          rcode_id: this.cate_value.branch_id,
          role_id: this.select,
        }
        console.log('obj', obj)
        await controlData.save(obj)
        // const objBranch = {
        //   branchName: this.branchName,
        //   branch: this.branch,
        // }
        // await controlData.insertBranchName(objBranch)
        await this.awitData()
      } else {
        this.snackฺฺฺBarBool = true
        this.msgSnackBar = 'กรุณากรอกให้ครบสิคะ ไปทำมาใหม่นะ'
        this.color = 'red'
      }
    },
    awitData() {
      if (Boolean(store.state.msgSave) === false && Boolean(store.state.msginsertBranch) === false) {
        console.log('msgErrorLogin', store.state.msgSave)
        this.loadingbtn = false
        this.snackฺฺฺBarBool = true
        this.msgSnackBar = 'unsuccessful'
        this.color = 'red'
      } else {
        this.loadingbtn = false
        this.snackฺฺฺBarBool = true
        this.msgSnackBar = 'success'
        this.color = 'green'
      }
    },
    success() {
      this.snackฺฺฺBarBool = false
      const menu = 'Menu'
      this.setDataLogin(menu);
    },
    async getDataBranch() {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/getBranch.php';
      const response = await Axios(api)
      this.getBranch = response.data
      console.log(this.getBranch)
    },
  },
}
</script>
