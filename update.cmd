@echo off

if not [%1]==[] goto changeDevStatus


: ____________________________________________________________
: Wenn kein Argument mitgegeben wurde, dann Default ausführen!
:update

: Node Modules
call npm install

: Composer
call composer install

: Distribution erstellen
call gulp deploy

: Copy SQL Skripts
copy .\src\sql\install\*.* .\..\src\sql\install
copy .\src\sql\update\*.* .\..\src\sql\update

: Snippets kopieren
copy .\.vscode\javascript.json.code-snippets .\..\.vscode\orthor.json.code-snippets

echo.
echo ** UPDATE IST FERTIG!
git branch --show-current

exit /B 1


: ______________________________________________________________
: Wenn ein Wechsel des Status über ein Argument mitgegeben wurde
:changeDevStatus

: 
if /I %* EQU dev GOTO dev
if /I %* EQU main GOTO main

: ---- INVALID
echo.
echo ** Unbekannter Befehl (Es steht nur dev / main zur Verfügung)
exit /B 1

: ---- DEV
:dev
SET /P AREYOUSURE=Wollen Sie das Repository auf DEV umstellen? (Y/[N])?
IF /I "%AREYOUSURE%" NEQ "Y" GOTO END

: GIT Befehle
git stash
git fetch
git checkout dev
git pull

echo ** Orthor wurde auf DEV umgestellt
GOTO update

exit /B 1
: ---- MAIN
:main
SET /P AREYOUSURE=Wollen Sie das Repository auf MAIN umstellen? (Y/[N])?
IF /I "%AREYOUSURE%" NEQ "Y" GOTO END

: GIT Befehle
git stash
git fetch
git checkout main
git pull

echo ** Orthor wurde auf Main umgestellt
GOTO update

exit /B 1

:end
echo. 
echo ** Vorgang abgebrochen
