<?php
/**
 * @author: StefanHelmer
 */

namespace Rockschtar\WordPress\Cronjob;

use Rockschtar\WordPress\Cronjob\Models\CronjobConfig;

abstract class AbstractCronjob {
    /**
     * @var
     */
    private static $_instances;

    /**
     * AbstractCronJob constructor.
     */
    final public function __construct() {
        $config = $this->config();
        register_activation_hook($config->getPluginFile(), array(&$this, 'schedule_cronjob'));
        register_deactivation_hook($config->getPluginFile(), array(&$this, 'unschedule_cronjob'));
        add_action($this->config()->getHook(), array(&$this, 'execute'));
        add_action('admin_action_' . $this->config()->getHook(), array(&$this, 'execute'));
    }

    /**
     * @return static
     */
    final public static function &init() {
        /** @noinspection ClassConstantCanBeUsedInspection */
        $class = \get_called_class();
        if(!isset(self::$_instances[$class])) {
            self::$_instances[$class] = new $class();
        }
        return self::$_instances[$class];
    }

    final public function schedule_cronjob(): void {
        wp_schedule_event($this->config()->getFirstRun()->getTimestamp(), $this->config()->getRecurrence(), $this->config()->getHook());
    }

    final public function unschedule_cronjob(): void {
        wp_clear_scheduled_hook($this->config()->getHook());
    }

    final public function reschedule(): void {
        $this->unschedule_cronjob();
        $this->schedule_cronjob();
    }

    abstract public function execute(): void;

    abstract public function config(): CronjobConfig;

}