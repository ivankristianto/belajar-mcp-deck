<script setup>
import { computed } from 'vue'

const props = defineProps({ mode: { type: String, default: 'mesh' } })

const ais = [
  { label: 'Claude', y: 70 },
  { label: 'ChatGPT', y: 150 },
  { label: 'Codex', y: 230 },
]
const svcs = [
  { label: 'Hosting', y: 55 },
  { label: 'Database', y: 118 },
  { label: 'DNS', y: 181 },
  { label: 'Git', y: 244 },
]

const meshLines = computed(() =>
  ais.flatMap(a => svcs.map(s => ({ key: `${a.label}-${s.label}`, y1: a.y, y2: s.y }))),
)
const isMcp = computed(() => props.mode === 'mcp')
</script>

<template>
  <svg viewBox="0 0 460 300" class="mesh w-full max-w-lg mx-auto">
    <g class="lines" :style="{ opacity: isMcp ? 0 : 1 }">
      <line v-for="l in meshLines" :key="l.key" x1="106" :y1="l.y1" x2="354" :y2="l.y2" />
    </g>

    <g class="lines hub-lines" :style="{ opacity: isMcp ? 1 : 0 }">
      <line v-for="a in ais" :key="a.label" x1="106" :y1="a.y" x2="196" y2="150" />
      <line v-for="s in svcs" :key="s.label" x1="264" y1="150" x2="354" :y2="s.y" />
    </g>

    <g class="hub" :style="{ opacity: isMcp ? 1 : 0, transform: isMcp ? 'scale(1)' : 'scale(0.6)' }">
      <rect x="196" y="130" width="68" height="40" rx="8" />
      <text x="230" y="155" text-anchor="middle">MCP</text>
    </g>

    <g class="node" v-for="a in ais" :key="a.label">
      <rect x="18" :y="a.y - 17" width="88" height="34" rx="6" />
      <text x="62" :y="a.y + 5" text-anchor="middle">{{ a.label }}</text>
    </g>

    <g class="node svc" v-for="s in svcs" :key="s.label">
      <rect x="354" :y="s.y - 17" width="88" height="34" rx="6" />
      <text x="398" :y="s.y + 5" text-anchor="middle">{{ s.label }}</text>
    </g>
  </svg>
</template>

<style scoped>
.lines {
  transition: opacity 500ms ease;
}
.lines line {
  stroke: currentColor;
  stroke-opacity: 0.28;
  stroke-width: 1;
}
.hub-lines line {
  stroke: var(--accent, #3b6ea5);
  stroke-opacity: 0.75;
  stroke-width: 1.5;
}

.hub {
  transition: opacity 500ms ease, transform 500ms cubic-bezier(0.34, 1.4, 0.64, 1);
  transform-origin: 230px 150px;
}
.hub rect {
  fill: var(--accent-soft, #3b6ea51f);
  stroke: var(--accent, #3b6ea5);
  stroke-width: 2;
}
.hub text {
  fill: var(--accent, #3b6ea5);
  font-size: 15px;
  font-weight: 700;
  letter-spacing: 0.5px;
}

.node rect {
  fill: transparent;
  stroke: currentColor;
  stroke-opacity: 0.35;
  stroke-width: 1.2;
}
.node text {
  fill: currentColor;
  fill-opacity: 0.8;
  font-size: 13px;
}
</style>
