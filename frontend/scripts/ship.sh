# DO NOT HIDE BUGS !
set -e

# Exit if $GC_APP_FOLDER hasn't been
if [ -z "$GC_APP_FOLDER" ]; then
    echo "${ERR} ERROR : No app folder specified, shipping is impossible"
    exit 1
fi

# Clean old app build
echo "$ARR Removing old app static data"
rm -rf ../../backend/$GC_APP_FOLDER/static

# Rename index file and push front-end build
echo "$ARR Renaming 'index.html' => 'app.html'"
mv build/index.html build/app.html
echo "$ARR Shipping built app to '$GC_APP_FOLDER'"
cp -r build/* ../../backend/$GC_APP_FOLDER/.
echo "${GRE}--- ALL OK ! ---${GRE}"
