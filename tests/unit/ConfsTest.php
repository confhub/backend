<?php

namespace ConfHub;

class ConfsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Confs
     */
    protected $target;

    protected function _before()
    {
        $this->target = new Confs();
    }

    protected function _after()
    {
        $this->target = null;
    }

    public function testTitle()
    {
        // Arrange
        $title = 'PHPConf 2016';
        $expected = 'PHPConf 2016';

        // Act
        $this->target->setTitle($title);
        $actual = $this->target->getTitle();

        // Assert
        $this->assertEquals($expected, $actual);
    }
}
