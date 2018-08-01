npm run build
rm -rf build/service-worker.js
cp -r build/* ../backend/app/.
