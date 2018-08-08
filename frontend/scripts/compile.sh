# Clean, then copy common components
echo "-> Refreshing local components"
rm -rf src/components/common
cp -r ../common/components src/components/common
