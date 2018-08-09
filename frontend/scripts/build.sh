# DO NOT HIDE BUGS !
set -e

# Build app
npm run build

# Remove useless files
echo "$ARR Removing service-worker.js"
rm -rf build/service-worker.js
echo "$ARR Removing favicon.ico"
rm -rf build/favicon.ico

# Chain with ship
sh ship.sh
