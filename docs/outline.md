# Talk outline

60 minutes. Presentation runs 38 minutes, which sits inside the 40-50 the TOR asks for,
and leaves Q&A the 15 it wants. Slides in Indonesian.

| Time | Minutes | Segment |
|---|---|---|
| 19.30 | 5 | Opening, host and speaker intro |
| 19.35 | 5 | 1. What is an AI Agent |
| 19.40 | 8 | 2. What is MCP |
| 19.48 | 5 | 3. MCP on DomaiNesia |
| 19.53 | 4 | 4. Safety checklist |
| 19.57 | 14 | 5. Live demo |
| 20.11 | 2 | 6. Starter kit handoff |
| 20.13 | 15 | Q&A |
| 20.28 | 2 | Close |

If the slot turns out to be 90 minutes, spend the extra on: demo +6 (add the scheduled
backup end to end instead of describing it), MCP concepts +4 (add the discovery
handshake and a second MCP server so the point about reuse lands), Q&A +5.

## 1. What is an AI Agent (5 min)

Beat: a chatbot answers, an agent acts.

- The loop, drawn once and referred back to all talk: goal in, pick a tool, run it, read the result, decide the next step, repeat until done.
- Examples the audience already uses: ChatGPT searching the web mid-answer, an AI that reads an attached PDF, a coding assistant that edits files.
- The gap that sets up the rest: an agent with no tools only knows its training data plus what you paste into the chat. It cannot see your hosting. Someone still has to open cPanel and read the log.

Land on the question the whole talk answers: how do we give the agent safe access to the hosting, without building anything.

## 2. What is MCP (8 min)

Beat: one standard plug, so every tool does not need its own adapter.

- Definition, matching DomaiNesia's own wording: an open protocol that standardises how AI applications connect to external data, tools and services.
- Say what it is not, because this clears up most of the confusion: not an AI model, not a place to train models, not a deployment system.
- The problem it solves, on one slide: 5 agents and 10 services used to mean 50 custom integrations. Each service ships one MCP server, each agent speaks MCP, and the number collapses.
- Three parts: Host (the app you use, ChatGPT or Claude), Client (the connection the host opens), Server (the side that offers tools, in our case DomaiNesia).
- Discovery is the reason there is no code: the agent asks the server what it can do, the server answers with the list. You never write the glue.
- MCP usually sits on top of an API the provider already had. It adds a layer, it does not replace the old way.
  This is one line on the definition slide, not its own slide. Say it once and move on, it only matters to the developer half.

For this audience keep the protocol details out. No JSON, no transport talk.

## 3. MCP on DomaiNesia (5 min)

Beat: this is not theory, it is a card in the panel.

- Where it lives and how to turn it on, in three steps: MyDomaiNesia to My Services to the hosting
  service; the AI Agent Access (MCP) card, Enable AI Access, read the risk notes, tick the agreement;
  choose an access level and create the MCP Password. Keep it brief, the demo walks the same flow live.
- The four access levels, with a plain description of each and when to pick it:
  - Full access, read and change most of the account
  - No destructive, changes allowed but delete, uninstall and revoke are blocked
  - Read-only, look but do not touch
  - Containment, the tightest, for an agent you do not trust yet
- What the agent can reach once connected: files, database, domain and DNS, Git deployment, hosting resources.
- The MCP Password is shown once. Treat it like the root password.

Recommend out loud: start on read-only, move up only when you have a reason.

## 4. Safety checklist (4 min)

Beat: the access level is the seatbelt, the habits are the driving.

Present the short version on one slide, the full list is in `safety-checklist.md` and
goes into the starter kit. The four that matter most for this audience:

1. Start read-only.
2. Back up before any task that writes.
3. Name the target explicitly in the prompt, this domain, this folder.
4. Read the plan before approving, check the logs after.

Spend the most time on the one nobody expects: content on your own server can carry
instructions. A comment, a log line, an uploaded file. If the agent reads it while it
has write access, that text can steer it. This is why read-only investigation and write
repair should be two separate steps.

## 5. Live demo (14 min)

Full runbook, fallbacks and timings in `demo-script.md`. Shape on stage:

Two fallback slides carry all six prompts, split into the read-only ones and the rest. Skip both if
the live run goes well.

1. Enable MCP and pick an access level (2 min)
2. Install and configure the Claude Desktop extension (3.5 min)
3. Connection check, then ask the server for its tool list (1.5 min)
4. Read the error log, propose and approve a fix (3 min)
5. Email lands in spam, check the DNS records (2 min)
6. Hunt the injected judol script (2 min)

AI tool on screen is Claude Desktop. Backup is not demoed, it is unverified, and it moves
to the starter kit handoff as a spoken sentence.

## 6. Starter kit handoff (2 min)

Show the slide with the QR, give people time to scan it, and read two prompts out loud so
they hear the shape of a good one. The kit is a page next to the deck, at
belajarweb.cloud/belajar-mcp/starter-kit/, built from `public/starter-kit/index.html`. Then hand back for Q&A.

## Q&A (15 min)

Likely questions, prepared answers in `faq.md` once we draft it. The three that will
almost certainly come: does this cost anything, can the AI delete my site, do I need a
paid Claude plan.
