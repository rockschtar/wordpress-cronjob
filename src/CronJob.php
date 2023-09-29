<?php

namespace Rockschtar\WordPress\Cronjob;

use Rockschtar\WordPress\Cronjob\Models\CronjobConfig;

abstract class CronJob {

    private static ?array $_instances = null;

    final public function __construct() {
        $config = $this->config();
        register_activation_hook($config->getPluginFile(), $this->schedule(...));
        register_deactivation_hook($config->getPluginFile(), $this->clearSchedule(...));
        add_action($this->config()->getHook(), $this->execute(...));
        add_action($this->config()->getHook() . '_clear_schedule', $this->clearSchedule(...));
        add_action('admin_action_' . $this->config()->getHook(), $this->execute(...));
    }

    final public static function &init() : static {
        $class = static::class;
        if(!isset(self::$_instances[$class])) {
            self::$_instances[$class] = new $class();
        }
        return self::$_instances[$class];
    }

    final public function schedule(): void {
        wp_schedule_event($this->config()->getFirstRun()->getTimestamp(), $this->config()->getRecurrence(), $this->config()->getHook());
    }

    final public function clearSchedule(): void {
        wp_clear_scheduled_hook($this->config()->getHook());
    }

    final public static function reschedule(): void {
        $instance = self::init();
        $instance->clearSchedule();
        $instance->schedule();
    }

    abstract public function execute(): void;

    abstract public function config(): CronjobConfig;

}
