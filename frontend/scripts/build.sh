# Build app
npm run build


# Remove useless files
echo "-> Removing service-worker.js"
rm -rf build/service-worker.js
echo "-> Removing favicon.ico"
rm -rf build/favicon.ico
