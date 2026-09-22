# Welcome to [Slidev](https://github.com/slidevjs/slidev)!

To start the slide show:

- `npm install`
- `npm run dev`
- visit <http://localhost:3030>

Edit the [slides.md](./slides.md) to see the changes.

Learn more about Slidev at the [documentation](https://sli.dev/).

## Deploy

Pushing to `main` runs `.github/workflows/build.yml`, which builds with
`--base /belajar-mcp/` and force-pushes the output to the `deploy` branch as a
single commit. `deploy/.htaccess` is copied into the build for Apache SPA
routing.

The hosting side pulls that branch as a tarball:

```
https://codeload.github.com/ivankristianto/belajar-mcp-deck/tar.gz/refs/heads/deploy
```

extracted into `public_html/belajar-mcp` with `--strip-components=1`. Changing
the base path means updating the workflow, `deploy/.htaccess`, and the
extraction target together.
