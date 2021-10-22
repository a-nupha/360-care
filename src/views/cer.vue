<template>
  <div>
      <v-btn color="blue" class="white--text" @click="print">report</v-btn>
  </div>
</template>
<script>
import pdfmakeCustom from '@cdglib/js-pdfmake-custom/src/plugin/pdfmake-custom';
import printDoc from '@cdglib/js-pdfmake-custom/src/pdf/print';
import { sync } from 'vuex-pathify'
import functions from '../plugins/functions'
import store from '../store/store'


export default {
  name: 'Pdf',
  data() {
    return {
      data: {
        functions,
        Store: this.$store.state,
        detail: [
          {
            date: '12/06/2562',
            code: '2423423423523',
            name: 'sss1 ssss ssss',
            count_in: '10',
            count_out: '104',
            invert: '100',
            profit: '10',
            balance: '20',
            lost: '2',
            other: 'eqw',
          },
          {
            date: '12/06/2562',
            code: '234234234234235',
            name: 'sss1 ssss ',
            count_in: '41',
            count_out: '411',
            invert: '200',
            profit: '12',
            balance: '2222',
            lost: '1',
            other: 'eqw',
          },
          {
            date: '14/06/2562',
            code: '5345345345345',
            name: 'sss ssss',
            count_in: '51',
            count_out: '777',
            invert: '212122',
            profit: '122',
            balance: '2211',
            lost: '21',
            other: 'eqw',
          },
          {
            date: '14/06/2562',
            code: '4234234234234',
            name: ' sss',
            count_in: '11',
            count_out: '77',
            invert: '2121',
            profit: '1',
            balance: '21',
            lost: '212',
            other: 'eqw',
          },
          {
            date: '14/06/2562',
            code: '523523423432423',
            name: 'sss1 rwe ssss',
            count_in: '10',
            count_out: '89',
            invert: '231',
            profit: '1',
            balance: '1232',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '4234252523523',
            name: 'werwer ssss ssss',
            count_in: '81',
            count_out: '778',
            invert: '123',
            profit: '1',
            balance: '1223',
            lost: '323',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '5235355235423',
            name: 'sss1 ssss rwer',
            count_in: '1',
            count_out: '0',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '534534523',
            name: 'sss1 ss342ss ssss',
            count_in: '1',
            count_out: '878',
            invert: '3213',
            profit: '1',
            balance: '3312',
            lost: '3213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '423423423',
            name: '34234 ssss ssss',
            count_in: '91',
            count_out: '778',
            invert: '213',
            profit: '1',
            balance: '32131',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '3213213213',
            name: 'sss1 34234 ssss',
            count_in: '32',
            count_out: '92',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '321',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '73010477988',
            name: '2312 ssss ssss',
            count_in: '12',
            count_out: '145',
            invert: '213',
            profit: '1',
            balance: '3213',
            lost: '3213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '5235355235423',
            name: 'sss1 ssss rwer',
            count_in: '1',
            count_out: '0',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '534534523',
            name: 'sss1 ss342ss ssss',
            count_in: '1',
            count_out: '878',
            invert: '3213',
            profit: '1',
            balance: '3312',
            lost: '3213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '423423423',
            name: '34234 ssss ssss',
            count_in: '91',
            count_out: '778',
            invert: '213',
            profit: '1',
            balance: '32131',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '3213213213',
            name: 'sss1 34234 ssss',
            count_in: '32',
            count_out: '92',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '321',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '73010477988',
            name: '2312 ssss ssss',
            count_in: '12',
            count_out: '145',
            invert: '213',
            profit: '1',
            balance: '3213',
            lost: '3213',
            other: 'eqw',
          },
        ],
      },
    }
  },
  computed: {
    ...sync('*'),

  },
  methods: {
    createID1(data) {
      this.index = 0
      const formatBody = data
        .map(d => ({
          date: `${d.date}`,
          barcode: `${d.barcode}`,
          name: `${d.name}`,
          in: `${d.in}`,
          out: `${d.out}`,
          cost: `${d.cost}`,
          price: `${d.price}`,
          total_cost: `${d.total_cost}`,
          sale: `${d.sale}`,
          total_sale: `${d.total_sale}`,
          items_lost: `${d.items_lost}`,
          total_lost: `${d.total_lost}`,
          broken: `${d.broken}`,
          total_broken: `${d.total_broken}`,
          quantity_stock: `${d.quantity_stock}`,
        }))
      const body = formatBody.map(f => ({
        style: 'content',
        table: {
          widths: [50, 70, 80, 40, 40, 40, 40, 40, 40, 40, 40,40,40, '*'],
          body: [
            [
              { text: `${f.date}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.barcode}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.name}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.in}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.out}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.cost}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.total_cost}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.price}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.sale}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.broken}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.items_lost}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.total_sale}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.total_lost}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.total_broken}`, alignment: 'center', border: [true, true, true, false] },
            ],
          ],
        },
      }))
      return {
        body,
      }
    },
    // empty line
    space() {
      const body = []
      const a = {
        style: 'content',
        table: {
          widths: [50, 70, 80, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40,40,40, '*'],
          body: [
            [
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
            ],
          ],
        },
      }
      for (let i = 0; i < 3; i += 1) {
        body.push(a)
      }

      return { body }
    },
    async print() {
      const layout1 = {
        info: {
          title: 'filename',
          author: 'Core Solutions Co.,Ltd.',
          subject: 'subject of document',
          keywords: 'keywords for document',
        },
        content: [
          {
            style: 'header',
            text: [
              `Transaction in-out ${functions.getDateFormat(String(store.state.aDateIn)).long} - ${functions.getDateFormat(String(store.state.aDateOut)).long} \n`,
            ],
            bold: true,
          },
          // {
          //   style: 'content',
          //   text: [
          //     '\nมูลค่ารวมของสินค้าคงคลัง 4649.00 บาท รายการสินค้าคงคลัง 2\n\n',
          //   ],
          // },

          {
            style: 'content',
            table: {
              widths: [50, 70, 80, 40, 40, 40, 40, 40, 40, 40, 40, 40, 40, '*'],
              body: [
                [
                  { text: 'date', alignment: 'center', border: [true, true, true, false] },
                  { text: 'barcode', alignment: 'center', border: [true, true, true, false] },
                  { text: 'product name', alignment: 'center', border: [true, true, true, false] },
                  { text: 'quantity in', alignment: 'center', border: [true, true, true, false] },
                  { text: 'quantity out', alignment: 'center', border: [true, true, true, false] },
                  { text: 'cost(THB/pic)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'total cost(THB)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'price(THB/pic)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'sale(pic)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'broken(pic)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'lost(pic)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'total sale(THB)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'total lost(THB)', alignment: 'center', border: [true, true, true, false] },
                  { text: 'total broken(THB)', alignment: 'center', border: [true, true, true, false] },
                ],
              ],
            },
            bold: true,
            layout: {
              defaultBorder: false,
            },
          },
          ...this.createID1(store.state.dataStock).body,
          // ...this.space().body, // empty line

          // Footer
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  {
                    text: 'All Items Out', alignment: 'left', border: [true, true, true, false], colSpan: 8,
                  },
                  { text: '', alignment: 'left', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: store.state.Input, alignment: 'center', border: [false, true, true, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  {
                    text: 'All Item In', alignment: 'left', border: [true, true, true, false], colSpan: 8,
                  },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: store.state.output, alignment: 'center', border: [false, true, true, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  {
                    text: 'All Stock', alignment: 'left', border: [true, true, true, false], colSpan: 8,
                  },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: store.state.Stock, alignment: 'center', border: [false, true, true, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
        ],
        styles: {
          header: {
            fontSize: 16,
            alignment: 'center',
          },
          content: {
            fontSize: 12,
            alignment: 'left',
          },
        },
      }
      const option = {
        orientation: 'landscape',
        margin: [20, 35, 20, 20],
        font: this.font,
      }
      const pdf = await pdfmakeCustom.pdfMake.createPdfToDataUrl(layout1, option)
      printDoc(pdf)
    },
  },
}
</script>
