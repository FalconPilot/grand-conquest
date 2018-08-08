# Clean, then copy common components
rm -rf src/components/common
cp -r ../common/components src/components/common

# Build project
npm run build

# Remove useless files
rm -rf build/service-worker.js
rm -rf build/favicon.ico

# Clean old app build
rm -rf ../../backend/app/static

# Rename index file and push front-end build
mv build/index.html build/app.html
cp -r build/* ../../backend/app/.
