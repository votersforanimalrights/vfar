/**
 * @type {import('@types/eslint').Linter.BaseConfig}
 */
 module.exports = {
  extends: [
    '@remix-run/eslint-config',
    'prettier',
  ],
  plugins: ['prettier'],
  rules: {
    'prettier/prettier': [
      'error',
      {
        singleQuote: true,
        trailingComma: 'es5',
        useTabs: false,
        tabWidth: 2,
        printWidth: 100,
      },
    ],
  },
}