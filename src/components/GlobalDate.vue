<template>
  <v-layout row>
    <v-flex
      pa-0
      xs12
      d-inline-flex
    >
      <v-flex xs11>
        <v-text-field
          v-model="dateText"
          prepend-icon=" "
          :label="label"
          mask="##/##/####"
          placeholder=" "
          persistent-hint
          :readonly="setReadonly"
          :disabled="setDisabled"
          :class="{&quot;text-no-border&quot; : setDisabled}"
        />
      </v-flex>
      <v-flex
        xs1
        pt-2
        pr-4
      >
        <v-menu
          ref="menu"
          v-model="menu"
          :close-on-content-click="false"
          lazy
          transition="scale-transition"
          offset-y
          full-width
          :disabled="setReadonly"
        >
          <v-icon
            slot="activator"
            ref="icon"
            style="margin-top:10px"
            color="primary"
          >
            event
          </v-icon>
          <!-- <v-btn
            small
            slot='activator'
            ref='icon'
            style="padding-top:11px;margin-top:0px;margin-left:0px"
            flat
            icon
            color="primary"
          >
            <v-icon>event</v-icon>
          </v-btn> -->
          <v-date-picker
            v-model='dateCalendar'
            color="primary"
            header-color="primary"
            locale="th"
            :readonly="setReadonly"
          />
        </v-menu>
      </v-flex>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name: 'GlobalDate',
  props: {
    value: null ,
    label: {
      default: 'วันเกิด',
    },
    disabled: {
      default: false,
    },
    readonly: {
      default: false,
    },
  },
  data() {
    return {
      date: null,
      Store: this.$store.state,
      dateFormat: null,
      menu: false,
    };
  },
  computed: {
    setDisabled: {
      get() {
        return this.disabled;
      },
      set() {},
    },
    setReadonly: {
      get() {
        return this.readonly;
      },
      set() {},
    },
    dateText: {
      get() {
        return this.dateFormat;
      },
      set(newVal) {
        if (newVal) {
          this.dateFormat = newVal;
          this.date = this.parseDate(this.dateFormat);
          this.$emit("update:value", this.formatToYYYYMMDD(this.dateFormat));
        } else {
          this.dateFormat = null;
          this.date = null;
          this.$emit("update:value", 0);
        }
      },
    },
    dateCalendar: {
      get() {
        return this.date;
      },
      set(newVal) {
        this.menu = false;
        this.date = newVal;
        this.dateFormat = this.formatDate(this.date);
        this.$emit("update:value", this.formatToYYYYMMDD(this.dateFormat));
      },
    },
  },
  watch: {
    value(newVal) {
      if (newVal) {
        if (newVal && this.dateFormat == null) {
          this.dateText = this.formatToDDMMYYYY(newVal);
        } else if (this.dateFormat.length == 8) {
          this.dateText = this.formatToDDMMYYYY(newVal);
        }
      } else {
        this.dateText = null;
      }
    },
  },
  created() {
    this.setDate();
  },
  methods: {
    setDate() {
      if (this.value == 0) return;
      this.date = this.value.toString();
      this.dateText = this.formatToDDMMYYYY(this.date);
    },
    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split('-');

      return `${day ? day.padStart(2, '0') : '00'}${
        month ? month.padStart(2, '0') : '00'
      }${String(Number(year) + 543).padStart(4, '0')}`;
    },
    parseDate(date) {
      if (!date) return;
      if (date.length != 8) return;

      const [day, month, year] = [
        date.substring(0, 2),
        date.substring(2, 4),
        Number(date.substring(4)),
      ];

      let dates = '';
      const [y, m, d] = this.getDayMonthYearForZeroPad(day, month, year);
      dates = `${y}-${m}-${d}`;

      return dates;
    },
    formatToDDMMYYYY(date) {
      const data = `${date.toString().padEnd(8, '0')}`;
      // let data = date
      const [year, month, day] = [
        data.substring(0, 4),
        data.substring(4, 6),
        data.substring(6),
      ];

      return `${day}${month}${year}`;
    },
    formatToYYYYMMDD(date) {
      const data = `${date.toString().padEnd(8, '0')}`;

      const [year, month, day] = [
        data.substring(4),
        data.substring(2, 4),
        data.substring(0, 2),
      ];
      return `${year}${month}${day}`;
    },
    getDayMonthYearForZeroPad(day, month, year) {
      const y = String(Math.abs(year - 543)).padStart(4, '0');
      const m = Number(month) ? `${month.padStart(2, '0')}` : '00';
      const d = Number(day) ? `${day.padStart(2, '0')}` : '00';
      return [y, m, d];
    },
  },
};
</script>

<style>
.v-date-picker-table {
  height: auto;
}
</style>

<style scoped>
.text-no-border >>> .v-input__slot:before,
.text-no-border >>> .v-input__slot:after,
.text-no-border >>> input {
  border-style: none;
  margin-bottom: 0px;
}

.theme--light >>> table tbody tr:hover:not(.v-datatable__expand-row),
.theme--light >>> table tbody tr[active] {
  background-color: #ffffff !important;
}
</style>
