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
 * Js Files
 * 
 */
// Page JS Files
const pageJsFiles__________ = GetFilesArray('resources/assets/js/*.js');
// Processing Vendor JS Files
const vendorJsFiles________ = GetFilesArray('resources/assets/vendor/js/*.js');
// Processing Libs JS Files
const libsJsFiles__________ = GetFilesArray('resources/assets/vendor/libs/**/*.js');
// Tabler Js setup files
const tablerJsSetupFiles___ = GetFilesArray('resources/tabler-dist/js/*.js');
// JS setup files
const commonJsSetupFiles___ = GetFilesArray('resources/js/*.js');
const pageJsSetupFiles_____ = GetFilesArray('resources/js/pages/*.js');
// Images setup files 
const allImgSetupFiles_____ = GetFilesArray('resources/img/*.*');

/**
 * Css & Scss Files
 * 
 */
// Processing Core, Themes & Pages Scss Files
const CoreScssFiles________ = GetFilesArray('resources/assets/vendor/scss/**/!(_)*.scss');
// Processing Libs Scss & Css Files
const LibsScssFiles________ = GetFilesArray('resources/assets/vendor/libs/**/!(_)*.scss');
const LibsCssFiles_________ = GetFilesArray('resources/assets/vendor/libs/**/*.css');
const LibsTablerCssFiles___ = GetFilesArray('resources/tabler-dist/css/*.css');
const CommonCssFiles_______ = GetFilesArray('resources/css/*.css');
// Processing Fonts Scss Files
const FontsScssFiles_______ = GetFilesArray('resources/assets/vendor/fonts/!(_)*.scss');


// Processing Window Assignment for Libs like jKanban, pdfMake
function libsWindowAssignment() {
  return {
    name: 'libsWindowAssignment',
    transform(src, id) {
      if (id.includes('jkanban.js')) {
        return src.replace('this.jKanban', 'window.jKanban');
      } else if (id.includes('vfs_fonts')) {
        return src.replaceAll('this.pdfMake', 'window.pdfMake');
      }
    }
  };
}

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/assets/css/demo.css',
        'resources/js/app.js',
        ...pageJsFiles__________,
        ...vendorJsFiles________,
        ...libsJsFiles__________,
        ...tablerJsSetupFiles___,
        ...commonJsSetupFiles___,
        ...allImgSetupFiles_____,
        ...pageJsSetupFiles_____,
        ...CoreScssFiles________,
        ...LibsScssFiles________,
        ...LibsCssFiles_________,
        ...LibsTablerCssFiles___,
        ...CommonCssFiles_______,
        ...FontsScssFiles_______
      ],
      refresh: true
    }),
    html(),
    libsWindowAssignment()
  ],

  // // 👉 tambahan ini
  // assetsInclude: ['**/*.ttf', '**/*.woff', '**/*.woff2', '**/*.eot', '**/*.svg'],

  // build: {
  //   rollupOptions: {
  //     output: {
  //       assetFileNames: (assetInfo) => {
  //         if (/\.(woff2?|ttf|eot|svg)$/.test(assetInfo.name)) {
  //           return 'assets/fonts/[name][extname]';
  //         }
  //         if (/\.(png|jpe?g|gif|webp|avif)$/.test(assetInfo.name)) {
  //           return 'assets/images/[name][extname]';
  //         }
  //         return 'assets/[name][extname]';
  //       }
  //     }
  //   }
  // }
});
