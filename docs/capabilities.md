# What DomaiNesia MCP can actually do

Checked 17 September 2026 against the public docs: the MCP article and the connection
guides for ChatGPT, Claude Code, OpenCode, Claude Desktop, Codex, Hermes, OpenClaw and
Antigravity.

This matters because every demo task and every starter kit prompt depends on a tool
existing. A prompt that hits a missing tool fails live, in front of the audience.

## Confirmed

Capability categories, stated in the MCP article:

- Files
- Databases
- Domains & DNS
- Git deploy
- "Other hosting resources available through this access", unspecified

Tool names actually named in the docs:

- `get_account_info`
- `list_domains`
- `list_subdomains`

Access levels: Full access, No destructive, Read-only, Containment.

## Not mentioned anywhere in the public docs

None of these appear in the MCP article or in any of the connection guides:

- Email accounts, mailboxes, forwarders, aliases
- Backup and restore
- SSL certificates
- Cron jobs
- FTP accounts

They may well exist under "other hosting resources". The docs simply do not say, and the
guides stop at connection setup without listing the tool surface.

Worth flagging: **scheduled backup is named in DomaiNesia's own TOR** as a live demo task,
but appears in no published capability list. Either the feature exists and is
undocumented, or the TOR is optimistic. Ask.

## What to ask DomaiNesia

1. Can we get the full tool list the MCP server exposes, the actual tool names?
2. Does it cover email account create, suspend, delete and forwarders?
3. Does it cover backup on demand and scheduled backup, as the TOR assumes?
4. SSL status, cron jobs, FTP accounts?
5. Which tools are blocked at each access level? Specifically, is "create an email account"
   allowed under No destructive, and is "delete an email account" blocked?

Question 5 is the useful one for the talk. The access level table is more convincing with
a real example of something each level blocks.

## Fastest way to answer this ourselves

Connect the demo account and ask the agent to enumerate:

> Gunakan MCP DomaiNesia. Tampilkan daftar lengkap tool yang tersedia beserta deskripsi singkatnya. Jangan jalankan apa pun.

Discovery is part of the protocol, so the server will answer honestly. Do this before
finalising the demo and the kit, and paste the result into this file.

It is also a nice thing to show on stage for ten seconds: the agent asking the server what
it can do is exactly the point being taught in the MCP section.
