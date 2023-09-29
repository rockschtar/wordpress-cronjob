<?php

namespace Rockschtar\WordPress\Cronjob\Models;

use DateInterval;
use DateTime;

class CronjobConfig {

    private ?string $pluginFile = null;

    private string $hook = '';

    private string $recurrence = 'daily';

    private DateTime $firstRun;

    public function __construct() {

        $first_run = new DateTime();
        $first_run->add(new DateInterval('P1D'));
        $first_run->setTime(0, 0);
        $this->firstRun = $first_run;
    }

    public function getPluginFile(): string {
        return $this->pluginFile;
    }

    public function setPluginFile(string $pluginFile): CronjobConfig {
        $this->pluginFile = $pluginFile;
        return $this;
    }

    public function getHook(): string {
        return $this->hook;
    }

    public function setHook(string $hook): CronjobConfig {
        $this->hook = sanitize_key($hook);
        return $this;
    }

    public function getRecurrence(): string {
        return $this->recurrence;
    }

    /**
     * @param string $recurrence ("hourly", "twicedaily", "daily") $recurrence How often the event should recur.
     */
    public function setRecurrence(string $recurrence): CronjobConfig {
        $this->recurrence = $recurrence;
        return $this;
    }

    public function getFirstRun(): DateTime {
        return $this->firstRun;
    }

    public function setFirstRun(DateTime $firstRun): CronjobConfig {
        $this->firstRun = $firstRun;
        return $this;
    }
}
