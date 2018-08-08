# Fetch scripts
cp ../scripts/* .

export GC_APP_FOLDER="mod"

# Launch scripts
sh compile.sh
sh build.sh
sh ship.sh
