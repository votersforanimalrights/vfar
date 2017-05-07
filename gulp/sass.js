import gulp from 'gulp';
import gutil from 'gulp-util';
import rename from 'gulp-rename';
import path from 'path';

import postcss from 'gulp-postcss';
import sass from 'gulp-sass';
import autoprefixer from 'autoprefixer';
import mqpacker from 'css-mqpacker';
import csswring from 'csswring';
import c from './color-log';
import fingerprint from './fingerprint-assets';

const processors = [
  autoprefixer({
    browsers: [
      'Android >= 2.1',
      'Chrome >= 21',
      'Explorer >= 7',
      'Firefox >= 17',
      'Opera >= 12.1',
      'Safari >= 6.0',
    ],
    cascade: false,
  }),
  mqpacker,
];

const scssDir = 'wp-content/themes/eshv/scss';
const SRC = path.join(scssDir, '*.scss');
const DEST = './assets/css';

const compileSCSS = () => {
  gutil.log('Compiling SCSS templates ...');

  return new Promise((resolve, reject) => {
    gulp.src(SRC)
      .pipe(sass({
        outputStyle: 'expanded',
      }).on('error', (error) => {
        sass.logError(error);
        reject(error);
      }))
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
        resolve();
      });
  });
};

export default () => (
  compileSCSS().then(fingerprint)
);
