npm run build
rm -rf build/service-worker.js
mv build/index.html build/app.html
cp -r build/* ../backend/app/.
