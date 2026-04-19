const { defineConfig, globalIgnores } = require( 'eslint/config' );

const globals = require( 'globals' );
const wpPlugin = require( '@wordpress/eslint-plugin' );

module.exports = defineConfig( [
	...wpPlugin.configs.recommended,
	...wpPlugin.configs.esnext,
	...wpPlugin.configs.i18n,
	...wpPlugin.configs.react,
	{
		languageOptions: {
			globals: {
				...globals.browser,
				...globals.jquery,
			},
		},

		rules: {
			'@wordpress/i18n-text-domain': [
				'error',
				{
					allowedTextDomain: [ 'starter-plugin' ],
				},
			],

			'space-before-function-paren': [
				'error',
				{
					anonymous: 'always',
					named: 'never',
				},
			],
		},
	},
	globalIgnores( [
		'**/build',
		'**/node_modules',
		'**/test',
		'**/vendor',
		'!**/.*.js',
	] ),
] );
