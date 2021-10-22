/* eslint-disable no-inner-declarations */
// eslint-disable-next-line no-unused-vars
import Vue from 'vue'
// eslint-disable-next-line no-unused-vars
import axios from 'axios'
import moment from 'moment'
// import { CLIENT_RENEG_LIMIT } from 'tls';

let sysDate

export default {
  name: 'functions',

  moment(date) {
    const year = Number(moment(date).format('YYYY'))
    // console.log(year.length)
    const month = moment(date).format('MM')
    const day = moment(date).format('DD')
    const currentDate = (year + 543) + month + day
    // this.currentDate = currentDate
    return currentDate;
  },
  getSysDate() {
    // eslint-disable-next-line max-len
    return { date: sysDate().getDate(), month: sysDate().getMonth() + 1, year: sysDate().getFullYear() }
  },
  getSysTime() {
    let m = sysDate().getMinutes().toString()
    if (m.length === 1) m = `0${m}`
    let s = sysDate().getSeconds().toString()
    if (s.length === 1) s = `0${s}`
    // eslint-disable-next-line max-len
    return { hour: sysDate().getHours(), minute: m, second: s }
  },
  getDateFormat(date) {
    // console.log(date)
    let day = '-'
    let month = { digit: '-', long: '-', short: '-' }
    let year = '-'
    let long = '-'
    let short = '-'
    let format = {
      day,
      month,
      year,
      long,
      short,
    }
    if (date === 0) {
      return format
    }
    if ((`${date}`).length !== 8) {
      // console.log(date)
      long = date
      short = date
      return format
    }
    day = date % 100
    if (day === 0) {
      day = ''
    }
    year = Math.floor(date / 10000)
    year -= 543
    let m = Math.floor(date / 100) % 100
    if (m === 0) { m = '' }
    // let mShort = ''
    // let mLong = ''
    m = this.getThaiMonth(m)
    month = { digit: m.digit, long: m.long, short: m.short }
    long = `${day} ${m.long} ${year}`
    short = `${day} ${m.short} ${year}`
    format = {
      day,
      month,
      year,
      long,
      short,
    }
    return format
  },
  getThaiMonth(m) {
    let mShort = ''
    let mLong = ''
    switch (m) {
      case 1:
        mLong = 'January '
        mShort = 'ม.ค.';
        break
      case 2:
        mLong = 'February '
        mShort = 'ก.พ.';
        break
      case 3:
        mLong = 'March '
        mShort = 'มี.ค.';
        break
      case 4:
        mLong = 'April '
        mShort = 'เม.ย.';
        break
      case 5:
        mLong = 'May '
        mShort = 'พ.ค.';
        break
      case 6:
        mLong = 'June '
        mShort = 'มิ.ย.';
        break
      case 7:
        mLong = 'July '
        mShort = 'ก.ค.';
        break
      case 8:
        mLong = 'August '
        mShort = 'ส.ค.';
        break
      case 9:
        mLong = 'September '
        mShort = 'ก.ย.';
        break
      case 10:
        mLong = 'October '
        mShort = 'ต.ค.';
        break
      case 11:
        mLong = 'November '
        mShort = 'พ.ย.';
        break
      case 12:
        mLong = 'December '
        mShort = 'ธ.ค.';
        break
      default:
        mLong = ''
        mShort = mLong
    }
    return { digit: m, long: mLong, short: mShort }
  },
  getThaiYear(y) {
    if (y < 2400) {
      y += 543
    }
    return y
  },
  getAge(bdate) {
    const bd = this.getDateFormat(bdate)
    if (bd.year === 0 || bd.year === '-') { return '-' }
    let age = (this.getSysDate().year + 543) - bd.year
    // if (age == 0) {
    //   const m = sysDate().getMonth() - bd.month.digit
    //   return `${0}.${m}`
    // }
    if (bd.month === '') { return age }
    if (this.getSysDate().month === bd.month.digit) {
      if (bd.day === '') { return age }
      if (this.getSysDate().date < bd.day) {
        age -= 1
      }
    } else if (this.getSysDate().month < bd.month.digit) {
      age -= 1
    }
    console.log(`age ${age}`)
    return age
  },
  getTimeFormat(time, noSec = true) {
    try {
      if (time === 0) { return '-' }
      let t = (`0${time}`).slice(-8)
      if (noSec) {
        t = `${t.slice(0, 2)}:${t.slice(2, 4)} น.`
      } else {
        t = `${t.slice(0, 2)}:${t.slice(2, 4)}:${t.slice(4, 6)} น.`
      }
      if (t.startsWith(0)) t = t.slice(1)
      return t
    } catch (e) {
      return e
    }
  },
}
