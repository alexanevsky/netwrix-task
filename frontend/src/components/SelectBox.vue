<template>
  <div>
    <select ref="select" :value="selected" :disabled="disabled" @change="handleInput($event)">
      <option v-if="placeholder" value="-">{{ placeholder }}</option>
      <option v-for="option in normalizedOptions" :key="option.value" :value="option.value">{{ option.text }}</option>
    </select>
  </div>
</template>

<script>
import $ from 'jquery'
import 'select2'

export default {
  props: {
    selected: {
      type: String
    },
    options: {
      type: Array,
      default: () => [],
      validator: (v) => !v.filter((o) => typeof o !== 'string' && !o.value && !o.text).length
    },
    placeholder: {
      type: String
    },
    disabled: {
      type: Boolean
    }
  },

  computed: {
    normalizedOptions() {
      return this.options.map((o) => typeof o === 'string' ? { value: o, text: o } : o)
    }
  },

  mounted() {
    $(this.$refs.select).select2({
      placeholder: this.placeholder,
      disabled: this.disabled
    })

    $(this.$refs.select).on('select2:select', (e) => {
      this.$emit('selected', e.target.value === '-' ? null : e.target.value)
    })
  },

  methods: {
    handleInput(e) {
      this.$emit('selected', e.target.value)
    }
  }
}
</script>
