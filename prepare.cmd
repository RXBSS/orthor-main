@echo off

echo Git Pull
call git pull

echo NPM Install
call npm install

echo Reset Database
call orthor db reset