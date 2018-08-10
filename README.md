# rockschtar/cronjob

# Requirements

  - PHP 7.1+
  - [Composer](https://getcomposer.org/) to install

# License

rockschtar/wordpress-cronjob is open source and released under MIT license. See LICENSE file for more info.

# Usage

Create a cronjob class

    class TestCronjob extends AbstractCronjob {

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

Initialize the class

    TestCronjob::init();


# Question? Issues?

rockschtar/wordpress-cronjob is hosted on GitLab. Feel free to open issues there for suggestions, questions and real issues.
