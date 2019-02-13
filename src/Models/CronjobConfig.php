<?php
/**
 * @author: StefanHelmer
 */

namespace Rockschtar\WordPress\Cronjob\Models;

use Rockschtar\WordPress\DateTimeUtils\DateTimeUtils;

class CronjobConfig {

    /**
     * @var string
     */
    private $plugin_file;

    /**
     * @var string
     */
    private $hook;

    /**
     * @var string
     */
    private $recurrence = 'daily';

    /**
     * @var \DateTime
     */
    private $first_run;

    public function __construct() {

        $first_run = new \DateTime();
        /** @noinspection PhpUnhandledExceptionInspection */
        $first_run->add(new \DateInterval('P1D'));
        $first_run->setTime(0, 0, 0);

        $this->first_run = $first_run;
    }

    /**
     * @return string
     */
    public function getPluginFile(): string {
        return $this->plugin_file;
    }

    /**
     * @param string $plugin_file
     * @return CronjobConfig
     */
    public function setPluginFile(string $plugin_file): CronjobConfig {
        $this->plugin_file = $plugin_file;
        return $this;
    }

    /**
     * @return string
     */
    public function getHook(): string {
        return $this->hook;
    }

    /**
     * @param string $hook
     * @return CronjobConfig
     */
    public function setHook(string $hook): CronjobConfig {
        $this->hook = sanitize_key($hook);
        return $this;
    }


    public function getRecurrence(): string {
        return $this->recurrence;
    }

    /**
     * @param string("hourly", "twicedaily", "daily") $recurrence How often the event should recur.
     * @return CronjobConfig
     */
    public function setRecurrence(string $recurrence): CronjobConfig {
        $this->recurrence = $recurrence;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFirstRun(): \DateTime {
        return $this->first_run;
    }

    /**
     * @param \DateTime|null $first_run
     * @return CronjobConfig
     */
    public function setFirstRun(\DateTime $first_run): CronjobConfig {
        $this->first_run = $first_run;
        return $this;
    }
}