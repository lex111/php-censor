<?php

/**
 * PHPCI - Continuous Integration for PHP
 *
 * @copyright    Copyright 2015, Block 8 Limited.
 * @license      https://github.com/Block8/PHPCI/blob/master/LICENSE.md
 * @link         https://www.phptesting.org/
 */

namespace Tests\PHPCensor\Plugin\Util;

use PHPCensor\Plugin\Util\ComposerPluginInformation;

class ComposerPluginInformationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ComposerPluginInformation
     */
    protected $testedInformation;

    protected function setUpFromFile($file)
    {
        $this->testedInformation = ComposerPluginInformation::buildFromYaml($file);
    }

    protected function setup()
    {
        $this->setUpFromFile(
            __DIR__ . "/../../../../vendor/composer/installed.json"
        );
    }

    public function testBuildFromYaml_ReturnsInstance()
    {
        $this->setup();
        $this->assertInstanceOf(
            '\PHPCensor\Plugin\Util\ComposerPluginInformation',
            $this->testedInformation
        );
    }

    public function testGetInstalledPlugins_ReturnsStdClassArray()
    {
        $this->setup();
        $plugins = $this->testedInformation->getInstalledPlugins();
        $this->assertInternalType("array", $plugins);
        $this->assertContainsOnly("stdClass", $plugins);
    }

    public function testGetPluginClasses_ReturnsStringArray()
    {
        $this->setup();
        $classes = $this->testedInformation->getPluginClasses();
        $this->assertInternalType("array", $classes);
        $this->assertContainsOnly("string", $classes);
    }
}
