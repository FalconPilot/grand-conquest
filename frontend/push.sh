npm run build
rm -rf build/service-worker.js
rm -rf build/favicon.ico
mv build/index.html build/app.html
cp -r build/* ../backend/app/.
