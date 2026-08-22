import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const root = path.resolve(__dirname, '..');
const dist = path.resolve(root, 'dist');
const pub = path.resolve(root, 'public');

console.log('Syncing static assets into dist/ for Netlify build...');

if (!fs.existsSync(dist)) {
  fs.mkdirSync(dist, { recursive: true });
}

// Copy directories from public to dist
const dirs = ['build', 'fonts', 'images', 'placeholders'];
for (const dir of dirs) {
  const src = path.resolve(pub, dir);
  const dst = path.resolve(dist, dir);
  if (fs.existsSync(src)) {
    fs.cpSync(src, dst, { recursive: true });
    console.log(`✓ Copied public/${dir} -> dist/${dir}`);
  }
}

// Copy favicon
if (fs.existsSync(path.resolve(pub, 'favicon.ico'))) {
  fs.copyFileSync(path.resolve(pub, 'favicon.ico'), path.resolve(dist, 'favicon.ico'));
}

// Copy style tile
if (fs.existsSync(path.resolve(root, 'style-tile.html'))) {
  fs.copyFileSync(path.resolve(root, 'style-tile.html'), path.resolve(dist, 'style-tile.html'));
}

console.log('✓ Netlify dist static sync complete.');
