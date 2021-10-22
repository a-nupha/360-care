/* eslint-disable consistent-return */
/* eslint-disable vars-on-top */
/* eslint-disable no-var */
import Axios from 'axios';
import store from '../../store/store'

const funcs = {
  async deleteUser(data) {
    console.log(data, 'test')
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/deleteusers.php';
    var params = new URLSearchParams();
    params.append('pid', data)
    const response = await Axios.post(api, params)
    if (response.data === true) {
      const index = store.state.dataUserApi.indexOf(store.state.getdataTableDelte)
      store.state.dataUserApi.splice(index, 1)
      store.state.SnacbarDeleteUser = false
    } else {
      console.log('response.data', response.data)
    }
  },

  async editUser(data) {
    console.log('editUser', data)
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/deleteuser.php';
    var params = new URLSearchParams();
    params.append('pid', data.pid)
    params.append('index2', data.Password)
    params.append('role_id', data.role)
    const response = await Axios.post(api, params)
    // eslint-disable-next-line no-unused-vars
    store.state.editUser = response.data
    console.log(response.data, 'test')
  },

  async login(userName, passWord) {
    console.log('data', userName);
    // eslint-disable-next-line no-var
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/login.php';
    // eslint-disable-next-line no-var
    // eslint-disable-next-line vars-on-top
    var params = new URLSearchParams();
    params.append('userName', userName)
    params.append('passWord', passWord)
    console.log('params', userName)
    console.log('params', passWord)
    const response = await Axios.post(api, params)
    // eslint-disable-next-line no-unused-vars
    store.state.dataLogin = response.data
    console.log(response.data, 'js')
  },
  search() {
    return new Promise((resolve, reject) => {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/select.php';
      Axios.get(api)
        .then((response) => {
          const retData = response.data
          console.log('value', retData)
          store.state.dataSelect = retData
          resolve(response);
          console.log(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  getCate() {
    return new Promise((resolve, reject) => {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/getCate.php';
      Axios.get(api)
        .then((response) => {
          const retData = response.data
          console.log('dataCate', retData)
          resolve(response);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  async save(data) {
    console.log('data', data.username)
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/save.php';
    var params = new URLSearchParams();
    params.append('index1', data.username)
    params.append('index2', data.password)
    params.append('email', data.email)
    params.append('fname', data.fname)
    params.append('lname', data.lname)
    params.append('tname', data.tname)
    params.append('pid', data.pid)
    params.append('flag_id', data.flag_id)
    params.append('now_date', data.now_date)
    params.append('rcode_id', data.rcode_id)
    params.append('role_id', data.role_id)
    const response = await Axios.post(api, params)
    store.state.msgSave = response.data
    console.log('store.state.msgSave', store.state.msgSave)
  },
  async selectBranch(data) {
    console.log('data==>branch', data);
    // eslint-disable-next-line no-var
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/selectBranch.php';
    // eslint-disable-next-line no-var
    // eslint-disable-next-line vars-on-top
    var params = new URLSearchParams();
    params.append('branch_id', data)
    const response = await Axios.post(api, params)
    // eslint-disable-next-line no-unused-vars
    store.state.dataBranch = response.data
  },
  async insertBranchName(data) {
    console.log('insert==>branch', data);
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/insertBranchName.php';
    var params = new URLSearchParams();
    params.append('branch_id', data.branch)
    params.append('branch_name', data.branchName)
    const response = await Axios.post(api, params)
    store.state.dataBranch = response.data
  },
}

export default funcs
