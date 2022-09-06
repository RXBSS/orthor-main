REM Init NPM
call npm init -y

REM install Global
call npm install gulp-cli -g 

REM install Lokales
call npm install browser-sync del gulp gulp-concat gulp-rename gulp-sass gulp-sourcemaps gulp-uglify sass

echo.

REM Composer Datei kopieren
copy .\orthor\composer.json .\composer.json
call composer install

REM Snippets kopieren
copy .\orthor\.vscode\javascript.json.code-snippets .\.vscode\orthor.json.code-snippets

REM Update durchführen
call update

color 0A
echo Installation erfolgreich!

