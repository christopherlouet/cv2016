#!/bin/bash

echo "running post install scripts"

cd /var/www/docker-symfony
npm install
rm -rf /usr/local/bin/bower
rm -rf /usr/local/bin/gulp
ln -s /var/www/docker-symfony/node_modules/bower/bin/bower /usr/local/bin/bower
ln -s /var/www/docker-symfony/node_modules/gulp/bin/gulp.js /usr/local/bin/gulp

# install libraries
composer self-update
composer update

# install assets
bower update --allow-root

# deploys assets
gulp clean
gulp

# ACL config
HTTPDUSER='www-data'
LOCALUSER='root'

setfacl -R -m u:"$HTTPDUSER":rwX -m u:"$LOCALUSER":rwX var
setfacl -dR -m u:"$HTTPDUSER":rwX -m u:"$LOCALUSER":rwX var

# database init
bin/console doctrine:schema:update --force
bin/console app:schema:clean --all
bin/console app:schema:update --all

# cache clear prod
bin/console cache:clear --env=prod