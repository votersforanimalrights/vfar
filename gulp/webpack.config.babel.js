import path from 'path';
import webpack from 'webpack';

const jsDir = path.resolve('wp-content/themes/eshv/js');
const SRC = path.join(jsDir, 'main.js');
const DEST = path.resolve('assets/js');

export default {
  entry: SRC,
  module: {
    rules: [
      {
        test: /.jsx?$/,
        loader: 'babel-loader',
        options: {
          presets: ['@babel/preset-env'],
        },
      },
    ],
  },
  output: {
    path: DEST,
    filename: '[name].js',
  },
  mode: 'production',
};
