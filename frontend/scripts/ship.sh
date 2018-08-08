if [ -z "$GC_APP_FOLDER" ]; then
    echo "-> WARNING : No app folder specified, shipping is impossible"
    exit 1
fi

# Clean old app build
echo "-> Removing old app static data"
rm -rf ../../backend/$GC_APP_FOLDER/static

# Rename index file and push front-end build
echo "-> Renaming 'index.html' => 'app.html'"
mv build/index.html build/app.html
echo "-> Shipping built app to '$GC_APP_FOLDER'"
cp -r build/* ../../backend/$GC_APP_FOLDER/.
echo "--- ALL OK ! ---"
