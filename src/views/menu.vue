<template>
  <div>
    <v-flex v-if=" userName == 'admin'">
      <v-content>
      <v-container>
        <v-layout align-center justify-center>
          <v-flex class="grey lighten-4">
            <v-container>
              <v-card flat class="elevation-5">
                <v-card-title primary-title>
                  <!-- <div>User : {{userName}}</div> -->
                  <v-flex class="blue--text" title><div>User : {{userName}}</div></v-flex>
                </v-card-title>
                <v-form>
                  <v-flex ma-1>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setRegister()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-account-plus</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-account-plus</v-icon>
                        <p class="text-xs-center menuLabel">register</p>
              </v-card></v-flex>
              <v-flex ma-1>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setUser()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-account-edit</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-account-edit</v-icon>
                        <p class="text-xs-center menuLabel">edit user</p>
              </v-card></v-flex>
                </v-form>
              </v-card>
            </v-container>
          </v-flex>
        </v-layout>
      </v-container>
      </v-content>
    </v-flex>
    <v-flex v-else>
    <v-content>
      <v-container>
        <v-layout align-center justify-center>
          <v-flex class="grey lighten-4">
            <v-container>
              <v-card flat class="elevation-5">
                <v-form>
                  <v-layout wrap>
                    <v-flex xs6 pa-2>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuTab()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-truck</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-truck</v-icon>
                        <p class="text-xs-center menuLabel">ADD ITEMS/PIECE</p>
              </v-card>
              </v-flex>
                    <v-flex xs6 pa-2>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuAddItems()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-truck</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-truck</v-icon>
                        <p class="text-xs-center menuLabel">ADD ITEMS/TYPE</p>
                      </v-card>
                     
                    </v-flex>
                  </v-layout>
                  <v-layout>
                    <v-flex xs12 pa-2>
                       <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setdeleteStork()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-truck-delivery</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-truck-delivery</v-icon>
                        <p class="text-xs-center menuLabel">RETURN</p>
                      </v-card>
                    </v-flex>
                  </v-layout>
                  <div v-if="validateRole() == false">
                  <v-layout wrap>


                    <v-flex xs6 pa-2>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuRequest()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-sync-alert</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-sync-alert</v-icon>
                        <p class="text-xs-center menuLabel">REQUEST</p>
                      </v-card>
                    </v-flex>
                    <!-- <v-flex xs6 pa-2>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="setMenuRequest()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-sync-alert</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-sync-alert</v-icon>
                        <p class="text-xs-center menuLabel">Request</p>
                      </v-card>
                    </v-flex> -->



                    <v-flex xs6 pa-2>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuChart()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-chart-areaspline</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-chart-areaspline</v-icon>
                        <p class="text-xs-center menuLabel">REPORT</p>
                      </v-card>
                    </v-flex>



                  </v-layout>
                  </div>
                  <v-layout wrap>
                    <v-flex xs12 pa-2>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setStork()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-calendar-edit</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-calendar-edit</v-icon>
                        <p class="text-xs-center menuLabel">CHECK STOCK</p>
                      </v-card>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-card>
            </v-container>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
     </v-flex>
     <!-- {{validateRole()}} -->
  </div>
</template>

<script>
import {
  mapActions,
} from 'vuex'
import {
  sync,
} from 'vuex-pathify'
// import store from '../store/store'

export default {
  data() {
    return {
      click: null,
      Store: this.$store.state,
    }
  },
  mounted() {},
  created() {
    this.validateRole()
  },
  computed: {
    ...sync('*'),
  },
  methods: {
    ...mapActions({
      // SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),
    validateRole() {
      console.log(this.Store.dataLogin[0].role_id)
      if (Number(this.Store.dataLogin[0].role_id) === 1) {
        return false
      }
      return true
    },
    setMenuRequest() {
      const menu = 'request'
      this.setDataLogin(menu);
    },
    setMenuTab() {
      const menu = 'tab'
      this.setDataLogin(menu);
    },
    setMenuAddItems() {
      const menu = 'items'
      this.setDataLogin(menu);
    },
    setMenuChart() {
      const menu = 'chart'
      this.setDataLogin(menu);
    },
    setRegister() {
      const menu = 'Register'
      this.setDataLogin(menu);
    },
    setUser() {
      const menu = 'User'
      this.setDataLogin(menu);
    },
    setStork() {
      const menu = 'Stork'
      this.setDataLogin(menu);
    },
    setdeleteStork() {
      const menu = 'deleteStork'
      this.setDataLogin(menu);
    },
  },
}
</script>
<style scoped>
.v-card:hover {
  cursor: pointer;
  opacity: 0.85;
}

.menuCard:hover {
  cursor: pointer;
}
.menuCard {
  padding-top: 40px;
  padding-bottom: 30px;
  background-size: 50% auto;
  background-position: right top;
  overflow: hidden;
}

.menuLabel {
  font-size: 22px;
  line-height: 30px;
  margin-top: 10px;
  margin-bottom: 4px;
}

.background-icon {
  position: absolute;
  opacity: 0.075;
  top: 10%;
  left: 15%;
}

.background-icon .icon {
  font-size: 150px;
}
</style>
