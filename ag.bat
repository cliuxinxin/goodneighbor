@echo off
echo begin to git push new version.
git add .
git commit -m %1
git push
echo new version be pushed.