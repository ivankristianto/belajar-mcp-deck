<script setup>
defineProps({
  label: { type: String, default: 'Prompt' },
  tone: { type: String, default: 'read' },
})
</script>

<template>
  <div class="prompt" :data-tone="tone">
    <div class="tag">{{ label }}</div>
    <div class="body"><slot /></div>
  </div>
</template>

<style scoped>
.prompt {
  border-radius: 8px;
  border: 1px solid color-mix(in srgb, currentColor 14%, transparent);
  background: color-mix(in srgb, currentColor 4%, transparent);
  padding: 0.75rem 1rem 0.85rem;
  margin: 0.5rem 0;
}
.tag {
  font-size: 0.62rem;
  letter-spacing: 0.09em;
  text-transform: uppercase;
  opacity: 0.55;
  margin-bottom: 0.35rem;
}
.body {
  font-family: var(--slidev-code-font-family, ui-monospace, monospace);
  font-size: 0.8rem;
  line-height: 1.55;
}
.prompt[data-tone='read'] { border-left: 3px solid var(--safe, #5a8a6b); }
.prompt[data-tone='write'] { border-left: 3px solid var(--warn, #b4884a); }
.prompt[data-tone='danger'] { border-left: 3px solid var(--danger, #a35648); }
</style>
