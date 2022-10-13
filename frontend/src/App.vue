<template>
  <div id="app" class="py-5">
    <div class="logo">
      <div class="container">
        <img src="@/assets/images/logo.png" alt="Netwrix">
      </div>
    </div>
    <div class="header">
      <div class="container">
        <h1 class="header-title">Netwrix <br class="desktop-hidden">Partner Locator</h1>
        <div class="header-subtitle">Hundreds of Netwrix partners around the world are standing by to help you. <br class="desktop-visible">With our Partner Locator you can easily find the&nbsp;list of&nbsp;authorized partners in&nbsp;your&nbsp;area.</div>
        <div class="header-fields">
          <div class="header-search">
            <form @submit.prevent="handleSearch()">
              <input v-model="searchValue" type="text" class="header-search-input" placeholder="Search by company name or adress...">
              <button type="submit" class="header-search-button"><i class="fas fa-search"></i></button>
            </form>
          </div>
          <div class="header-selects">
            <div class="header-selects-types">
              <SelectBox
                class="select2-wrapper"
                :selected="selectedType"
                :options="typesOptions"
                placeholder="Type"
                @selected="selectedType = $event"
              />
            </div>
            <div class="header-selects-region">
              <SelectBox
                class="select2-wrapper"
                :selected="selectedCountry"
                :options="countriesOptions"
                placeholder="Country"
                @selected="selectedCountry = $event"
              />
              <SelectBox
                class="select2-wrapper"
                :selected="selectedState"
                :options="statesOptions"
                placeholder="State"
                :disabled="!statesOptions.length"
                @selected="selectedState = $event"
              />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container partners">
      <template v-if="pending">
        <div class="partners-message"><i class="fas fa-sync-alt fa-spin"></i> Please wait...</div>
      </template>
      <template v-else-if="!filteredPartners.length">
        <div class="partners-message">Your search parameters did&nbsp;not match any partners. Please try different search.</div>
      </template>
      <template v-else>
        <div v-for="partner in filteredPartners" :key="partner.id" class="partner" :id="`partner-${partner.id}`">
          <div class="partner-logo">
            <img :src="partner.logo" :alt="partner.company">
          </div>
          <div class="partner-company">
            <div class="partner-company-name">{{ partner.company }}</div>
            <div v-if="partner.address" class="partner-company-address">{{ partner.address }}</div>
          </div>
          <div class="partner-contacts">
            <div v-if="partner.website" class="partner-contacts-website">
              <a :href="partner.website" target="_blank">Website</a>
            </div>
            <div v-if="partner.phone" class="partner-contacts-phone">
              <a :href="`tel:${partner.phone.replace(/[^0-9+]/g, '')}`">{{ partner.phone }}</a>
            </div>
          </div>
          <div class="partner-status">{{ partner.status }}</div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import api from '@/clients/api'
import SelectBox from '@/components/SelectBox.vue'

const TYPES = [
  'MSP Partner',
  'Preferred Partner',
  'Premium Partner',
  'Elite Partner',
  'Distributor'
]

export default {
  components: {
    SelectBox
  },

  data: () => ({
    pending:          true,
    partners:         [],
    countries:        [],
    states:           [],
    selectedType:     null,
    selectedCountry:  null,
    selectedState:    null,
    searchValue:      null,
    search:           null
  }),

  computed: {
    selectedCountryId() {
      return this.countries.find((v) => v.shortName === this.selectedCountry)?.countryId;
    },

    typesOptions() {
      return TYPES
    },

    countriesOptions() {
      return this.countries.map((v) => ({ value: v.shortName, text: v.name }))
    },

    statesOptions() {
      return this.states
        .filter((v) => v.countryId === this.selectedCountryId)
        .map((v) => ({ value: v.shortName, text: v.name }))
    },

    filteredPartners() {
      return this.partners
        .filter((p) => !this.search || p.company.includes(this.search) || p.address.includes(this.search))
        .filter((p) => !this.selectedType || p.status === this.selectedType)
        .filter((p) => !this.selectedCountry || p.countriesCovered.includes(this.selectedCountry))
        .filter((p) => !this.selectedState || p.statesCovered.includes(this.selectedState))
    }
  },

  async mounted() {
    this.partners   = await api.partners()
    this.countries  = await api.countries()
    this.states     = await api.states()
    this.pending    = false
  },

  methods: {
    handleSearch() {
      this.search = this.searchValue
    }
  }
}
</script>

<style lang="scss">
@import '@/assets/styles/app.scss';
</style>
