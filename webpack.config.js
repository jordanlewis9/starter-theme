const BabiliPlugin 			= require('babili-webpack-plugin')
const CopyWebpackPlugin 	= require('copy-webpack-plugin')
const ExtractTextPlugin 	= require('extract-text-webpack-plugin')
const path 					= require('path')
const shell 				= require('shelljs')
const WebpackOnBuildPlugin 	= require('on-build-webpack');
const PRE_COMPILE 			= 'pre_compile'
const DEVELOPMENT 			= 'development'
const PRODUCTION 			= 'production'

let minify = false
if (process.env.NODE_ENV === PRODUCTION || process.env.NODE_ENV === PRE_COMPILE) {
	minify = true
}

const webpack_pre_compile = {
	entry: './src/js/entry.js',
	output: {
		path: path.join(__dirname, 'build'),
		filename: 'bundle.js'
	},
	module: {
		rules: [
			{ 
				test: /\.js$/, 
				exclude: /(node_modules|bower_components)\/(?!(retinajs)\/).*/,
				use: 'babel-loader'
			},

			{ 
				test: /\.scss$/,
				use: ExtractTextPlugin.extract({ 
					use: ['css-loader?minimize=' + minify, 'postcss-loader', 'resolve-url-loader', 'sass-loader?sourceMap'] 
				})
			},

			{ 
				test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/, 
				use: 'file-loader'
			},

			{ 
				test: /\.(ttf|eot|svg|gif|png)(\?v=[0-9]\.[0-9]\.[0-9])?$/, 
				use: 'file-loader'
			},
			{
				test: /\.css$/,
				use: [
					{ loader: "style-loader" },
					{ loader: "css-loader" }
				]
			}
		]
	},
	plugins: [
		new BabiliPlugin(),
		new ExtractTextPlugin("bundle.css"),
		new WebpackOnBuildPlugin((stats) => {
			shell.exec('npm run _build')
		})
	]
}

webpack_dev = Object.assign({}, webpack_pre_compile)
webpack_dev.plugins = [
	new ExtractTextPlugin("bundle.css")
]

let webpack_build = Object.assign({}, webpack_dev)
webpack_build.plugins = [
	new BabiliPlugin(),
	new ExtractTextPlugin("bundle.css"),
	new CopyWebpackPlugin([
		{ from: path.join(__dirname, 'build'),
			to: path.join(__dirname, 'dist/build/')},

		{ from: path.join(__dirname, '**/*.php'),
			to: path.join(__dirname, 'dist')},

		{ from: path.join(__dirname, 'acf-json'),
			to: path.join(__dirname, 'dist/acf-json')},

		{ from: path.join(__dirname, 'img'),
			to: path.join(__dirname, 'dist/img')},
						
		{ from: path.join(__dirname, 'style.css'),
			to: path.join(__dirname, 'dist')},

		{ from: path.join(__dirname, 'src'),
			to: path.join(__dirname, 'dist/src')},

		{ from: path.join(__dirname, 'fonts'),
			to: path.join(__dirname, 'dist/fonts')},

		{ from: path.join(__dirname, 'webpack.config.js'),
			to: path.join(__dirname, 'dist/webpack.config.js')},

		{ from: path.join(__dirname, 'package.json'),
			to: path.join(__dirname, 'dist/package.json')},

		{ from: path.join(__dirname, '.gitignore'),
			to: path.join(__dirname, 'dist/.gitignore')},

		{ from: path.join(__dirname, 'README.md'),
			to: path.join(__dirname, 'dist/README.md')},

		{ from: path.join(__dirname, 'screenshot.png'),
			to: path.join(__dirname, 'dist/screenshot.png')},

		{ from: path.join(__dirname, 'postcss.config.js'),
			to: path.join(__dirname, 'dist/postcss.config.js')}
	])
]

const { NODE_ENV } = process.env
switch (NODE_ENV) {
	case DEVELOPMENT:
		module.exports = webpack_dev;
	break

	case PRODUCTION:
		module.exports = webpack_build
	break

	case PRE_COMPILE:
		module.exports = webpack_pre_compile
	break

	default: 
		module.exports = webpack_build 
	break
}