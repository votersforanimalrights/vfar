import gulp from 'gulp';
import gutil from 'gulp-util';
import rename from 'gulp-rename';
import path from 'path';

import postcss from 'gulp-postcss';
import sass from 'gulp-sass';
import nodeSass from 'node-sass';
import autoprefixer from 'autoprefixer';
import csswring from 'csswring';
import c from './color-log.js';

const processors = [
  autoprefixer({
    cascade: false,
  }),
];

const scssDir = 'wp-content/themes/eshv/scss';
const SRC = path.join(scssDir, '*.scss');
const DEST = './assets/css';

const compileSCSS = (cb) => {
  gutil.log('Compiling SCSS templates ...');

  gulp
    .src(SRC)
    .pipe(
      sass(nodeSass)({
        outputStyle: 'expanded',
      }).on('error', error => {
        sass.logError(error);
        cb(error);
      })
    )
    .on('end', () => {
      gutil.log('Running', c('PostCSS'), 'tasks...');
    })
    .pipe(postcss(processors))
    .pipe(gulp.dest(DEST))
    .on('end', () => {
      gutil.log('Saved to', DEST);
      gutil.log('Minifying...');
    })
    .pipe(postcss([csswring]))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(gulp.dest(DEST))
    .on('finish', () => {
      gutil.log('Saved to', DEST);
      cb();
    });
};

export default compileSCSS;
