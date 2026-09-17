# Brief: Otomasi AI Agent, Kelola Website dan Hosting pakai MCP

Translated from the DomaiNesia TOR. Working language for all preparation docs is English.
The slides and anything participants see will be in Indonesian.

## Event

| | |
|---|---|
| Program | Kelas Tanya DomaiNesia, September 2026 |
| Speaker | Ivan Kristianto |
| Date | 24 September 2026, 19.30 - 20.30 WIB |
| Format | Online webinar, Zoom |
| Slot | 60 minutes (see note below) |

The TOR contradicts itself on length: the time slot is one hour, but the format section
says 1.5 hours and the segment breakdown adds up to 70-85 minutes. Everything here is
planned for 60 minutes, with a note in `outline.md` on what to add if we get 75.

## Audience

- Beginner developers and tech enthusiasts
- Business and UMKM owners who own a website or hosting account

Mixed technical level, leaning non-coder. Assume most have used ChatGPT and have logged
into a hosting panel, but have never written an API integration.

## Background

AI Agents are spreading fast, and that makes the link between an AI and external systems
(data, applications, documents) the part that matters. Until now that link has meant
custom work and technical skill for every single service.

MCP standardises how an AI Agent connects to external tools. The connection can be made
without writing a line of code, for example through the AI Agent Access (MCP) feature in
DomaiNesia hosting.

The webinar introduces MCP in plain terms and shows what it looks like in practice on
DomaiNesia, so that someone with no coding background can start using an AI Agent to
manage and monitor their website and hosting.

## Learning outcomes

1. Explain what an AI Agent is and how it reaches external data and tools.
2. Explain MCP and why it makes AI integration easier than the conventional approach, with no coding.
3. Introduce DomaiNesia's AI Agent Access (MCP) as a worked example for managing and monitoring a site.
4. Demonstrate live how to enable MCP, connect it to an AI tool, and run real hosting tasks without code.
5. Send participants home with an AI Agent Starter Kit of prompts and use cases they can try immediately.

## Talking points

1. What an AI Agent is, with everyday examples people already recognise.
2. MCP basics, and why it beats conventional integration.
3. From the general concept to a concrete implementation.
4. The DomaiNesia MCP feature: access levels, security, how to turn it on.
5. MCP Safety Checklist.
6. Live demo:
   1. Enable MCP.
   2. Connect it to an AI tool, step by step.
   3. Run tasks: read and fix an error log, run a scheduled backup, find an injected judol script, and similar.

## Deliverable

The AI Agent Starter Kit is named as a learning outcome, so it is a deliverable, not a
nice-to-have. Draft lives in `starter-kit.md`. Confirm with DomaiNesia who packages and
distributes it after the session.

## References

- [Koneksi Claude Desktop dengan MCP DomaiNesia](https://www.domainesia.com/panduan/panduan-koneksi-claude-desktop-dengan-mcp-domainesia/), source for the demo steps
- [Koneksi ChatGPT dengan MCP DomaiNesia](https://www.domainesia.com/panduan/koneksi-chatgpt-dengan-mcp-domainesia/), the guide the TOR references
- [Apa itu MCP?](https://www.domainesia.com/berita/apa-itu-mcp/), DomaiNesia's own framing of MCP, worth matching so the talk and their blog agree

## Open questions for DomaiNesia

1. Is the slot 60 or 90 minutes?
2. **What is the full MCP tool list?** Blocking for both the demo and the kit. Public docs
   name only files, databases, domains & DNS and Git deploy. Email accounts, backup, SSL
   and cron appear nowhere. See `capabilities.md`.
3. **Does scheduled backup actually exist?** The TOR names it as a live demo task but no
   published capability list mentions it.
4. Who produces and sends the Starter Kit?
5. Can we get a throwaway hosting account, pre-seeded with a broken log and an injected script?
6. **We plan to demo Claude Desktop, not ChatGPT.** The TOR links the ChatGPT guide, so
   confirm they are fine with it. DomaiNesia publishes guides for Claude Desktop, Claude
   Code, Codex, OpenCode, Hermes, OpenClaw and Antigravity, so this is supported, but it
   differs from what they referenced.
