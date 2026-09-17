<script setup>
defineProps({ active: { type: Number, default: 0 } })

const steps = [
  { n: 1, label: 'Terima tujuan', x: 210, y: 55, lx: 210, ly: 20 },
  { n: 2, label: 'Pilih tool', x: 305, y: 150, lx: 355, ly: 154 },
  { n: 3, label: 'Jalankan', x: 210, y: 245, lx: 210, ly: 288 },
  { n: 4, label: 'Baca hasil', x: 115, y: 150, lx: 65, ly: 154 },
]
</script>

<template>
  <svg viewBox="0 0 420 300" class="agent-loop w-full max-w-lg mx-auto">
    <circle cx="210" cy="150" r="95" class="ring" />

    <g class="orbit">
      <circle cx="210" cy="55" r="5" class="dot" />
    </g>

    <g v-for="s in steps" :key="s.n" :class="['node', { on: active === s.n }]">
      <circle :cx="s.x" :cy="s.y" r="27" />
      <text :x="s.x" :y="s.y + 5" text-anchor="middle" class="num">{{ s.n }}</text>
      <text :x="s.lx" :y="s.ly" text-anchor="middle" class="label">{{ s.label }}</text>
    </g>

    <text x="210" y="145" text-anchor="middle" class="center">ulangi</text>
    <text x="210" y="165" text-anchor="middle" class="center">sampai selesai</text>
  </svg>
</template>

<style scoped>
.agent-loop { font-family: inherit; }

.ring {
  fill: none;
  stroke: currentColor;
  stroke-opacity: 0.18;
  stroke-width: 1.5;
  stroke-dasharray: 4 7;
}

.orbit {
  transform-origin: 210px 150px;
  animation: orbit 9s linear infinite;
}
.dot { fill: var(--accent, #3b6ea5); }

@keyframes orbit {
  to { transform: rotate(360deg); }
}

.node circle {
  fill: transparent;
  stroke: currentColor;
  stroke-opacity: 0.3;
  stroke-width: 1.5;
  transition: all 400ms ease;
}
.node .num {
  fill: currentColor;
  fill-opacity: 0.45;
  font-size: 15px;
  font-weight: 600;
  transition: fill-opacity 400ms ease;
}
.node .label {
  fill: currentColor;
  fill-opacity: 0.55;
  font-size: 13px;
  transition: fill-opacity 400ms ease;
}

.node.on circle {
  fill: var(--accent-soft, #3b6ea51f);
  stroke: var(--accent, #3b6ea5);
  stroke-opacity: 1;
  stroke-width: 2;
}
.node.on .num,
.node.on .label { fill-opacity: 1; }
.node.on .label { font-weight: 600; }

.center {
  fill: currentColor;
  fill-opacity: 0.35;
  font-size: 11px;
  font-style: italic;
}

@media (prefers-reduced-motion: reduce) {
  .orbit { animation: none; }
}
</style>
