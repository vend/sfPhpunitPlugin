<?php

abstract class sfBasePhpunitSelenium2TestCase extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->configureDriver();
    }

    protected function configureDriver()
    {
        $selenium_options = sfConfig::get('sf_phpunit_selenium2', array());

        foreach ($selenium_options['driver'] as $option => $value) {
            if (false === $value) continue;

            $setOption = explode('_', $option);
            $setOption = 'set'.implode(array_map('ucfirst', $setOption));

            // @TODO validate options
            if (method_exists($this, $setOption)) {
                $this->$setOption($value);
            }
        }
    }
}