import gulp from 'gulp';
import watchers from './gulp/watchers';
// import sprite from './gulp/sprite';
import sass from './gulp/sass';
import js from './gulp/webpack';
import fingerprint from './gulp/fingerprint-assets';
import build from './gulp/build';

process.env.THEME = 'eshv';

// gulp.task('sprite', () => sprite());

gulp.task('scss-pipeline', () => sass());

gulp.task('js-pipeline', () => js());

gulp.task('fingerprint-assets', () => fingerprint());

gulp.task('build', () => build());

gulp.task('default', () => {
  const src = './wp-content/themes/eshv/';
  gulp.watch([`${src}scss/**/*.scss`], sass);
  gulp.watch([`${src}js/**/*.js`], js);
});
