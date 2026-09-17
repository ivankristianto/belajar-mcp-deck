# MCP Safety Checklist

Working version in English. The slide gets a 4-item short version in Indonesian, the full
list goes into the starter kit translated.

## Before you connect

1. **Pick the lowest access level that does the job.** Read-only covers most of what a
   site owner actually wants: checking logs, finding a broken file, spotting an
   injection. Raise the level for a specific task, then lower it again.
2. **Know what the agent can reach.** On DomaiNesia that is files, database, domain and
   DNS, Git deployment and hosting resources. All of it, not just the site you had in
   mind.
3. **Treat the MCP Password like the root password.** It is shown once. Never in a
   screenshot, a chat, a ticket or a shared doc. If you are unsure whether it leaked,
   reset it, resetting is cheap.
4. **Check the authorisation page destination.** It should name the tool you are actually
   connecting, `chatgpt.com` and nothing else. A wrong destination here hands over
   hosting access.

## Before you run anything that writes

5. **Back up first.** Every time. An agent that makes a mistake makes it fast.
6. **Name the target explicitly.** This domain, this folder, this file. A vague prompt
   invites a broad interpretation.
7. **Ask for the plan before the change.** Read it. If the plan touches something you did
   not expect, that is the warning you asked for.
8. **One task at a time.** Batched instructions are where surprising things happen,
   because you approve step one and steps two through five ride along.

## After

9. **Check the logs.** What did it actually do, not what it said it did.
10. **Revoke when you are done.** A connection you are not using is access you are not
    watching. Reset the access level down, or turn the feature off.

## The one people do not expect

11. **Content on your own server can carry instructions.** A comment, a log line, a
    filename, an uploaded file. When the agent reads it, that text lands in the same
    place your instructions do, and it can steer the agent. This is the reason for the
    split the demo shows:

    - Investigate with read-only.
    - Review what came back yourself.
    - Then raise the level and make the change.

    An investigation that finds attacker content and repairs it in one unreviewed pass is
    the case to avoid. Say this plainly in the talk, it is the part nobody has heard.

## Quick version for the slide

1. Mulai dari read-only.
2. Backup sebelum ada yang diubah.
3. Sebutkan target dengan jelas, domain ini, folder ini.
4. Baca rencananya sebelum menyetujui, cek log setelahnya.
