#!/usr/bin/env bash
echo "Installation starting"
composer install
php app/console doctrine:schema:update --force --env=test
php app/console doctrine:schema:update --force