<template>
  <v-app id="app">
    <v-toolbar color="blue lighten-1" dark tabs>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>
        <!-- <span>{{ moment().format('MMMM Do YYYY, h:mm:ss a') }}</span> -->
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-icon>mdi-account</v-icon>
      <div>365-care</div>
      <v-btn icon @click="dialogContact = true">
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-toolbar>

<v-content>
      <v-container>
        <v-layout align-center justify-center>
          <v-flex class="grey lighten-4">
            <v-container>
              <v-card shaped flat>
                <v-form>
                  <div class="d-flex flex-column justify-space-between align-center">
                    <v-flex mt-3>
                      <!-- <img  src="./assets/365careLogo.png"> -->
                      <v-img
                        :aspect-ratio="16 / 10"
                        width="100%"
                        src="https://www.img.in.th/images/685712519a2fdd56cfd71e60cbc5bdc1.png"
                      ></v-img>
                    </v-flex>
                  </div>
                  <v-container fluid>
              
                    
                      <v-textarea
                        no-resize
                        rows="4"
                        name="input-7-4"
                        label="Policy"
                        :value="policy"
                      ></v-textarea>
              
                  
                </v-container>
                <v-container style="margin-top:-50px;">
                  <v-radio-group
                          v-model="consentPolicyFlag"
                          row
                        >
                          <v-radio
                            label="ยอมรับ"
                            value="radio-1"
                          ></v-radio>
                          <v-radio
                            label="ไม่ยอมรับ"
                            value="radio-2"
                          ></v-radio>
                  </v-radio-group>
                </v-container>
                   <v-layout>
                  <v-flex ma-2 mt-2 mb-2>
                    <v-btn block depressed elevation="6" rounded x-large color="primary">
                      ภาษาไทย
                    </v-btn>
                  </v-flex>
                  <v-flex ma-2 mt-2 mb-2>
                    <v-btn block depressed elevation="6" rounded x-large color="blue lighten-2" dark>
                      English
                    </v-btn>
                  </v-flex>
                </v-layout>
                </v-form>
              </v-card>
            </v-container>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>

    <!-- ตัวสลับคอมโพแนน
   <transition name="component-fade" mode="out-in">
              <component v-bind:is="z"></component>
  </transition>
-->
    <v-layout wrap style="height: 50px">
      <v-navigation-drawer
        height="100%"
        width="200"
        v-model="drawer"
        absolute
        temporary
      >
        <v-list class="pa-1">
          <v-list-tile avatar>
            <!-- <v-list-tile-avatar> -->
            <v-avatar color="blue">
              <span class="white--text headline">{{
                String(testSandData).substring(0, 1)
              }}</span>
            </v-avatar>
            <!-- </v-list-tile-avatar> -->
            <v-list-tile-content>
              <v-list-tile-title>{{ testSandData }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>

        <v-list-tile @click="navigationtab()" ripple>
          <v-list-tile-action>
            <v-icon>mdi-apps</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>Menu</v-list-tile-title>
        </v-list-tile>
        <v-divider />
        <v-list-tile @click="logout()" ripple>
          <!-- <v-list-tile-action>
          <v-icon>mdi-logout</v-icon>
        </v-list-tile-action>
         <v-list-tile-title>LOGOUT</v-list-tile-title> -->
        </v-list-tile>
      </v-navigation-drawer>
    </v-layout>

    <v-footer
     app
     bottom
     absolute
     padless
    >
      <v-card
        flat
        tile
        width="100%"
        class="primary lighten-1 text-center"
      >
        <v-divider></v-divider>

        <v-card-text class="white--text">
          {{ new Date().getFullYear() }} — <strong>&copy; 365-care </strong>
        </v-card-text>
      </v-card>
    </v-footer>

  </v-app>
</template>
<script>
import { mapState } from "vuex";
import { sync } from "vuex-pathify";
// import LineChart from './lineChart'
// import SnackBar from './views/SnackBar.vue'
// import logo from '../src/assets/.logo.png';

export default {
  name: 'Register',
  data() {
    return {
      dialogContact: false,
      openDialog: false,
      drawerS: false,
      drawer: '',
      Store: this.$store.state,
      policy: '1. คำแถลงว่าด้วยการคุ้มครองข้อมูลส่วนบุคคล1.1. นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ (“นโยบายคุ้มครองข้อมูลส่วนบุคคล”) อธิบายวิธีการที่บริษัท มิตซูบิชิ มอเตอร์ส (ประเทศไทย) จำกัด (ซึ่งต่อไปนี้จะเรียกว่า “MMTh” “เรา” หรือ “ของเรา”) เก็บรวบรวม ใช้ เก็บรักษา เปิดเผย และ/หรือ โอนไปยังต่างประเทศ ซึ่งข้อมูลส่วนบุคคลของลูกค้าในปัจจุบันและอนาคต (“คุณ” หรือ “ของคุณ”) (ตามที่นิยามไว้ในนโยบายนี้) โดยมีวัตถุประสงค์เพื่อคุ้มครองความเป็นส่วนตัวของข้อมูลส่วนบุคคลของคุณ1.2. นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ใช้กับช่องทางการสื่อสารทั้งออนไลน์หรือออฟไลน์ที่เราเก็บรวบรวมข้อมูลส่วนบุคคลของคุณ ไม่ว่าทางต่อหน้า ผ่านศูนย์บริการ โรงงาน สถานที่ประกอบกิจการของเรา งานกิจกรรม หรือ ทางโทรศัพท์ผ่านศูนย์บริการข้อมูลลูกค้า (call center) หรือทางออนไลน์ ผ่านทางอีเมล หรือแพลตฟอร์มโซเชียลมีเดีย (เช่น เว็บเพจ Facebook หรือ Line) และช่องทางอื่นๆ ที่เกี่ยวกับการจัดหาผลิตภัณฑ์และบริการให้แก่คุณ รวมถึงการใช้แอปพลิเคชัน Smartphone Link Gateway for M Connect) และ/หรือแอปพลิเคชันอื่นๆ (“แอปพลิเคชัน”) เว็บไซต์ของเรา https://www.mitsubishi-motors.co.th/th และ/หรือเว็บไซต์อื่นๆ (“เว็บไซต์”) และปฏิสัมพันธ์อื่นๆ ระหว่างคุณกับเรา (ซึ่งต่อไปนี้จะรวมเรียกกันว่า “ช่องทางการสื่อสาร”)1.3. เพื่อให้บรรลุวัตถุประสงค์ของนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ “ข้อมูลส่วนบุคคล” หมายถึงข้อมูลส่วนบุคคลหรือข้อมูลที่สามารถระบุตัวตนได้ตามที่นิยามไว้ในกฎหมายที่ใช้บังคับ ซึ่งรวมถึงข้อมูลส่วนบุคคลที่มีความละเอียดอ่อน (ตามที่นิยามไว้ในนโยบายนี้)1.4. MMTh มีความมุ่งมั่นในการดำเนินการเพื่อให้มั่นใจว่าความเป็นส่วนตัวของคุณจะได้รับความคุ้มครอง และการประมวลผลข้อมูลส่วนบุคคลของคุณจะเป็นไปตามกฎหมายและข้อบังคับที่เกี่ยวข้อง (ซึ่งอาจมีการแก้ไขเพิ่มเติมและมีการออกกฎหมายใหม่ใช้บังคับแทนเป็นครั้งคราว) เพื่อคุ้มครองข้อมูลส่วนบุคคลในประเทศที่เราเข้าไปและมุ่งหมายจะเข้าไปดำเนินธุรกิจ (“กฎหมายที่ใช้บังคับ”) MMTh จะเก็บรวบรวม ใช้ เก็บรักษา เปิดเผย และโอนไปยังต่างประเทศซึ่งข้อมูลส่วนบุคคลของคุณตามนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้เท่านั้น1.5. โปรดอ่านเนื้อหาต่อไปนี้อย่างระมัดระวังเพื่อทำความเข้าใจมุมมองและการปฏิบัติของ MMTh เกี่ยวกับข้อมูลส่วนบุคคลของคุณและวิธีการที่เราจะประมวลผลข้อมูลดังกล่าว ข้อมูลบางประการเกี่ยวกับคุณมีความจำเป็นสำหรับการจัดหาผลิตภัณฑ์และบริการให้แก่คุณ หากคุณไม่ตกลงที่จะให้ข้อมูลดังกล่าว เราจะไม่สามารถจัดหาผลิตภัณฑ์และบริการให้แก่คุณ และคุณจะไม่สามารถใช้หรือเข้าถึงฟังก์ชั่นและการใช้งานของบริการและผลิตภัณฑ์ของเราทั้งหมดได้1.6. โดยทั่วไปแล้วกิจกรรมของเรา (ซึ่งรวมถึงการให้บริการ และการจำหน่ายผลิตภัณฑ์) ไม่มุ่งเน้นที่ผู้เยาว์ คนเสมือนไร้ความสามารถ หรือคนไร้ความสามารถ ดังนั้น หากคุณมีอายุต่ำกว่า 20 ปี หรือยังไม่บรรลุนิติภาวะตามที่กำหนดในประเทศที่คุณอาศัยอยู่ เป็นคนเสมือนไร้ความสามารถ เป็นคนไร้ความสามารถ (แล้วแต่กรณี) เว้นแต่จะมีสิทธิตามกฎหมาย และคุณต้องการใช้บริการของเรา ใช้แอปพลิเคชันของเรา หรือบริการอื่นๆ จากเรา คุณจะต้องได้รับความยินยอมจากผู้ปกครองหรือผู้แทนโดยชอบธรรมก่อนติดต่อเราหรือก่อนให้ข้อมูลส่วนบุคคลแก่เรา เราไม่เก็บรวบรวมข้อมูลส่วนบุคคลหากเราทราบอยู่แล้วว่าข้อมูลดังกล่าวเป็นข้อมูลของผู้เยาว์ที่อายุน้อยกว่า 20 ปีโดยไม่ได้รับความยินยอมจากผู้ปกครองตามที่กฎหมายกำหนด หรือเป็นของคนเสมือนไร้ความสามารถหรือคนไร้ความสามารถโดยไม่ได้รับความยินยอมจากผู้พิทักษ์หรือผู้อนุบาลตามกฎหมาย1.7. นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ได้รับการปรับปรุงครั้งล่าสุดเมื่อ 20 เมษายน พ.ศ. 2563 MMTh สงวนสิทธิ์ โดยมีดุลยพินิจแต่เพียงผู้เดียว ในการปรับเปลี่ยน แก้ไข ลบ และปรับปรุงนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้เป็นครั้งคราว MMTh จะใช้ความพยายามตามสมควรเพื่อแจ้งให้คุณทราบและในลักษณะที่เหมาะสมถึงการปรับเปลี่ยนข้อกำหนดใดของนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ (เช่น โดยส่งนโยบายที่แก้ไขให้คุณทางอีเมล หรือโดยประกาศการเปลี่ยนแปลงดังกล่าวในช่องทางการสื่อสารของเรา) หากการเปลี่ยนแปลงใดๆ ของนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ต้องได้รับความยินยอมจากคุณตามกฎหมายที่ใช้บังคับ เราจะขอความยินยอมจากคุณเพื่อให้สอดคล้องกับการเปลี่ยนแปลงดังกล่าว',
      consentPolicyFlag: false,
    };
  },
  computed: {
    ...mapState({
      login: (store) => store.getApi.login,
      setMenuRequest: (store) => store.getApi.setMenuRequest,
    }),
    ...sync('*'),
  },
  components: {
    // chart,
    // Scan,
    // request,
    // Branch,
    // Syn,
    // tab,
    // LoginApp,
    // Menu,
    // moment,
    // Register,
    // User,
    // Stork,
    // deleteStork,
    // items,
    // test,
  },
  mounted() {},
  watch: {
    // login() {
    //   if (this.login === 'Menu') { this.z = 'Menu' }
    //   if (this.login === 'request') { this.z = 'request' }
    //   if (this.login === 'tab') { this.z = 'tab' }
    //   if (this.login === 'Register') { this.z = 'Register' }
    //   if (this.login === 'LoginApp') { this.z = 'LoginApp' }
    //   if (this.login === 'chart') { this.z = 'chart' }
    //   if (this.login === 'User') { this.z = 'User' }
    //   if (this.login === 'Stork') { this.z = 'Stork' }
    //   if (this.login === 'deleteStork') { this.z = 'deleteStork' }
    //   if (this.login === 'items') { this.z = 'items' }
    // },
  },
  created() {
    // this.validate()
  },
  methods: {
    // openDialogContext() {
    //   // this.drawerS = false
    //   this.openDialog = true
    // },
    // toggleNavigationDrawer() {
    //   this.drawer = !this.drawer;
    // },
    // logout() {
    //   store.state.userName = null
    //   store.state.passWord = null
    //   const menu = 'LoginApp'
    //   this.setDataLogin(menu);
    //   this.$store.commit('resetState');
    // },
    // ...mapActions({
    //   setDataLogin: 'getApi/setDataLogin',
    // }),
    // navigationtab() {
    //   console.log('this.Store.dataLogin[0]', this.Store.dataLogin[0])
    //   if (this.Store.dataLogin[0].rcode_id !== null || this.Store.dataLogin[0] !== '') {
    //     const menu = 'Menu'
    //     this.setDataLogin(menu);
    //   }
    // },
  },
};
</script>
<style>
/* .selectCtrl .v-select>.v-input__control>.v-input__slot{
    height:28px !important ;
  }

  .selectCtrl2 .v-select>.v-input__control>.v-input__slot{
    height:28px !important ;
    width: 15rem;
  } */
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  overflow: auto;
  text-align: center;
  color: #2c3e50;
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}
/* .v-menu__content {
  top: 50px !important;
  left: 0px !important;
} */

.viewport canvas[data-v-047f45f1],
.viewport video[data-v-047f45f1] {
  position: absolute !important;
  left: 0 !important;
  width: 400px !important;
  height: 520px !important;
  top: 0 !important;
}
#nav a.router-link-exact-active {
  color: #42b983;
}
/* #background{
color: #0D47A1 ;
} */
/* .selectTest .v-menu__content {
  top: 35px !important;
  left: 0px !important;
} */
</style>
