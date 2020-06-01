import gulp from 'gulp';
import gutil from 'gulp-util';
import gulpif from 'gulp-if';
import sprity from 'sprity';
import fs from 'fs';
import replace from 'replace';
import del from 'del';
import c from './color-log';
import fingerprint from './fingerprint-assets';

const spriteFile = 'sprites/sprite.png';
const spriteFileRegex = /\.\.\/images\/sprite\.png/g;
const THEME = './wp-content/themes/eshv/';
const SRC = [`${THEME}images/**/*.png`, `!${THEME}images/logo.png`, `!${THEME}images/logo-2x.png`];
const DEST = './assets/sprites/';
const SCSS_DEST = `${THEME}scss/`;

const spritePromise = config => {
  gutil.log(c('Building:'), config.style);

  return new Promise((resolve, reject) => {
    sprity
      .src(config)
      .on('error', err => {
        gutil.log(err);
        reject(err);
      })
      .pipe(gulpif('*.png', gulp.dest(DEST), gulp.dest(SCSS_DEST)))
      .on('finish', () => {
        resolve();
      });
  });
};

const mixinSprites = () =>
  spritePromise({
    src: SRC,
    style: '_sprite.scss',
    processor: 'sass',
    template: './gulp/sprite/scss.hbs',
    margin: 0,
  });

const cssSprites = () =>
  spritePromise({
    src: SRC,
    style: '_sprite-rules.scss',
    margin: 0,
  });

function saveRev() {
  const json = JSON.parse(fs.readFileSync('./rev-manifest.json', 'utf8'));

  return replace({
    regex: spriteFileRegex,
    replacement: `/public/${json[spriteFile]}`,
    paths: [SCSS_DEST],
    recursive: true,
    silent: true,
  });
}

export default () =>
  del(DEST)
    .then(mixinSprites)
    .then(cssSprites)
    .then(fingerprint)
    .then(saveRev);
