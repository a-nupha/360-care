<template>
  <v-app id="app">

   <transition name="component-fade" mode="out-in">
              <component v-bind:is="z"></component>
    </transition>
                  
    

    <v-footer app bottom absolute padless>
      <v-card flat tile width="100%" class="primary lighten-1 text-center">
        <v-divider></v-divider>

        <v-card-text class="white--text">
          {{ new Date().getFullYear() }} — <strong>&copy; 365-care </strong>
        </v-card-text>
      </v-card>
    </v-footer>
  </v-app>
</template>

<script>
// import HelloWorld from './components/HelloWorld';
import { mapState } from "vuex";
import { sync } from "vuex-pathify";
import registerConsent from './components/registerConsent.vue';
import applicationFrom from './components/applicationFrom.vue';



export default {
  name: "App",

  components: {
    registerConsent,
    applicationFrom,
  },
  computed: {
    ...mapState({
      page: store => store.getApi.page,
    }),
    ...sync("*"),
  },
  data: () => ({
    
  }),
  watch: {

  },
  mounted() {},
  created() {},
  methods: {

  },
};
</script>
