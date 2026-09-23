# AI Agent Starter Kit, draft

Named as a learning outcome in the TOR, so it ships. Prompts are in Indonesian because
participants will paste them as-is. Notes around them are English, like the rest of the prep.

Every prompt starts by naming the MCP connection, which stops the agent answering from
memory instead of going to look. The name below matches Claude Desktop. If a participant
uses a different tool, they name theirs instead.

Capability status per section comes from `capabilities.md`. Anything marked **unverified**
must be tested on the demo account before this kit is sent, or cut.

## How to use this, for the participant-facing intro

- Start with the read-only prompts. They cannot break anything.
- Replace anything in `[square brackets]` with your own domain or path.
- Before any prompt marked **Menulis**, back up.

## Part 1. Checking, safe to run today

Verified capability: files, databases, domains & DNS.

**Connection check**

> Gunakan MCP DomaiNesia. Periksa apakah koneksi sudah aktif. Jangan ubah atau hapus file apa pun. Tampilkan daftar domain/subdomain dan document root yang tersedia.

**Is my site broken, and why**

> Periksa apakah [domain] bisa diakses. Baca error log, ringkas 10 error terakhir, kelompokkan yang berulang, dan jelaskan kemungkinan penyebabnya. Jangan ubah file apa pun.

**Malware and judol script scan**

> Periksa file di document root [domain] untuk kode yang mencurigakan: iframe tersembunyi, script ke domain luar, kode terenkripsi base64, atau link judi. Laporkan file dan barisnya. Jangan hapus apa pun.

**What did the freelancer change**

> Tampilkan file di [domain] yang berubah dalam 14 hari terakhir beserta waktunya. Tandai yang tidak wajar.

**Disk quota, before uploads start failing**

> Kuota hosting saya hampir penuh. Tampilkan folder terbesar dan file yang kemungkinan aman dihapus, misalnya cache atau log lama. Laporkan saja, jangan hapus apa pun.

**Version audit**

> Untuk [domain], tampilkan versi PHP, versi WordPress, dan daftar plugin beserta versinya. Tandai yang sudah usang.

## Part 2. Small business situations

This is the section the UMKM half of the audience will actually use. Organised by the
situation, not by the feature, because that is how they will look for it.

### Email keeps landing in spam

Verified, this is DNS.

> Email dari [domain] sering masuk spam. Periksa DNS record MX, SPF, DKIM, dan DMARC. Jelaskan mana yang kurang atau salah dan apa dampaknya. Jangan ubah apa pun.

Probably the highest-value prompt in the kit. Almost every small business has this
problem, almost none know it is a DNS problem, and it is read-only.

### Shop details changed, update them everywhere

Verified, files and database.

> Nomor telepon toko berubah dari [lama] ke [baru]. Cari semua tempat nomor lama muncul di file dan database [domain]. Laporkan daftarnya dulu, jangan ubah apa pun.

Then, after reviewing and backing up, **Menulis**:

> Ganti nomor lama dengan yang baru di lokasi yang tadi kamu laporkan. Tunjukkan diff-nya. Jangan sentuh yang lain.

Same shape works for address, opening hours, or a price list.

### Landing page for a campaign

Verified, subdomains.

> Buatkan subdomain promo.[domain] dengan document root sendiri. Tunjukkan rencananya dulu sebelum dibuat.

### Moving to a new service without breaking email

Verified, DNS. Worth including because pointing a domain at a new site and taking the
mailboxes down with it is a classic self-inflicted outage.

> Saya mau arahkan [domain] ke layanan baru di [IP atau target]. Tunjukkan record apa saja yang perlu berubah, dan pastikan MX serta SPF tidak ikut berubah supaya email tetap jalan. Jelaskan dulu, jangan terapkan.

### New staff, staff leaving

**Unverified.** Email account management is not in any published capability list. Test
before shipping, and cut this block if the tools do not exist.

> Buatkan email [nama]@[domain] untuk karyawan baru. Tunjukkan rencananya dulu.

> Karyawan [nama] sudah keluar. Nonaktifkan email [alamat] dan forward email masuk ke [alamat pengganti]. Jangan hapus isinya dulu.

The forward-before-delete pattern is worth teaching on its own. Orders and invoices arrive
at the address of someone who left, and deleting the mailbox loses them silently.

### Backup before anyone touches anything

**Unverified.** Named in the TOR as a demo task but absent from every published capability
list. This is the single most important thing to confirm with DomaiNesia.

> Buat backup penuh untuk [domain] sekarang. Konfirmasi kalau sudah selesai dan sebutkan di mana backup disimpan.

> Buat jadwal backup otomatis untuk [domain], harian, simpan 7 versi terakhir. Jelaskan dulu apa yang akan kamu buat.

### Customers see a security warning

**Unverified.** SSL is not in any published list.

> Periksa status SSL untuk [domain]. Kapan kedaluwarsa, dan apakah semua subdomain tercakup?

## Part 3. Repair, back up first

**Fix an error, with review**

> Berdasarkan error di log tadi, jelaskan perbaikan yang kamu usulkan untuk file [path]. Tunjukkan rencananya dulu. Setelah saya setujui, terapkan ke file itu saja.

**Clean an injected script**

> Hapus kode injeksi yang tadi kamu temukan di [path]. Tunjukkan diff sebelum dan sesudah. Jangan sentuh file lain.

## Use case table

For the contents page and the closing slide.

| Situation | Who | Level | Status |
|---|---|---|---|
| Site is down, read the log | Anyone | Read-only | Verified |
| Email lands in spam, check DNS | Small business | Read-only | Verified |
| Scan for judol injection | Anyone who has been hit | Read-only | Verified |
| What changed on my site recently | Hired a freelancer | Read-only | Verified |
| Disk quota filling up | Growing shop | Read-only | Verified |
| Update phone number everywhere | Small business | No destructive | Verified |
| Subdomain for a campaign | Marketing | No destructive | Verified |
| Repoint domain, keep email working | Moving provider | No destructive | Verified |
| Create email for new staff | Hiring | No destructive | Unverified |
| Forward and disable email, staff left | Offboarding | No destructive | Unverified |
| Backup before changes | Everyone | No destructive | Unverified |
| Check SSL expiry | Anyone selling online | Read-only | Unverified |

## Still to do

- [ ] Run the tool enumeration prompt in `capabilities.md`, then mark every row above verified or cut
- [ ] Test every remaining prompt on the demo account, a prompt that does not work is worse than no kit
- [ ] Translate the safety checklist into Indonesian for the kit
- [x] Format: a page next to the deck, `public/starter-kit/index.html`, served at
      belajarweb.cloud/belajar-mcp/starter-kit/. Change a prompt here and there together.
      The page drops the email account block and scheduled backup, since the server exposes
      no email account tools and no backup scheduler.
