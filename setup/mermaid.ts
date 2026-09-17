import { useDarkMode } from '@slidev/client'
import { defineMermaidSetup } from '@slidev/types'

// Slidev renders mermaid into a shadow root, so the deck stylesheet cannot reach it and
// the diagram has to be themed through mermaid's own variables. The setup function runs
// once, so these are getters: mermaid re-reads them on every render, and a render is
// triggered whenever the colour scheme changes.
export default defineMermaidSetup(() => {
  const { isDark } = useDarkMode()
  const pick = (dark: string, light: string) => (isDark.value ? dark : light)

  return {
    // Only used for the light scheme. In dark, Slidev passes theme 'dark' per block,
    // which overrides this; the variables below still apply on top of either.
    theme: 'base',
    themeVariables: {
      get background() { return pick('#1a1d24', '#fbfbf9') },
      get primaryColor() { return pick('#252a33', '#f1f1ee') },
      get primaryTextColor() { return pick('#e6e8ec', '#1d1f24') },
      get primaryBorderColor() { return pick('#4a5160', '#c9c9c2') },
      get lineColor() { return pick('#6b7383', '#9a9a92') },
      get secondaryColor() { return pick('#2b313b', '#e9e9e4') },
      get tertiaryColor() { return pick('#20242c', '#f5f5f1') },
      get mainBkg() { return pick('#252a33', '#f1f1ee') },
      get clusterBkg() { return pick('#20242c', '#f5f5f1') },
      get clusterBorder() { return pick('#3d434f', '#d7d7d0') },
      get textColor() { return pick('#e6e8ec', '#1d1f24') },
      get edgeLabelBackground() { return pick('#1a1d24', '#fbfbf9') },
      fontFamily: 'Plus Jakarta Sans, sans-serif',
    },
  }
})
