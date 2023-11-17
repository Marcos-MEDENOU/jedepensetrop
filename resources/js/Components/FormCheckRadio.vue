<script setup>
import { computed } from 'vue'
const props = defineProps({
  name: {
    type: String,
    required: true
  },
  type: {
    type: String,
    default: 'checkbox',
    validator: value => ['checkbox', 'radio', 'switch'].includes(value)
  },
  label: {
    type: String,
    default: null
  },
  modelValue: {
    type: [Array, String, Number, Boolean],
    default: null
  },
  inputValue: {
    type: [String, Number, Boolean],
    required: true
  }
})
const emit = defineEmits(['update:modelValue'])
const computedValue = computed({
  get: () => props.modelValue,
  set: value => {
    emit('update:modelValue', value)
  }
})
const inputType = computed(() => props.type === 'radio' ? 'radio' : 'checkbox')

// Nouvelle propriété pour déterminer si l'option est cochée
let isChecked = computed(() => props.modelValue[0] === props.inputValue)

function handleChange() {
  // Émettre la nouvelle valeur lorsque l'option est sélectionnée
  if (props.type === 'radio') {
    emit('update:modelValue', props.inputValue)
  } else {
    // Pour les cases à cocher, basculer la valeur
    emit('update:modelValue', !computedValue.value)
  }
}
</script>

<template>

  <label :class="type" class="mb-3 mr-6 last:mr-0 ">
    <input v-model="computedValue" 
    :type="inputType" 
    :name="name" 
    :value="Number(inputValue)" 
    :checked="inputValue==modelValue"
    >
    <span class="check" />
    <span class="pl-2">{{ label }}</span>
  </label>
</template>