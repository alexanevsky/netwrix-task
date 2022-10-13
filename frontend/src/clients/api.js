import axios from 'axios'

export default {
  async partners() {
    return await axios.get('http://localhost:8000/api/partners')
      .then((r) => r.data.partners)
  },

  async countries() {
    return await axios.get('http://localhost:8000/api/countries')
      .then((r) => r.data.countries)
  },

  async states() {
    return await axios.get('http://localhost:8000/api/states')
      .then((r) => r.data.states)
  }
}
