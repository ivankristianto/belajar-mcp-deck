---
name: deploy-to-domainesia
description: Deploy this deck's static build to the DomaiNesia cPanel hosting at belajarweb.cloud/belajar-mcp through the domainesia-hosting MCP, and work with that account generally. Use whenever the user asks to deploy, publish, push live, update the live deck, or ship the slides to hosting; whenever they ask to put any file on belajarweb.cloud; and whenever a domainesia-hosting MCP tool is about to be used for something larger than a small text file. Covers the upload size constraint, the GitHub Actions build, the server-side pull, and the cron shell hatch.
---

# Deploying to DomaiNesia

## The account

cPanel user `belaj255`, home `/home/belaj255`, docroot `/home/belaj255/public_html`,
IP 202.155.137.36, plan `nimbus_one`. Domains: `belajarweb.cloud` and the subdomain
`mcp.belajarweb.cloud`. The deck lives at `public_html/belajar-mcp`, served at
https://belajarweb.cloud/belajar-mcp/.

Plan limits that bite: addon and parked domains capped at 0, databases capped at 2,
subdomains unlimited. Disabled cPanel features: `ssh`, `version_control`, `multiphp`,
`api_shell`, `ai-assistant`. Tools touching those fail on entitlement, not on syntax,
so read the error before assuming the call was malformed.

## Read this before any upload

`upload_file` takes base64 inline and `create_file` takes raw text inline. Both mean
the agent has to emit the file contents as tool-call arguments. A few KB of text is
fine. The built deck is 1.9 MB zipped, about 2.6 MB as base64, which no single message
can carry. There is no chunked or resumable upload on this server.

So: anything beyond a small text file reaches that account by a **pull the server
initiates**, never a push. Do not start base64-encoding a build and hope it fits.

## Deploying the deck

The pipeline is already built. Normal case is three steps.

1. Push to `main` on `ivankristianto/belajar-mcp-deck`. That triggers
   `.github/workflows/build.yml`, which runs `npx slidev build --base /belajar-mcp/`,
   copies `deploy/.htaccess` into `dist`, and force-pushes the result to the `deploy`
   branch as one squashed commit. Confirm it passed with `gh run watch <id> --exit-status`.

2. Make the server pull the `deploy` branch tarball:

   ```
   curl -sSL https://codeload.github.com/ivankristianto/belajar-mcp-deck/tar.gz/refs/heads/deploy -o /home/belaj255/deck.tgz
   mkdir -p /home/belaj255/public_html/belajar-mcp
   tar xzf /home/belaj255/deck.tgz -C /home/belaj255/public_html/belajar-mcp --strip-components=1
   rm -f /home/belaj255/deck.tgz
   ```

   `--strip-components=1` is not optional. GitHub tarballs wrap everything in a
   `<repo>-<branch>/` directory.

3. Verify over HTTPS with curl from the local machine, not through the MCP. Check three
   things, because each catches a different failure: the root returns 200, a hashed
   asset under `/belajar-mcp/assets/` returns 200 (catches a wrong `--base`), and a deep
   link such as `/belajar-mcp/5` returns 200 (catches a missing `.htaccess`).

If the workflow is not the source of the change, build locally with
`npx slidev build --base /belajar-mcp/` and get the bytes to a URL the server can reach.
The base path must be passed explicitly. A bare `npm run build` produces a root-based
deck whose assets 404 under `/belajar-mcp/`.

## Running commands on the server

There is no SSH and no shell tool. Cron is the only way to execute anything, and its
commands are arbitrary shell under `/usr/local/cpanel/bin/jailshell`.

Cron gives no return channel, so always redirect into a log and read it back:

```
{ <commands> && echo DEPLOY_OK; } > /home/belaj255/deploy.log 2>&1
```

Then `read_file` on the log. Absence of `DEPLOY_OK` is the failure signal.

The granularity is one minute, so a one-off job means creating a `* * * * *` cron,
waiting ~75 seconds, reading the log, then deleting it with `delete_cron_job`.

**Delete the job in the same turn you confirm it ran.** A minute cron that outlives the
session keeps hitting GitHub every 60 seconds forever. If the work is genuinely one-off,
prefer making the command self-limiting, for example having it touch a sentinel file and
exit early when the sentinel exists, so a lost session degrades to a no-op rather than a
loop. Re-extracting the same tarball is harmless; anything destructive is not, and should
never go in a repeating cron.

Probe with something harmless the first time on an unfamiliar account
(`/usr/bin/id > ~/probe.txt`) before building a real deploy on top of cron.

## Small edits

For a single config file, `.htaccess`, or a page of text, `create_file` and `edit_file`
are the right tools and need no GitHub round trip. If a call stalls on HTML-heavy
content, the host is firewall-inspecting the body: retry once with `content_b64`.

## Base path changes

`/belajar-mcp/` is written in four places that must move together. Changing one alone
produces a page that loads but renders blank, or one where only deep links break.

- `BASE_PATH` in `.github/workflows/build.yml`
- `RewriteBase` and the rewrite target in `deploy/.htaccess`
- the `tar -C` extraction target
- `netlify.toml` and `vercel.json` if those deploys are still wanted

Those two configs currently build with a bare `npm run build`, so they produce a
root-based deck, not a `/belajar-mcp/` one. They are only correct for a root deploy.
