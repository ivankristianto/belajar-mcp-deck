# Demo sites

Three small sites seeded for the live demo. They live on the hosting at
`public_html/example/example-N`, served from `https://belajarweb.cloud/example/example-N/`.
This README stays in the repo and is not uploaded, because the agent would read the answers
during the judol scan.

Every page carries `noindex, nofollow` so none of this ends up in search results.

## example-1: update contact details

Static landing page for a made-up bakery, Roti Senja. The phone number `0812-3456-7890`
appears in six places, in three formats:

- display text `0812-3456-7890` (header, contact block, footer, meta description)
- `tel:+6281234567890` links
- `wa.me/6281234567890` and the JSON-LD `+62-812-3456-7890`

The email `pesan@rotisenja.belajarweb.cloud` appears in JSON-LD, two `mailto:` links, the
contact block and the footer. A good answer from the agent finds all three phone formats,
not only the display text.

## example-2: fatal error from the error log

Price list for a made-up laundry. `inc/functions.php` renamed `format_rupiah()` to
`rupiah()`, but `index.php` still calls the old name, so every visit ends in
`Call to undefined function format_rupiah()` half way through the table. Line 5 also reads
`$_GET['promo']` without a check, which adds a repeating warning for the agent to group.

Fix: change `format_rupiah(` to `rupiah(` on line 35 of `index.php`, and
`$_GET['promo'] ?? null` on line 5. Visit the page a few times before the demo so the log
has entries.

## example-3: judol injection

Plain site for a made-up motorbike workshop, with five things planted:

- `index.html`: an external script from `cdn-jsdelivr.statistik-web.invalid` in `<head>`
- `index.html`: an off-screen `div` of gambling links near the end of `<body>`
- `index.html`: a zero-size hidden `iframe` right after it
- `assets/img/promo/index.html`: a dropped judol landing page (MAXWIN88)
- `assets/img/thumb.php`: `@eval(base64_decode(...))` disguised as a thumbnail cache

All the gambling domains use the `.invalid` TLD, so nothing resolves. The base64 payload
only echoes a link when `?k` is set. It does not run anything from the request.

To reset any example, re-upload its files from this folder.
