<template>
  
  <v-content>
      <v-container>
        <v-layout align-center justify-center>
          <v-flex class="grey lighten-4">
            <v-container>
              <v-card shaped flat>
                <v-form>
                  <div
                    class="
                      d-flex
                      flex-column
                      align-center
                    "
                  >
                    <v-flex mt-5>
                      <v-img
                        contain
                        lazy-src="https://www.img.in.th/images/685712519a2fdd56cfd71e60cbc5bdc1.png"
                        max-height="150"
                        max-width="250"
                        src="https://www.img.in.th/images/685712519a2fdd56cfd71e60cbc5bdc1.png"
                      ></v-img>
                    </v-flex>
                  </div>

                   
                  <v-layout align-content-center style="color: #0277bd;">
                    <v-flex class="d-flex align-center justify-center pa-4 mx-auto" >
                    ข้อกำหนดและเงือนไขการลงทะเบียน
                    </v-flex>
                   </v-layout>
                  <v-container fluid >
                     <v-col
                      cols="12"
                      md="6"
                     >
                      <v-textarea
                       no-resize
                        rows="7"
                        filled
                        label="ความยินยอม"
                        :value="policy"></v-textarea>
                    </v-col>
                  </v-container>
                   <v-layout align-center justify-center>
                    <v-radio-group v-model="flag" row>
                      <v-radio label="ยอมรับ" value="true"></v-radio>
                      <v-radio label="ไม่ยอมรับ" value="false"></v-radio>
                    </v-radio-group>
                   </v-layout>
                  <v-layout >
                    <v-flex >
                      <v-btn
                       @click="checkDataConsentFlage()"
                        block
                        depressed
                        elevation="6"
                        rounded
                        x-large
                        color="primary"
                      >
                        ภาษาไทย
                      </v-btn>
                    </v-flex>
                    <v-flex >
                      <v-btn
                        block
                        depressed
                        elevation="6"
                        rounded
                        x-large
                        color="blue lighten-2"
                        dark
                      >
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

</template>

<script>
import { mapState } from "vuex";
import { sync } from "vuex-pathify";

  export default {
    name: 'registerConsent',
    data: () => ({
    dialogContact: false,
    openDialog: false,
    drawerS: false,
    flag:'',
    drawer: "",
    policy:
      "1. คำแถลงว่าด้วยการคุ้มครองข้อมูลส่วนบุคคล1.1. นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ (“นโยบายคุ้มครองข้อมูลส่วนบุคคล”) อธิบายวิธีการที่บริษัท มิตซูบิชิ มอเตอร์ส (ประเทศไทย) จำกัด (ซึ่งต่อไปนี้จะเรียกว่า “MMTh” “เรา” หรือ “ของเรา”) เก็บรวบรวม ใช้ เก็บรักษา เปิดเผย และ/หรือ โอนไปยังต่างประเทศ ซึ่งข้อมูลส่วนบุคคลของลูกค้าในปัจจุบันและอนาคต (“คุณ” หรือ “ของคุณ”) (ตามที่นิยามไว้ในนโยบายนี้) โดยมีวัตถุประสงค์เพื่อคุ้มครองความเป็นส่วนตัวของข้อมูลส่วนบุคคลของคุณ1.2. นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ใช้กับช่องทางการสื่อสารทั้งออนไลน์หรือออฟไลน์ที่เราเก็บรวบรวมข้อมูลส่วนบุคคลของคุณ ไม่ว่าทางต่อหน้า ผ่านศูนย์บริการ โรงงาน สถานที่ประกอบกิจการของเรา งานกิจกรรม หรือ ทางโทรศัพท์ผ่านศูนย์บริการข้อมูลลูกค้า (call center) หรือทางออนไลน์ ผ่านทางอีเมล หรือแพลตฟอร์มโซเชียลมีเดีย (เช่น เว็บเพจ Facebook หรือ Line) และช่องทางอื่นๆ ที่เกี่ยวกับการจัดหาผลิตภัณฑ์และบริการให้แก่คุณ รวมถึงการใช้แอปพลิเคชัน Smartphone Link Gateway for M Connect) และ/หรือแอปพลิเคชันอื่นๆ (“แอปพลิเคชัน”) เว็บไซต์ของเรา https://www.mitsubishi-motors.co.th/th และ/หรือเว็บไซต์อื่นๆ (“เว็บไซต์”) และปฏิสัมพันธ์อื่นๆ ระหว่างคุณกับเรา (ซึ่งต่อไปนี้จะรวมเรียกกันว่า “ช่องทางการสื่อสาร”)1.3. เพื่อให้บรรลุวัตถุประสงค์ของนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ “ข้อมูลส่วนบุคคล” หมายถึงข้อมูลส่วนบุคคลหรือข้อมูลที่สามารถระบุตัวตนได้ตามที่นิยามไว้ในกฎหมายที่ใช้บังคับ ซึ่งรวมถึงข้อมูลส่วนบุคคลที่มีความละเอียดอ่อน (ตามที่นิยามไว้ในนโยบายนี้)1.4. MMTh มีความมุ่งมั่นในการดำเนินการเพื่อให้มั่นใจว่าความเป็นส่วนตัวของคุณจะได้รับความคุ้มครอง และการประมวลผลข้อมูลส่วนบุคคลของคุณจะเป็นไปตามกฎหมายและข้อบังคับที่เกี่ยวข้อง (ซึ่งอาจมีการแก้ไขเพิ่มเติมและมีการออกกฎหมายใหม่ใช้บังคับแทนเป็นครั้งคราว) เพื่อคุ้มครองข้อมูลส่วนบุคคลในประเทศที่เราเข้าไปและมุ่งหมายจะเข้าไปดำเนินธุรกิจ (“กฎหมายที่ใช้บังคับ”) MMTh จะเก็บรวบรวม ใช้ เก็บรักษา เปิดเผย และโอนไปยังต่างประเทศซึ่งข้อมูลส่วนบุคคลของคุณตามนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้เท่านั้น1.5. โปรดอ่านเนื้อหาต่อไปนี้อย่างระมัดระวังเพื่อทำความเข้าใจมุมมองและการปฏิบัติของ MMTh เกี่ยวกับข้อมูลส่วนบุคคลของคุณและวิธีการที่เราจะประมวลผลข้อมูลดังกล่าว ข้อมูลบางประการเกี่ยวกับคุณมีความจำเป็นสำหรับการจัดหาผลิตภัณฑ์และบริการให้แก่คุณ หากคุณไม่ตกลงที่จะให้ข้อมูลดังกล่าว เราจะไม่สามารถจัดหาผลิตภัณฑ์และบริการให้แก่คุณ และคุณจะไม่สามารถใช้หรือเข้าถึงฟังก์ชั่นและการใช้งานของบริการและผลิตภัณฑ์ของเราทั้งหมดได้1.6. โดยทั่วไปแล้วกิจกรรมของเรา (ซึ่งรวมถึงการให้บริการ และการจำหน่ายผลิตภัณฑ์) ไม่มุ่งเน้นที่ผู้เยาว์ คนเสมือนไร้ความสามารถ หรือคนไร้ความสามารถ ดังนั้น หากคุณมีอายุต่ำกว่า 20 ปี หรือยังไม่บรรลุนิติภาวะตามที่กำหนดในประเทศที่คุณอาศัยอยู่ เป็นคนเสมือนไร้ความสามารถ เป็นคนไร้ความสามารถ (แล้วแต่กรณี) เว้นแต่จะมีสิทธิตามกฎหมาย และคุณต้องการใช้บริการของเรา ใช้แอปพลิเคชันของเรา หรือบริการอื่นๆ จากเรา คุณจะต้องได้รับความยินยอมจากผู้ปกครองหรือผู้แทนโดยชอบธรรมก่อนติดต่อเราหรือก่อนให้ข้อมูลส่วนบุคคลแก่เรา เราไม่เก็บรวบรวมข้อมูลส่วนบุคคลหากเราทราบอยู่แล้วว่าข้อมูลดังกล่าวเป็นข้อมูลของผู้เยาว์ที่อายุน้อยกว่า 20 ปีโดยไม่ได้รับความยินยอมจากผู้ปกครองตามที่กฎหมายกำหนด หรือเป็นของคนเสมือนไร้ความสามารถหรือคนไร้ความสามารถโดยไม่ได้รับความยินยอมจากผู้พิทักษ์หรือผู้อนุบาลตามกฎหมาย1.7. นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ได้รับการปรับปรุงครั้งล่าสุดเมื่อ 20 เมษายน พ.ศ. 2563 MMTh สงวนสิทธิ์ โดยมีดุลยพินิจแต่เพียงผู้เดียว ในการปรับเปลี่ยน แก้ไข ลบ และปรับปรุงนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้เป็นครั้งคราว MMTh จะใช้ความพยายามตามสมควรเพื่อแจ้งให้คุณทราบและในลักษณะที่เหมาะสมถึงการปรับเปลี่ยนข้อกำหนดใดของนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ (เช่น โดยส่งนโยบายที่แก้ไขให้คุณทางอีเมล หรือโดยประกาศการเปลี่ยนแปลงดังกล่าวในช่องทางการสื่อสารของเรา) หากการเปลี่ยนแปลงใดๆ ของนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ต้องได้รับความยินยอมจากคุณตามกฎหมายที่ใช้บังคับ เราจะขอความยินยอมจากคุณเพื่อให้สอดคล้องกับการเปลี่ยนแปลงดังกล่าว",
    
    }),
  watch: {

     

  },
  computed: {
    ...mapState({
      page: store => store.getApi.page,
    }),
    ...sync("*"),
  },
  mounted() {},
  created() {},
  methods: {
    checkDataConsentFlage(){
      if(this.flag == 'true') {
        this.z = 'applicationFrom'
     }
    }
  },
    
    
  }
</script>
