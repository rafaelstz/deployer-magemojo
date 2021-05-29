<?php

// Created by Rafael Correa Gomes
//
// Installing deployer and dependencies
//
// curl -LO https://deployer.org/deployer.phar && sudo mv deployer.phar /usr/local/bin/dep && sudo chmod +x /usr/local/bin/dep
// composer require rafaelstz/deployer-magemojo dev-master --dev

namespace Deployer;

set('stratus_cli', '/usr/share/stratus/cli');

desc('Stop Crons');
task('mm:cron:stop', function () {
    run("{{stratus_cli}} crons.stop");
});

desc('Start Crons');
task('mm:cron:start', function () {
    run("{{stratus_cli}} crons.start");
});

desc('Zero Downtime Deployment Init');
task('mm:zdd:init', function () {
    run("{{stratus_cli}} zerodowntime.init");
});

desc('Zero Downtime Deployment Switch');
task('mm:zdd:switch', function () {
    run("{{stratus_cli}} zerodowntime.switch 2>&1 | grep -q \'ERROR\' && echo \"[ERROR] Something went wrong, waiting and repeating switch one more time\" && sleep 120 && /usr/share/stratus/cli zerodowntime.switch || echo \"[SUCCESS]\"");
});

desc('It will issue a redeploy of PHP-FPM services');
task('mm:autoscaling:reinit', function () {
    run("{{stratus_cli}} autoscaling.reinit && sleep 120s");
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

after('success', 'mm:cache:clear');
