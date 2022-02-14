const {join, resolve} = require('path')
const WebpackFixStyleOnlyEntries = require('webpack-fix-style-only-entries')
const MiniCssExtracPlugin = require('mini-css-extract-plugin')

const base = join(__dirname, 'resources')
const jsSrc = join(base, 'js')
const scssSrc = join(base, 'scss')

module.exports = {
    entry: {
        'js/main': join(jsSrc, 'index.js'),
        'css/styles': join(scssSrc, 'styles.scss')
    },
    output: {
        filename: '[name].js',
        path: resolve(__dirname, 'public/assets')
    },
    module: {
        rules: [
            {
                test: /\.(sc|c|sa)ss$/,
                use: [
                    MiniCssExtracPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.css$/i,
                use: [
                    'style-loader',
                    'css-loader'
                ]
            },
            {
                test: /\.js$/,
                exclude: '/node_modules/',
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
        ]
    },
    plugins: [
        new WebpackFixStyleOnlyEntries(),
        new MiniCssExtracPlugin({
            filename: '[name].css'
        })
    ]
}