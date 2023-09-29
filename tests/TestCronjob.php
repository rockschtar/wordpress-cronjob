<?php

namespace Rockschtar\WordPress\Cronjob\Tests;

use Rockschtar\WordPress\Cronjob\CronJob;
use Rockschtar\WordPress\Cronjob\Models\CronjobConfig;

class TestCronjob extends CronJob {

    public function execute(): void {
        //do some stuff
    }

    public function config(): CronjobConfig {
        $config = new CronjobConfig();
        $config->setHook('do_test_cronjob');
        $config->setPluginFile('some_plugin.php');
        $config->setFirstRun(new \DateTime());
        $config->setRecurrence('daily');
        return $config;
    }
}
