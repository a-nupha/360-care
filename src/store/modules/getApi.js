const state = {
  login: null,
  SetDataMenuRequest: null,

}
const actions = {
  // eslint-disable-next-line no-unused-vars
  // eslint-disable-next-line no-shadow
  setDataLogin({ commit, state }, payload) {
    commit('SET_LOGIN', payload)
    // console.log('state in store', state)
  },
}
const mutations = {
  // eslint-disable-next-line no-shadow
  SET_LOGIN(state, payload) {
    state.login = payload
  },
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
}
