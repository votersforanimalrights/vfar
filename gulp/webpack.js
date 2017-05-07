import gutil from 'gulp-util';
import webpack from 'webpack';
import fingerprint from './fingerprint-assets';
import webpackConfig from './webpack.config.babel';

const transpileJS = () => (
  new Promise((resolve, reject) => {
    gutil.log('Running webpack...');
    webpack(
      webpackConfig,
      (err, stats) => {
        if (err) {
          reject();
          throw new gutil.PluginError('webpack:build', err);
        }
        gutil.log('[webpack:build]', stats.toString({
          chunks: false,
          colors: true,
        }));
        resolve();
      },
    );
  })
);

export default () => (
  transpileJS().then(fingerprint)
);
