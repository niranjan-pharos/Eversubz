const mix = require('laravel-mix');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');
const TerserPlugin = require('terser-webpack-plugin');

// PurgeCSS configuration
const purgecss = require('@fullhuman/postcss-purgecss')({
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.jsx',
        './resources/js/**/*.ts',
        './resources/js/**/*.tsx',
        './resources/js/**/*.js',
        './resources/css/**/*.css'
    ],
    defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
});

mix.js('resources/js/app.js', 'public/js/app.js')
    .babelConfig({
        presets: ['@babel/preset-env']
    })
    .options({
        processCssUrls: false // Disable URL processing
    });

if (mix.inProduction()) {
    // **Production Settings**: Minified with no comments
    mix.version();
    mix.options({
        postCss: [purgecss]
    });

    mix.webpackConfig({
        plugins: [new BundleAnalyzerPlugin()], // Add Bundle Analyzer plugin

        optimization: {
            minimize: true, // Enable minification
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        format: {
                            comments: false, // Remove all comments in production
                        },
                    },
                    extractComments: false, // Don't extract comments into separate files
                }),
            ],
        },
        devtool: false // Disable source maps in production
    });
} else {
    // **Development Settings**: Unminified with comments
    mix.options({
        postCss: [] // Disable PurgeCSS in development
    });

    mix.webpackConfig({
        optimization: {
            minimize: false // Disable minification in development
        },
        devtool: 'inline-source-map', // Enable inline source maps for better debugging
    });
}
