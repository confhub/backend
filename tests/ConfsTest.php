<?php
declare(strict_types=1);

namespace ConfHub;

use PHPUnit_Framework_TestCase as TestCase;

class ConfsTest extends TestCase
{
    /**
     * @var Confs
     */
    protected $target;

    public function setUp()
    {
        $this->target = new Confs();
    }

    public function tearDown()
    {
        $this->target = null;
    }

    public function testSayHelloWhenNameIsMilesWillReturnHelloMiles()
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