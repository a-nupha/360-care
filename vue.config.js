// const path = require('path')
const webpack = require('webpack')

module.exports = {
  configureWebpack: {
    resolve: {
      extensions: ['.js'],
      alias: {
        jquery: 'jquery/dist/jquery.slim.js',
      },
    },
    plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        Popper: ['popper.js', 'default'],
        Util: 'exports-loader?Util!bootstrap/js/dist/util',
      }),
      // new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
    ],
  },
  devServer: {
    // disableHostCheck: true,
    proxy: {
      '/api': {
        target: 'https://a-nuphasupit58.000webhostapp.com',
        secure: true,
        changeOrigin: true,
      },
    },
    // resolve: {
    //   alias: {
    //     vue$: 'vue/dist/vue.common.js',
    //     jquery: 'jquery/src/jquery.js',
    //   },
    // },
  },
  pwa: {
    name: '365-care',
    themeColor: '#2196F3',
    msTileColor: '#1976D2',
  },

}
