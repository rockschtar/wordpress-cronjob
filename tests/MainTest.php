<?php
/**
 * @author: StefanHelmer
 */

namespace Rockschtar\WordPress\Cronjob\Tests;

class MainTest extends \PHPUnit\Framework\TestCase {
    protected function setUp(): void
    {
        parent::setUp();
        \Brain\Monkey\setUp();
    }

    protected function tearDown(): void
    {
        \Brain\Monkey\tearDown();
        parent::tearDown();
    }

    public function testCronjob() {

        \Brain\Monkey\Functions\stubs(['sanitize_key' => fn(string $key) => $key]);

        \Brain\Monkey\Functions\when('register_activation_hook')->justReturn();
        \Brain\Monkey\Functions\when('register_deactivation_hook')->justReturn();

        $cronjob = TestCronjob::init();
        self::assertTrue(has_action($cronjob->config()->getHook(), 'Rockschtar\WordPress\Cronjob\Tests\TestCronjob->execute()'));
        self::assertTrue(has_action('admin_action_' . $cronjob->config()->getHook(), 'Rockschtar\WordPress\Cronjob\Tests\TestCronjob->execute()'));
    }
}
