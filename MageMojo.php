<?php

// Created by Rafael Correa Gomes
//
// Installing deployer and dependencies
//
// curl -LO https://deployer.org/deployer.phar && sudo mv deployer.phar /usr/local/bin/dep && sudo chmod +x /usr/local/bin/dep
// composer require rafaelstz/deployer-magemojo dev-master --dev

namespace Deployer;

set('stratus_cli', '/usr/share/stratus/cli');

desc('It will issue a redeploy of PHP-FPM services');
task('mm:autoscaling:reinit', function () {
    run("{{stratus_cli}} autoscaling.reinit");
});

desc('Clears everything');
task('mm:cache:clear', function () {
    run("{{stratus_cli}} cache.all.clear");
});

desc('Clears Cloudfront cache');
task('mm:cloudfront:clear', function () {
    run("{{stratus_cli}} cache.cloudfront.invalidate");
});

desc('Clears OPCache cache');
task('mm:opcache:clear', function () {
    run("{{stratus_cli}} cache.opcache.flush");
});

desc('Clears Redis cache');
task('mm:redis:clear', function () {
    run("{{stratus_cli}} cache.redis.clear");
});

desc('Clears Varnish cache');
task('mm:varnish:clear', function () {
    run("{{stratus_cli}} cache.varnish.clear");
});
