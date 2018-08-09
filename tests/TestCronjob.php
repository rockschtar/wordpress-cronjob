<?php
/**
 * @author: StefanHelmer
 */

namespace Rockschtar\WordPress\Cronjob\Tests;

use Rockschtar\WordPress\Cronjob\AbstractCronjob;
use Rockschtar\WordPress\Cronjob\Models\CronjobConfig;
use Rockschtar\WordPress\DateTimeUtils\DateTimeUtils;

class TestCronjob extends AbstractCronjob {

    public function execute(): void {

        //do some stuff
        $x = 1+1;
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