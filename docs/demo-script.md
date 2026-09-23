# Live demo runbook

14 minutes on stage. AI tool is **Claude Desktop**. Steps come from DomaiNesia's own
Claude Desktop guide, linked at the bottom.

## Why Claude Desktop

The audience is half non-coders. Claude Desktop is a desktop app with no terminal, and
DomaiNesia gives you a ready `.mcpb` extension file, so nobody edits a config file on
stage. Claude Code has a shorter connector flow but it is a developer CLI and would lose
the UMKM half of the room. Mention in one line that Claude Code, Codex, OpenCode and
ChatGPT all have published guides, so the choice of tool is not a lock-in.

## Running order

| # | Step | Min |
|---|---|---|
| 1 | Enable MCP in MyDomaiNesia | 2 |
| 2 | Install and configure the Claude Desktop extension | 3.5 |
| 3 | Connection check, then ask the server for its tool list | 1.5 |
| 4 | Read the error log, propose and approve a fix | 3 |
| 5 | Email lands in spam, check the DNS records | 2 |
| 6 | Hunt the injected judol script | 2 |

Backup is not demoed. It is unverified (see `capabilities.md`) and it moves to the starter
kit handoff as a spoken sentence.

## Before the session

- [ ] Use a throwaway hosting account, never a client site. Everything on screen is public.
- [ ] Seed it: a real broken page that writes to the error log, an SPF record that is missing or wrong, and a file with an injected judol script.
- [ ] Run the tool enumeration prompt first, confirm steps 4, 5 and 6 are actually possible. See `capabilities.md`.
- [ ] Do the full run once end to end the day before, and record it. That recording is the fallback.
- [ ] Screenshot every step in order. Second fallback, and they become slides.
- [ ] Reset the MCP Password right before the session so the one on screen is the live one.
- [ ] Claude Desktop installed and signed in, on a clean profile. No personal chat history in the sidebar.
- [ ] Check Settings, Extensions, Advanced settings: "Use Built-in Node.js for MCP" must be on. Easy to miss, and nothing works without it.
- [ ] Download the `.mcpb` ahead of time so the demo does not wait on a download.
- [ ] Close every other tab and window. Mute notifications. Check what the browser autocompletes in the URL bar.

## Steps

### 1. Enable MCP (2 min)

MyDomaiNesia, My Services, pick the hosting, find the AI Agent Access (MCP) card.

1. Enable AI Access
2. Read the access and risk notes out loud, briefly. This is where the safety point lands.
3. Tick the agreement
4. Choose the access level. Pick Read-only first, say why.
5. Create MCP Password. It shows once. Cover it on screen and say a leak means reset.
6. Copy the MCP URL, including `https://` and any trailing slash.
7. Choose Claude, then download the **Claude Desktop Extension (.mcpb)**.

### 2. Install and configure the extension (3.5 min)

In Claude Desktop: **Settings > Extensions > Advanced settings**.

1. Confirm "Use Built-in Node.js for MCP" is on
2. Under Extension Developer, click Install Extension, pick the `.mcpb`
3. Review the extension details, confirm twice
4. Back in the extension list, click Configure on the DomaiNesia entry
5. Paste the MCP URL exactly, including `https://` and trailing slash
6. Enter the MCP Password. **Blur or cut away here.** This field is on screen and the value is a master password.
7. Save, then toggle the extension from Disabled to Enabled

Say plainly while typing: this password is equivalent to your hosting master password,
which is why it gets reset the moment the webinar ends.

### 3. Connection check and tool list (1.5 min)

First prompt is read-only on purpose.

> Gunakan MCP DomaiNesia. Periksa apakah koneksi sudah aktif. Jangan ubah atau hapus file apa pun. Tampilkan daftar domain/subdomain dan document root yang tersedia.

Expect account info, the domain list, document roots. That output alone proves the agent
can now see the hosting.

Then, immediately:

> Tampilkan daftar lengkap tool yang tersedia beserta deskripsi singkatnya. Jangan jalankan apa pun.

Thirty seconds, and it pays off the discovery point from the MCP section. The agent is
asking the server what it can do, which is the thing that removes the coding.

### 4. Read the error log (3 min)

> Baca error log untuk domain [domain]. Ringkas 10 error terakhir, kelompokkan yang berulang, dan jelaskan kemungkinan penyebabnya. Jangan ubah file apa pun.

Talk through the answer rather than reading it aloud. Point out that nobody opened File
Manager.

Then the repair, and this is where the access level changes:

> Berdasarkan error tadi, jelaskan perbaikan yang kamu usulkan untuk file [path]. Tunjukkan rencananya dulu. Setelah saya setujui, terapkan ke file itu saja.

Show the plan, approve it, let it write. Say out loud that you backed up first and that
you moved off read-only for this one step.

### 5. Email lands in spam (2 min)

Set up the situation before the prompt: invoices going to the customer's spam folder is a
business problem, and almost nobody knows it is a DNS problem.

> Email dari [domain] sering masuk spam. Periksa DNS record MX, SPF, DKIM, dan DMARC. Jelaskan mana yang kurang atau salah dan apa dampaknya. Jangan ubah apa pun.

Read-only, verified capability, and it is the moment the UMKM half of the audience sees
themselves in the demo. Do not fix it live, there is no time. Say the kit has the follow-up.

### 6. Hunt the judol script (2 min)

> Periksa file di document root [domain] untuk kode yang mencurigakan: iframe tersembunyi, script ke domain luar, kode terenkripsi base64, atau link judi. Laporkan file dan barisnya. Jangan hapus apa pun.

Let the finding sit for a second before moving on.

Then the prompt injection point, which is the part nobody has heard: the agent just read
attacker-controlled content. If it had write access and no review step, that content could
have steered it. Read first, review yourself, then write.

## Fallbacks

| If | Then |
|---|---|
| The extension will not install | Cut to the recording of step 2 and keep talking over it |
| "Use Built-in Node.js for MCP" was off | Turn it on, restart, and fill the gap with the access level slide |
| The agent gives a bad or empty answer | Move on and say so. This is normal and the audience learns something honest |
| The panel or the app is slow | Switch to screenshots. Do not wait on a spinner in front of a live room |
| Everything fails | Play the recording end to end and narrate it. Q&A takes the extra time |

## After the session

- [ ] Reset the MCP Password, it was on screen.
- [ ] Disable and remove the extension in Claude Desktop.
- [ ] Set the access level back down, or turn the feature off entirely.

## Source

- [Koneksi Claude Desktop dengan MCP DomaiNesia](https://www.domainesia.com/panduan/panduan-koneksi-claude-desktop-dengan-mcp-domainesia/)
- [Koneksi Claude Code dengan MCP DomaiNesia](https://www.domainesia.com/panduan/koneksi-claude-code-dengan-mcp-domainesia/), the alternative for the developer segment
