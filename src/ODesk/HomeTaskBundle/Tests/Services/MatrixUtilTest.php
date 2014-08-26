<?php
namespace ODesk\HomeTaskBundle\Tests\Services;

use ODesk\HomeTaskBundle\Services\MatrixUtil;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenSpiralMatrix()
    {
        $word = 'test';

        $this->assertEquals(array(
            array('t', 'e', 's'),
            array('t', 't', 't'),
            array('s', 'e', 't')
        ), MatrixUtil::genSpiralMatrix($word, 3));

        $this->assertEquals(array(
            array('t', 'e'),
            array('t', 's')
        ), MatrixUtil::genSpiralMatrix($word, 2));

        $this->assertEquals(array(array('t')), MatrixUtil::genSpiralMatrix($word, 1));

        try {
            MatrixUtil::genSpiralMatrix('', null);
        } catch (\InvalidArgumentException $expected) {
            $this->assertEquals($expected->getMessage(), 'Word can\'t be empty');
        } catch (\Exception $e) {
            $this->fail('An expected exception has not been raised.');
        }
    }
}