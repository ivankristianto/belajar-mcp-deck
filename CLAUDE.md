# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A [Slidev](https://sli.dev) deck for "Otomasi AI Agent: Kelola Website dan Hosting pakai MCP", a Kelas Tanya DomaiNesia webinar on 24 September 2026.

The deck is 27 slides and written in Indonesian. The preparation material behind it is in English and lives in `docs/` — `docs/outline.md` holds the segment timings the deck is built against, and `docs/README.md` indexes the rest. Change the deck and the outline together; they are meant to agree.

## Commands

```bash
npm install
npm run dev      # slidev --open, serves at http://localhost:3030
npm run build    # static SPA into dist/
npm run export   # PDF/PNG/PPTX export
```

There is no test suite and no linter configured.

`npm run export` needs `playwright-chromium`, which is not a declared dependency. Install it before exporting.

## Repo layout and how Slidev uses it

- `slides.md` is the single entry point. Slides are separated by `---`; per-slide YAML frontmatter sets layout, transition, and `src:` imports. The deck-level frontmatter lives in the first block (theme `apple-basic`, `comark: true`, `duration: 45min`).
- `components/*.vue` are auto-registered by filename, usable directly in `slides.md`. No import needed. `AgentLoop`, `IntegrationMesh`, `AccessLevel`, `Prompt` and `AutoMark` are the deck's own; `Counter` is a leftover from the starter and is unused.
- `AutoMark` draws a rough-notation mark on slide enter without costing a click. Use it instead of `v-mark` when a mark should appear with the slide: a `v-mark` with no click number draws at mount, and Slidev mounts neighbouring slides early, so the animation finishes off screen.
- `public/` holds static files served from the base path, currently the Kelas Tanya logo on the cover.
- `styles/index.css` is the deck's only stylesheet. It defines the accent and tone colours plus `--deck-bg` for each colour scheme, and carries the few rules that adjust apple-basic for Plus Jakarta Sans.
- `setup/mermaid.ts` themes mermaid. Slidev renders mermaid inside a shadow root, so the stylesheet cannot reach it and colours have to go through mermaid's own `themeVariables`.
- `pages/*.md` holds slides pulled in via `src: ./pages/imported-slides.md`. Split long decks here. Currently unused.
- `snippets/*.ts` holds real, type-checked code embedded with `<<< @/snippets/external.ts#snippet`. Region markers (`// #region snippet`) define what gets included. Monaco-run blocks in `slides.md` import from these files at presentation time, so keep them runnable. Currently unused.

Markdown in `slides.md` accepts inline Vue, `<script setup>`, UnoCSS attributify (`text="sm"`, `border="~ main"`), and scoped `<style>` blocks that apply to the current slide only.

## Package manager

`package-lock.json` is the source of truth and `node_modules` was installed with npm. A `pnpm-workspace.yaml` also exists (it allowlists the `playwright-chromium` postinstall for pnpm v11+). Use npm unless you intend to switch the whole project, and if you do switch, delete the npm lockfile rather than keeping both.

## Colour schemes

The deck ships both, and `d` toggles between them at any time. That only works while
`colorSchema` stays `auto` in the headmatter: Slidev reads any other value as the author
having decided, and makes the toggle a no-op.

Light is the default. `setup/main.ts` sets it once per browser (tracked by the
`deck-light-default` localStorage key), so a dark OS still opens the deck light and a later
`d` toggle is remembered. Clear that key to see the first-load behaviour again.

Two things do not follow the scheme on their own and need a per-scheme value when touched:

- Mermaid, for the shadow-root reason above. Its colours live in `setup/mermaid.ts` as
  getters, because the setup function runs once but mermaid re-reads them on every render.
  Do not pin a `theme:` on a mermaid block — Slidev keys its render cache on the block
  options, so pinning one makes both schemes share a single cached SVG.
- Hardcoded UnoCSS colour utilities in `slides.md`. Anything picked against the dark
  background tends to wash out on the light one, so those carry `dark:` variants.

Verify changes in the browser in both schemes. A clean build does not catch any of this.

## Deployment

The live deck is on DomaiNesia shared hosting at https://belajarweb.cloud/belajar-mcp/,
served from `public_html/belajar-mcp` on cPanel account `belaj255`. Pushing to `main` on
`ivankristianto/belajar-mcp-deck` runs `.github/workflows/build.yml`, which builds with
`--base /belajar-mcp/`, copies `deploy/.htaccess` in for Apache SPA routing, and
force-pushes the output to the `deploy` branch. The server then pulls that branch as a
codeload tarball. The hosting does not pull on its own yet, so that last step is manual.

The `deploy-to-domainesia` skill has the full procedure, the server-side commands, and
the reason uploads have to be pull-based. Read it before touching the hosting: the MCP's
`upload_file` takes base64 inline, so nothing larger than a small text file can be pushed
to that account in a tool call.

`netlify.toml` and `vercel.json` are also committed, each building with a bare
`npm run build` and serving `dist/` as an SPA with a catch-all rewrite to `index.html`.
Netlify additionally passes `/.well-known/*` through untouched. Because they omit
`--base`, they produce a root-based deck and are only correct for a root deploy. A base
path change has to land in the workflow, `deploy/.htaccess`, the extraction target, and
both of these configs together.
