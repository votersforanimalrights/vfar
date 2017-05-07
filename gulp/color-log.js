import gutil from 'gulp-util';

export default (log, color) => (
  gutil.colors[color || 'yellow'](log)
);
