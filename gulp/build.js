import runSequence from 'run-sequence';

export default () => (
  runSequence(
    'sprite',
    'scss-pipeline',
    'js-pipeline',
  )
);
