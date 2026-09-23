<script setup>
import { useIsSlideActive, useNav } from '@slidev/client'
import { annotate } from '@slidev/rough-notation'
import { onMounted, onUnmounted, ref, watch } from 'vue'

const props = defineProps({
  type: { type: String, default: 'underline' },
  color: { type: String, default: 'orange' },
  delay: { type: Number, default: 500 },
})

// Spelled out so UnoCSS generates them; the class is built from the prop at runtime.
const colors = { orange: 'text-orange', red: 'text-red', green: 'text-green', blue: 'text-blue' }

const el = ref()
const isActive = useIsSlideActive()
const { isPrintMode } = useNav()
let annotation
let timer

// v-mark without a click number draws once on mount, and Slidev mounts neighbouring slides
// ahead of time, so the stroke would finish before anyone sees it. Draw on each slide enter.
onMounted(() => {
  annotation = annotate(el.value, {
    type: props.type,
    class: colors[props.color] ?? props.color,
    animationDuration: isPrintMode.value ? 1 : 800,
  })
  watch(isActive, (active) => {
    clearTimeout(timer)
    if (!active)
      return annotation.hide()
    timer = setTimeout(() => annotation.show(), isPrintMode.value ? 0 : props.delay)
  }, { immediate: true })
})

onUnmounted(() => {
  clearTimeout(timer)
  annotation?.remove()
})
</script>

<template>
  <span ref="el"><slot /></span>
</template>
