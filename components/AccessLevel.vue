<script setup>
defineProps({
  name: String,
  desc: String,
  tone: { type: String, default: 'safe' },
})
</script>

<template>
  <div class="lvl" :data-tone="tone">
    <div class="name">{{ name }}</div>
    <div class="desc">{{ desc }}</div>
  </div>
</template>

<style scoped>
.lvl {
  border: 1px solid currentColor;
  border-color: color-mix(in srgb, currentColor 18%, transparent);
  border-left-width: 3px;
  border-radius: 6px;
  padding: 0.7rem 0.9rem;
  background: color-mix(in srgb, currentColor 3%, transparent);
}
.name {
  font-weight: 600;
  font-size: 0.95rem;
  margin-bottom: 0.2rem;
}
.desc {
  font-size: 0.78rem;
  opacity: 0.68;
  line-height: 1.4;
}

.lvl[data-tone='danger'] { border-left-color: var(--danger, #a35648); }
.lvl[data-tone='danger'] .name { color: var(--danger, #a35648); }
.lvl[data-tone='warn'] { border-left-color: var(--warn, #b4884a); }
.lvl[data-tone='warn'] .name { color: var(--warn, #b4884a); }
.lvl[data-tone='safe'] { border-left-color: var(--safe, #5a8a6b); }
.lvl[data-tone='safe'] .name { color: var(--safe, #5a8a6b); }
.lvl[data-tone='lock'] { border-left-color: var(--accent, #3b6ea5); }
.lvl[data-tone='lock'] .name { color: var(--accent, #3b6ea5); }
</style>
