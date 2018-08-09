# DO NOT HIDE BUGS !
set -e

# Colors
export RED='\033[0;31m'
export GRE='\033[0;32m'
export CYA='\033[0;36m'
export NC='\033[0m'

# Prefix arrow
export ARR="${CYA}-->${NC}"
export ERR="${RED}x_x${NC}"

# Clean, then copy common components
echo "$ARR Refreshing local components"
rm -rf src/components/common
cp -r ../common/components src/components/common
echo "$ARR Refreshing local helpers"
rm -rf src/helpers/common
cp -r ../common/helpers src/helpers/common

# Chain with build
sh build.sh
