<?php

namespace Rockschtar\WordPress\Cronjob;


abstract class SingleJob {

    /**
     * @var
     */
    private static $_instances;

    private function __construct() {
        add_action($this->hookname(), [&$this, 'handle'], 10, 2);
    }

    abstract protected function hookname(): string;

    final public static function register(): void {
        /** @noinspection ClassConstantCanBeUsedInspection */
        $class = \get_called_class();
        if (!isset(self::$_instances[$class])) {
            self::$_instances[$class] = new $class();
        }

        self::$_instances[$class];
    }

    /**
     * @return SingleJob
     */
    final public static function event(): self {
        /** @noinspection ClassConstantCanBeUsedInspection */
        $class = \get_called_class();
        if (!isset(self::$_instances[$class])) {
            throw new \RuntimeException('Event is not registered');
        }

        return self::$_instances[$class];
    }

    abstract public function handle(...$args): void;

    final public function dispatch(array $args = [], int $secondsFromNow = 180): void {
        $this->_dispatch($args, time() + $secondsFromNow);
    }

    private function _dispatch(array $args, int $timestamp): void {
        wp_schedule_single_event($timestamp, $this->hookname(), $args);
    }

    final public function dispatchAtTime(array $args, int $timestamp): void {
        $this->_dispatch($args, $timestamp);
    }

}