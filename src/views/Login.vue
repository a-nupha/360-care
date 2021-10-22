<template>
  <div>
    <v-content>
      <v-container>
        <v-layout align-center justify-center>
          <v-flex class="grey lighten-4">
            <v-container>
              <v-card flat>
                <v-card-title>
                  <v-toolbar color="blue lighten-2" dark>
                    <v-layout><v-icon>mdi-login</v-icon></v-layout>
                    <v-layout>
                      <v-flex caption>
                        
                        Enter your usename and password to log on
                        </v-flex>
                        </v-layout>
                    
                    
                  </v-toolbar>
                </v-card-title>
                <v-form>
                  <v-layout>
                    <v-flex ma-1 pr-5  >
                      <v-text-field prepend-icon="mdi-account" name="Username" label="Username" v-model="userName"></v-text-field>
                      <v-text-field prepend-icon="mdi-lock" name="Password" label="Password" type="password" v-model="passWord"></v-text-field>
                    </v-flex>
                  </v-layout>
                  <v-card-actions>
                    <v-btn color="blue" :loading="loading"  dark large block @click="login()">Login</v-btn>
                    <!-- <v-btn color="red" dark large block @click="Register()">Register</v-btn> -->
                  </v-card-actions>
                  <!-- <li>{{userName}}</li> -->
                  <!-- <li>{{msg}}</li> -->
                  <!-- {{store.state.msgSnackBar}} -->
                  

                </v-form>
                
              </v-card>
            </v-container>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
    <v-snackbar
    :vertical="true"
    v-model="snackฺฺฺBarBool"
    color="orange"
    :timeout="timeout"
    bottom>
    <v-flex >{{msgSnackBar}}</v-flex>
  </v-snackbar>
  <!-- {{snackฺฺฺBarBool}} -->
  </div>
</template>
<script>
import Axios from 'axios';
import {
  mapActions,
} from 'vuex'
import {
  sync,
} from 'vuex-pathify'
import controlData from './getApiData/controlData'
import store from '../store/store'


export default {
  name: 'Login',
  components: {
    // tab,
  },
  data() {
    return {
      Store: this.$store.state,
      snackฺฺฺBarBool: false,
      msgSnackBar: null,
      timeout: 5000,
      inputUserName: null,
      inputPassword: null,
      test: 'testdata',
      data: [],
      z: '',
      loading: false,
      datainsert: {
        pid: '1759900252875',
        fname: 'A-nupha',
        lname: 'Supreyaporn',
        tname: 'mr.',
        bdate: '25620202',
        email: 'fhj@gmail.com',
        tel: '0882881878',
        flag_id: '0',
        now_date: '22560202',
        rcode_id: '7704',
        index1: '1234',
        index2: '1234',
      },
      desserts: [
        {
          name: 'Frozen Yogurt',
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: '1%',
        },
        {
          name: 'Ice cream sandwich',
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
          iron: '1%',
        },
        {
          name: 'Eclair',
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
          iron: '7%',
        },
        {
          name: 'Cupcake',
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
          iron: '8%',
        },
        {
          name: 'Gingerbread',
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
          iron: '16%',
        },
        {
          name: 'Jelly bean',
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
          iron: '0%',
        },
        {
          name: 'Lollipop',
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
          iron: '2%',
        },
        {
          name: 'Honeycomb',
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
          iron: '45%',
        },
        {
          name: 'Donut',
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
          iron: '22%',
        },
        {
          name: 'KitKat',
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
          iron: '6%',
        },
      ],
    }
  },
  computed: {
    ...sync('*'),
  },
  created() {
    this.insert()
    // controlData.search().then((response) => {
    //   let retData = response.data
    //   retData.forEach((k, v) => {
    //     let pid = k.pid
    //     if (pid != this.store.state.userName) {
    //       alert('ไม่พบผู้ใช้งานนี้ในระบบ')
    //     }
    //   });
    // });
  },

  methods: {
    async insert() {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/test.php';
      // const fromData = new FormData();
      const Empparams = new URLSearchParams();
      const az = JSON.stringify(this.desserts)
      console.log('data', az)
      Empparams.append('dataarr', az)
      await Axios.post(api, Empparams)
        .then((response) => {
          console.log(response.data);
        })
    },


    async getUser() {
      // await controlData.search().then((response) => {
      //   const retData = response.data
      //   console.log('daTAaPIsERCH', retData)
      //   for (let i = 0; i < retData.length; i += 1) {
      //
      //   //   this.$set(this.Store.dataUserApi, i, {
      //   //     ...this.Store.dataUserApi[i],
      //   //     indexLog: i,
      //   //   })
      //   //   this.$set(this.Store.dataUserApi, i, {
      //   //     ...this.Store.dataUserApi[i],
      //   //     index2Edit: this.Store.dataUserApi[i].index2,
      //   //   })
      //   }
      //   // console.log(this.Store.dataUserApi)
      // });
    },
    async login() {
      this.loading = true
      // eslint-disable-next-line prefer-destructuring
      const userName = store.state.userName
      // eslint-disable-next-line prefer-destructuring
      const passWord = store.state.passWord
      await controlData.login(userName, passWord)
      if (String(store.state.dataLogin[0].index1)
        .toLowerCase() === String(userName).toLowerCase()) {
        // alert('ถูกต้อง')
        console.log('data login', store.state.dataLogin)
        const menu = 'Menu'
        this.setDataLogin(menu);
        this.getUser()
        this.Store.nameUser = store.state.dataLogin[0].fname
        this.loading = false
        console.log('store.state.dataLogin', store.state.dataLogin[0].fname)
      } if (String(await store.state.dataLogin) === 'password is incorrect') {
        console.log('test')
        this.msgSnackBar = 'password is incorrect'
        this.snackฺฺฺBarBool = true
        console.log(store.state.dataLogin)
        this.loading = false
      }
    },
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    async setData(data) {
      controlData.save(data)
      const menu = 'Menu'
      this.setDataLogin(menu);
      // await this.validatePassword()
    },
    // validatePassword() {
    //   if (Username == this.XXX && this.password == this.yyy) {
    //     const menu = 'Menu'
    //     this.setDataLogin(menu);
    //   }
    // },
    Register() {
      const Register = 'Register'
      this.setDataLogin(Register);
    },
  },
}
</script>
<style>
  /* .bg {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      background-color: red;
      transform: scale(1.1);
    } */
</style>
