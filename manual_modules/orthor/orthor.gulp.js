// Includes
const gulp = require('gulp');
const browserSync = require('browser-sync').create();
var sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const rename = require("gulp-rename");
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const del = require('del');

/**
 * Standard Task für Orthor
 * 
 */
var obj = {

    // Konstanten
    system: 'template',


    // Erstellen und kopieren der SCSS Datei von Aule
    copyStyles: function () {

        var src = [
            './src/scss/**/*.scss'
        ];

        return gulp.src(src)
            .pipe(sourcemaps.init())
            .pipe(sass())
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest('./dist/css/'));
    },


    // Erstellen und kopieren der SCSS Datei von Aule
    copyScripts: function () {

        var scripts = [
            './src/js/*.js',
            './src/**/*-global.js'
        ];

        return gulp.src(scripts)
            .pipe(concat(obj.system + '.js'))
            .pipe(gulp.dest('./dist/js/'))
            .pipe(rename(obj.system + '.min.js'))
            // .pipe(terser())
            .pipe(gulp.dest('./dist/js/'));
    },


    // Includes (init, header, navigation, scripts)
    copyIncludes: function () {
        return gulp.src(['./src/includes/**/*']).pipe(gulp.dest('./dist/'));
    },

    // Kopier alle benötigten Daten aus Orthor
    copyOrthor: function () {
        return gulp.src(['./orthor/dist/**']).pipe(gulp.dest('./dist/'));
    },

    // Kopiert die Module
    copyModules: function () {
        return gulp.src(['./src/modules/**/*']).pipe(gulp.dest('./dist/modules/'));
    },

    // Kopiert die API
    copyApi: function () {
        return gulp.src(['./src/api/**/*.php']).pipe(rename({ dirname: '' })).pipe(gulp.dest('./dist/api/'));
    },

    // Kopiert die API
    copyAssets: function () {
        return gulp.src(['./src/assets/**/*']).pipe(gulp.dest('./dist/assets/'));
    },

    // Kopiert die Version und die Config
    copyMisc: function () {
        return gulp.src(['./src/VERSION', './src/config.json', './src/.htaccess']).pipe(gulp.dest('./dist/'));
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
            .pipe(rename({ dirname: '' }))
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
            .pipe(rename({ dirname: '' }))
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
            .pipe(rename({ dirname: '' }))
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
            .pipe(rename({ dirname: '' }))
            .pipe(gulp.dest('./dist/api/plugins/'));
    },

    // Löscht die komplette Umgebung bis auf das Data Verzeichnis
    clearEnv: function () {
        return del(['./dist/**', '!./dist/data']);
    },

    // Watch Task für Browsersync
    startWatch: function () {

        // Pfad zu Browser Sync
        var browserSyncPath = (typeof obj.browserSyncPath == 'undefined') ? 'http://' + obj.system + '.localhost/' : obj.browserSyncPath;

        // BrowserSync
        browserSync.init({
            proxy: browserSyncPath
        });

        // Tasks zum Überwachen
        // ********************

        // Überwacht die SCSS Ordner
        gulp.watch('./src/scss/**/*.scss').on('change', gulp.series([obj.copyStyles, browserSync.reload]));

        // Überwacht die JS Ordner
        gulp.watch('./src/js/**/*.js').on('change', gulp.series([obj.copyScripts, browserSync.reload]));

        // Includes
        gulp.watch('./src/includes/**/*').on('change', gulp.series([obj.copyIncludes, browserSync.reload]));

        // Wenn Orthor aktualisiert wurde
        // Ausgegraut aus Performance Gründen
        // gulp.watch('./orthor/**/*').on('change', gulp.series([obj.clearEnv, obj.copyOrthor, gulp.parallel(obj.copyPagesAndPluginsRaw, obj.copyPageLevelCss, obj.copyPageLevelJs, obj.copyPageLevelApi, obj.copyStyles, obj.copyScripts, obj.copyIncludes, obj.copyModules, obj.copyMisc, obj.copyAssets), browserSync.reload]));

        // Modules
        gulp.watch('./src/modules/**/*').on('change', gulp.series([obj.copyModules, browserSync.reload]));

        // Überwachung der API
        gulp.watch('./src/api/**/*.php').on('change', gulp.series([obj.copyApi, browserSync.reload]));

        // Assets
        gulp.watch('./src/assets/**/*').on('change', gulp.series([obj.copyAssets, browserSync.reload]));

        // Copy Pages & Plugins
        gulp.watch(['./src/pages/**/*', './src/plugins/**/*']).on('change', gulp.series([obj.copyScripts, obj.copyPagesAndPluginsRaw, obj.copyPageLevelCss, obj.copyPageLevelJs, obj.copyPageLevelApi, browserSync.reload]));

        // Version und Config
        gulp.watch(['./src/VERSION', './src/config.json', './src/.htaccess']).on('change', gulp.series([obj.copyMisc, browserSync.reload]));

    },
}


module.exports = obj;