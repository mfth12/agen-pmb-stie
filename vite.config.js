import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import html from '@rollup/plugin-html';
import { glob } from 'glob';

/**
 * Get Files from a directory
 * @param {string} query
 * @returns array
 */
function GetFilesArray(query) {
    return glob.sync(query);
}


/**
 * Pendeklarasian path untuk setiap resources
 */

// CSS setup files
const allCssSetupFiles = GetFilesArray('resources/css/*.js');

// JS setup files
const allJsSetupFiles = GetFilesArray('resources/js/*.js');

// siakad3 js files
// const systemJsFiles = GetFilesArray('resources/js/system/*.js');
// const dmasterJsFiles = GetFilesArray('resources/js/dmaster/*.js');
// const spmbJsFiles = GetFilesArray('resources/js/spmb/*.js');
// const kemahasiswaanJsFiles = GetFilesArray('resources/js/kemahasiswaan/*.js');
// const kurikulumJsFiles = GetFilesArray('resources/js/akademik/*.js');
// const keuanganJsFiles = GetFilesArray('resources/js/keuangan/*.js');


/**
 * Scss Files
 */

// Processing Core, Themes & Pages Scss Files
// const CoreScssFiles = GetFilesArray('resources/assets/vendor/scss/**/!(_)*.scss');

// DEFINE CONFIG YANG LAMA
// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js'
//             ],
//             refresh: true,
//         }),
//     ],
// });

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/back/adminlte-lama.min.css',
                'resources/js/app.js',
                // Add this line - load vendor setup files first
                ...allCssSetupFiles,
                ...allJsSetupFiles,
                // ...vendorJsFiles
            ],
            refresh: true
        }),
        html()
    ]
});
