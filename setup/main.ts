import { useDarkMode } from '@slidev/client'
import { defineAppSetup } from '@slidev/types'

// Light is the default scheme. `colorSchema` has to stay `auto` for `d` to toggle, so the
// default is applied once per browser and any toggle after that is remembered as usual.
export default defineAppSetup(() => {
  try {
    if (localStorage.getItem('deck-light-default'))
      return
    localStorage.setItem('deck-light-default', '1')
    useDarkMode().isDark.value = false
  }
  catch {}
})
