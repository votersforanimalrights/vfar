import gutil from 'gulp-util';
import webpack from 'webpack';
import fingerprint from './fingerprint-assets.js';
import webpackConfig from './webpack.config.babel.js';

const transpileJS = (cb) => {
  gutil.log('Running webpack...');
  webpack(webpackConfig, (err, stats) => {
    if (err) {
      cb();
      throw new gutil.PluginError('webpack:build', err);
    }
    gutil.log(
      '[webpack:build]',
      stats.toString({
        chunks: false,
        colors: true,
      })
    );
    cb();
  });
}

export default transpileJS;
