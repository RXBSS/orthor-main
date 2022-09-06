const gulp = require('gulp');
const browserSync = require('browser-sync').create();
var sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const rename = require("gulp-rename");
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const del = require('del');


/**
 * Gulp-Funktionen
 * Die Funktionen sind wie folgt aufgeteilt:
 * 
 * 
 * - main
 * - copyScripts
 * - copyStyles
 * 
 * - vendor
 * - copyScripts
 * - copyStyles
 * 
 * - helper
 * -
 * 
 * 
 * 
 * 
 * 
 */
var g = {

    /**
     * Alle Funktionen für das Hauptprogramm
     */
    main: {

        /**
         * Kopiert die 
         */
        copyScripts: function () {

            var scripts = [
                './src/js/app-assigns/*.js',
                './src/js/*.js'
            ];

            return gulp.src(scripts)
                .pipe(concat('orthor.js'))
                .pipe(gulp.dest('./dist/js/'))
                .pipe(gulp.dest('./test/js/'))
                .pipe(rename('orthor.min.js'))
                .pipe(terser())
                .pipe(gulp.dest('./dist/js/'))
                .pipe(gulp.dest('./test/js/'));
        },

        /**
         * Wandelt SCSS in CSS um 
         * Merged Bootstrap 
         * ...
         */
        copyStyles: function () {

            return gulp.src('./src/scss/**/*.scss')
                .pipe(sourcemaps.init())
                .pipe(sass())
                .pipe(sourcemaps.write('.'))
                .pipe(gulp.dest('./dist/css/'))
                .pipe(gulp.dest('./test/css/'));
        },

        /**
         * Kopiert alle PHP Seiten
         */
        copyTest: function () {

            return gulp.src('./src/test/**/*.*')

                // Dafür sorgen, dass alle in ein Verzeichnis geschrieben werden
                .pipe(rename({ dirname: '' }))

                // In Destination verschieben
                .pipe(gulp.dest('./test/'));
        },

        // Kopiert alles aus Pages und Plugins außer Pagelevel
        copyPagesAndPluginsRaw: function () {

            // Angabe der Quelle
            var src = [
                './src/plugins/**/*.*',         // Alle Dateien aus Plugins, siehe unten
                './src/pages/**/*.*',           // Alle Dateien aus Pages, siehe unten
                '!./src/plugins/**/*.js',         // JS-Dateien - Plugins
                '!./src/pages/**/*.js',         // JS-Dateien - Pages
                '!./src/plugins/**/*.css',        // CSS-Dateien - Plugins
                '!./src/pages/**/*.css',        // CSS-Dateien - Pages
                '!./src/plugins/**/*-api.php',    // API-Dateien - Plugins
                '!./src/pages/**/*-api.php'     // API-Dateien - Pages
            ];

            return gulp.src(src)

                // Dafür sorgen, dass alle in ein Verzeichnis geschrieben werden
                .pipe(rename({ dirname: '' }))

                // In Destination verschieben
                .pipe(gulp.dest('./test/'))
                .pipe(gulp.dest('./dist/'));
        },

        // Pagelevel JavaScript
        copyPageLevelJs: function () {

            // Src
            var src = [
                './src/plugins/**/*.js',
                './src/pages/**/*.js'
            ];

            return gulp.src(src)

                // Dafür sorgen, dass alle in ein Verzeichnis geschrieben werden
                .pipe(rename({ dirname: '' }))

                // In Destination verschieben
                .pipe(gulp.dest('./test/js/pagelevel/'))
                .pipe(gulp.dest('./dist/js/pagelevel/'));
        },

        // Page Level CSS
        copyPageLevelCss: function () {

            // Src
            var src = [
                './src/plugins/**/*.css',
                './src/pages/**/*.css'
            ];

            return gulp.src(src)

                // Dafür sorgen, dass alle in ein Verzeichnis geschrieben werden
                .pipe(rename({ dirname: '' }))

                // In Destination verschieben
                .pipe(gulp.dest('./test/css/pagelevel/'))
                .pipe(gulp.dest('./dist/css/pagelevel/'));
        },

        // Page Level API
        copyPageLevelApi: function () {

            // Src
            var src = [
                './src/plugins/**/*-api.php',
                './src/pages/**/*-api.php'
            ];

            return gulp.src(src)

                // Dafür sorgen, dass alle in ein Verzeichnis geschrieben werden
                .pipe(rename({ dirname: '' }))

                // In Destination verschieben
                .pipe(gulp.dest('./test/api/plugins/'))
                .pipe(gulp.dest('./dist/api/plugins/'));
        },

        // Kopiert die API
        copyApi: function () {

            return gulp.src(['./src/api/**/*.php'])

                // Dafür sorgen, dass alle in ein Verzeichnis geschrieben werden
                .pipe(rename({ dirname: '' }))

                // In Destination verschieben
                .pipe(gulp.dest('./dist/api/'))
                .pipe(gulp.dest('./test/api/'));
        },

        // Kopiert die API
        copyAssets: function () {

            return gulp.src(['./src/assets/**/*'])

                // In Destination verschieben
                .pipe(gulp.dest('./dist/assets/'))
                .pipe(gulp.dest('./test/assets/'));
        },

        /**
         * Kopiert alle Includes
         */
        copyIncludes: function () {

            return gulp.src(['./src/includes/**/*.php'])

                // Dafür sorgen, dass alle in ein Verzeichnis geschrieben werden
                .pipe(rename({ dirname: '' }))

                // In Destination verschieben
                .pipe(gulp.dest('./dist/includes/'))
                .pipe(gulp.dest('./test/includes/'));
        },


        /**
         * Kopiert die Module
         */
        copyModules: function () {
            return gulp.src(['./src/modules/**/*'])
                .pipe(gulp.dest('./dist/modules/'))
                .pipe(gulp.dest('./test/modules/'));
        },

        /**
         * Kopiert die Module
         */
        copyMisc: function () {
            return gulp.src(['./src/VERSION_ORTHOR', './src/config.json', './src/.htaccess'])
                .pipe(gulp.dest('./dist/'))
                .pipe(gulp.dest('./test/'));
        },


        /**
         * dist und test Verzeichnisse löschen
         */
        clearEnv: function () {
            return del(['./dist/**', './test/**', '!./dist/data', '!./test/data']);
        },

        /**
         * Löscht unnötige Dateien beim Deployen raus
         */
        clearDist: function() {
            return del([
                './dist/modules/picklist/**',
                '!./dist/modules/picklist/laender',
                '!./dist/modules/picklist/user',
                './dist/modules/quickselect/**',
                '!./dist/modules/quickselect/laender.php',
                '!./dist/modules/quickselect/user.php'
            ]);
        }


    },


    /**
     * Alle Funktionen für die Vendor Data
     */
    vendor: {


        /**
         * Kopiert alle JavaScripte der Drittanbieter
         */
        copyScripts: function () {

            // JavaScript Dependencys
            var jsArray = [
                './node_modules/moment/moment.js',
                './node_modules/jquery/dist/jquery.min.js',
                './node_modules/jquery-debounce-throttle/index.js',
                './node_modules/@popperjs/core/dist/umd/popper.min.js',
                './node_modules/bootstrap/dist/js/bootstrap.min.js',
                './node_modules/select2/dist/js/select2.full.min.js',
                './node_modules/select2/dist/js/i18n/de.js',
                './node_modules/sweetalert2/dist/sweetalert2.min.js',
                './node_modules/datatables.net/js/jquery.dataTables.min.js',
                './node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js',
                './node_modules/datatables.net-select/js/dataTables.select.min.js',
                './node_modules/datatables.net-select-bs5/js/select.bootstrap5.min.js',
                // './node_modules/datatables.net-keytable/js/dataTables.keyTable.min.js',
                './manual_modules/datatables.keytable/dataTables.keyTable.custom.js',
                './node_modules/datatables.net-keytable-bs5/js/keytable.bootstrap5.min.js',
                './node_modules/chart.js/dist/chart.min.js',
                './node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js',
                './node_modules/jquerycopytoclipboard/src/copyToClipboard.js',
                './node_modules/autosize/dist/autosize.min.js',
                './node_modules/hotkeys-js/dist/hotkeys.min.js',

                './node_modules/summernote/dist/summernote-lite.js',
                // './node_modules/summernote/dist/summernote-bs5.js',
                './node_modules/summernote/dist/lang/summernote-de-DE.min.js',

                './node_modules/google-libphonenumber/dist/libphonenumber.js',

                // Fancy Box
                './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.js',

                // './node_modules/signature_pad/dist/signature_pad.min.js',
                // wird das JavaScript für Font Awesome überhaupt benötigt?
                // './node_modules/@fortawesome/fontawesome-free/js/fontawesome.min.js' 
                './manual_modules/formvalidation.io/js/FormValidation.full.js',
                './manual_modules/formvalidation.io/js/plugins/Bootstrap5.min.js',
                './manual_modules/formvalidation.io/js/locales/de_DE.min.js'



            ];

            // Rückgabe
            return gulp.src(jsArray)
                .pipe(concat('vendor.min.js'))
                .pipe(gulp.dest('./dist/js/'))
                .pipe(gulp.dest('./test/js/'));
        },


        copyLocales: function () {

            return gulp.src([
                './node_modules/datatables.net-plugins/i18n/de-DE.json',
            ])
                .pipe(gulp.dest('./dist/js/locales/'))
                .pipe(gulp.dest('./test/js/locales/'));

        },


        /**
         * Kopiert alle Stylesheets der Drittanbieter
         */
        copyStyles: function () {

            // CSS Kopieren
            var cssArray = [
                './node_modules/select2/dist/css/select2.css',
                './node_modules/sweetalert2/dist/sweetalert2.css',
                './node_modules/@fortawesome/fontawesome-free/css/all.css',
                './node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css',
                './node_modules/datatables.net-select-bs5/css/select.bootstrap5.css',
                './node_modules/datatables.net-keytable-bs5/css/keytable.bootstrap5.css',
                './manual_modules/formvalidation.io/css/formValidation.css',
                './node_modules/jquerycopytoclipboard/src/copyToClipboard.css',

                 // Fancy Box
                 './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css',

                './node_modules/summernote/dist/summernote-lite.min.css',
                './node_modules/summernote/dist/summernote-bs5.css'

            ];

            // Rückgabe
            return gulp.src(cssArray)
                .pipe(concat('vendor.css'))
                .pipe(gulp.dest('./dist/css/'))
                .pipe(gulp.dest('./test/css/'));
        },

        copyMaps: function () {

            var mapsArray = [
                './node_modules/summernote/dist/summernote-bs5.css.map'
            ];

            return gulp.src(mapsArray)
                .pipe(gulp.dest('./dist/css/'))
                .pipe(gulp.dest('./test/css/'));
        },


        /**
         * Kopiert alle Schritarten der Drittanbieter
         * @TODO Muss noch geschrieben werden (FontAwesome)
         */
        copyFonts: function () {

            // Nur die Fonts die benötigt werden!
            var fontArray = [

                // Font Awesome
                './node_modules/@fortawesome/fontawesome-free/webfonts/fa-brands-400.woff2',
                './node_modules/@fortawesome/fontawesome-free/webfonts/fa-regular-400.woff2',
                './node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2',

                // Open Sans
                './node_modules/@fontsource/open-sans/files/open-sans-latin-300-normal.woff',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-300-normal.woff2',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-400-normal.woff',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-400-normal.woff2',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-500-normal.woff',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-500-normal.woff2',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-600-normal.woff',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-600-normal.woff2',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-700-normal.woff',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-700-normal.woff2',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-800-normal.woff',
                './node_modules/@fontsource/open-sans/files/open-sans-latin-800-normal.woff2',

                // Fonts von SummerNote
                './node_modules/summernote/dist/font/summernote.eot',
                './node_modules/summernote/dist/font/summernote.ttf',
                './node_modules/summernote/dist/font/summernote.woff',
                './node_modules/summernote/dist/font/summernote.woff2'
            ];

            // Rückgabe
            return gulp.src(fontArray)
                .pipe(gulp.dest('./dist/webfonts/'))
                .pipe(gulp.dest('./test/webfonts/'));
        },

        /**
         * Composer kopieren
         */
        copyComposer: function (cb) {

            cb();
            /*

            return gulp.src('./vendor/**')
            .pipe(gulp.dest('./dist/vendor/'))
            .pipe(gulp.dest('./test/vendor/'));

            */
        },

        /**
         * Optionale Vendor Scripte kopieren
         */
        copyOptionals() {

            var jsArray = [
                './node_modules/cytoscape/dist/cytoscape.min.js',
            ];

            // Rückgabe
            return gulp.src(jsArray)
                .pipe(gulp.dest('./dist/js/optionals'))
                .pipe(gulp.dest('./test/js/optionals'));
        }

    },

    /**
     * Erstellt die Distribution
     * @TODO Muss 
     */
    deploy: function (cb) {

        console.log('Erstelle die Distribution');

        // Den dist Ordner löschen
        // Den dist Ordner aus der SRC erstellen
        // Alle Dependencies einfügen
        // Alle CSS Skripte mergen
        // Alle JS Skripte mergen
        // Dokumentation automatisch erstellen
        // ......
        // Zähle Build Version Nummer hoch
        // Lade automatisch auf den FTP-Server hoch
        // Informiere Leute per E-Mail

        cb();
    },

    /**
     * Watch
     */
    watch: function () {

        // BrowserSync
        browserSync.init({
            proxy: 'http://orthor.localhost/',
            notify: false
        });

        // Tasks zum Überwachen
        // ********************

        // Überwacht die JS Ordner
        gulp.watch('./src/js/**/*.js').on('change', gulp.series(['copyScripts', browserSync.reload]));

        // Überwacht die SCSS Ordner
        gulp.watch('./src/scss/**/*.scss').on('change', gulp.series(['copyStyles', browserSync.reload]));

        // Überwacht die Test Ordner
        gulp.watch('./src/test/**/*').on('change', gulp.series(['copyTest', browserSync.reload]));

        // Copy Pages
        gulp.watch(['./src/pages/**/*', './src/plugins/**/*']).on('change', gulp.series(['copyPagesAndPlugins', browserSync.reload]));

        // Überwachung der API
        gulp.watch('./src/api/**/*.php').on('change', gulp.series(['copyApi', browserSync.reload]));

        // Copy Assets
        gulp.watch('./src/assets/**/*').on('change', gulp.series(['copyAssets', browserSync.reload]));

        // Modules
        gulp.watch('./src/modules/**/*').on('change', gulp.series(['copyModules', browserSync.reload]));

        // Includes
        gulp.watch('./src/includes/**/*').on('change', gulp.series(['copyIncludes', browserSync.reload]));

        // Misc
        gulp.watch(['./src/VERSION', './src/config.json', './src/.htaccess']).on('change', gulp.series(['copyMisc', browserSync.reload]));
    }


}

// DIST und TEST leeren
exports.clearEnv = gulp.task('clearEnv', g.main.clearEnv);

// Main
exports.copyScripts = gulp.task('copyScripts', g.main.copyScripts);
exports.copyStyles = gulp.task('copyStyles', g.main.copyStyles);
exports.copyTest = gulp.task('copyTest', g.main.copyTest);

// Pages und Plugins
exports.copyPagesAndPluginsRaw = gulp.task('copyPagesAndPluginsRaw', g.main.copyPagesAndPluginsRaw);

exports.copyPageLevelJs = gulp.task('copyPageLevelJs', g.main.copyPageLevelJs);
exports.copyPageLevelCss = gulp.task('copyPageLevelCss', g.main.copyPageLevelCss);
exports.copyPageLevelApi = gulp.task('copyPageLevelApi', g.main.copyPageLevelApi);
exports.copyPageLevel = gulp.task('copyPageLevel', gulp.series('copyPageLevelJs', 'copyPageLevelCss', 'copyPageLevelApi'));

exports.copyPagesAndPlugins = gulp.task('copyPagesAndPlugins', gulp.series('copyPagesAndPluginsRaw', 'copyPageLevel'));

// Copy API
exports.copyApi = gulp.task('copyApi', g.main.copyApi);
exports.copyAssets = gulp.task('copyAssets', g.main.copyAssets);
exports.copyModules = gulp.task('copyModules', g.main.copyModules);
exports.copyIncludes = gulp.task('copyIncludes', g.main.copyIncludes);
exports.copyMisc = gulp.task('copyMisc', g.main.copyMisc);


// Vendor (Drittanbeiter)
exports.copyVendorScripts = gulp.task('copyVendorScripts', g.vendor.copyScripts);
exports.copyVendorStyles = gulp.task('copyVendorStyles', g.vendor.copyStyles);
exports.copyVendorMaps = gulp.task('copyVendorMaps', g.vendor.copyMaps);
exports.copyVendorLocales = gulp.task('copyVendorLocales', g.vendor.copyLocales);
exports.copyVendorFonts = gulp.task('copyVendorFonts', g.vendor.copyFonts);
exports.copyVendorOptionals = gulp.task('copyVendorOptionals', g.vendor.copyOptionals);
exports.copyVendorComposer = gulp.task('copyVendorComposer', g.vendor.copyComposer);

// Kombinationen - Parallel und Series
exports.copy = gulp.task('copy', gulp.parallel('copyScripts', 'copyStyles', 'copyTest', 'copyPagesAndPlugins', 'copyApi', 'copyAssets', 'copyModules', 'copyIncludes', 'copyMisc'));
exports.copyVendor = gulp.task('copyVendor', gulp.parallel('copyVendorScripts', 'copyVendorStyles', 'copyVendorMaps', 'copyVendorLocales', 'copyVendorFonts', 'copyVendorComposer', 'copyVendorOptionals'));
exports.copyAll = gulp.task('copyAll', gulp.series('clearEnv', gulp.parallel('copy', 'copyVendor')));

// Standard Funktionen
exports.clearDist = gulp.task('clearDist', g.main.clearDist);
exports.deploy = gulp.task('deploy', gulp.series('clearEnv', gulp.parallel('copy', 'copyVendor'), 'clearDist'));
exports.startWatch = gulp.task('startWatch', g.watch);
exports.watch = gulp.task('watch', gulp.series('copyAll', 'startWatch'));