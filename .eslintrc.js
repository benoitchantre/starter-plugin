module.exports = {
	root: true,
	env: {
		browser: true,
		jquery: true,
		es6: true,
	},
	extends: [
		'plugin:@wordpress/eslint-plugin/recommended',
		'plugin:@wordpress/eslint-plugin/esnext',
		'plugin:@wordpress/eslint-plugin/i18n',
		'plugin:@wordpress/eslint-plugin/react',
	],
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
};
