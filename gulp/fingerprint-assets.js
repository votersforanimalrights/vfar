import gulp from 'gulp';
import rev from 'gulp-rev';
import gutil from 'gulp-util';
import {deleteAsync} from 'del';
import path from 'path';
import c from './color-log.js';

const rootDir = process.cwd();
const assetsDir = path.join(rootDir, 'assets');
const fingerprintDir = path.join(rootDir, 'public');

async function fingerprintAssets(cb) {
  await deleteAsync(fingerprintDir);

  gulp
    .src(`${assetsDir}/**/*`)
    .pipe(rev())
    .on('end', () => {
      gutil.log('Fingerprinting assets...');
    })
    .pipe(gulp.dest(fingerprintDir))
    .on('end', () => {
      gutil.log('Assets saved in:', c(fingerprintDir));
    })
    .pipe(
      rev.manifest({
        path: 'rev-manifest.json',
      })
    )
    .on('end', () => {
      gutil.log('Asset manifest created.');
    })
    .pipe(gulp.dest(rootDir))
    .on('finish', () => {
      gutil.log('Asset manifest saved in:', c(rootDir));
      cb();
    });
}

export default fingerprintAssets;
