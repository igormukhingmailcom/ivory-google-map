<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Directions;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Directions\DirectionsLeg;
use Ivory\GoogleMap\Service\Directions\DirectionsStep;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsLegTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionsLeg
     */
    private $leg;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->leg = new DirectionsLeg();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->leg->hasDuration());
        $this->assertNull($this->leg->getDuration());
        $this->assertFalse($this->leg->hasDistance());
        $this->assertNull($this->leg->getDistance());
        $this->assertFalse($this->leg->hasEndAddress());
        $this->assertNull($this->leg->getEndAddress());
        $this->assertFalse($this->leg->hasEndLocation());
        $this->assertNull($this->leg->getEndLocation());
        $this->assertFalse($this->leg->hasStartAddress());
        $this->assertNull($this->leg->getStartAddress());
        $this->assertFalse($this->leg->hasStartLocation());
        $this->assertNull($this->leg->getStartLocation());
        $this->assertFalse($this->leg->hasSteps());
        $this->assertEmpty($this->leg->getSteps());
        $this->assertFalse($this->leg->hasViaWaypoints());
        $this->assertEmpty($this->leg->getViaWaypoints());
    }

    public function testDuration()
    {
        $this->leg->setDuration($duration = $this->createDurationMock());

        $this->assertTrue($this->leg->hasDuration());
        $this->assertSame($duration, $this->leg->getDuration());
    }

    public function testResetDuration()
    {
        $this->leg->setDuration($this->createDurationMock());
        $this->leg->setDuration(null);

        $this->assertFalse($this->leg->hasDuration());
        $this->assertNull($this->leg->getDuration());
    }

    public function testDistance()
    {
        $this->leg->setDistance($distance = $this->createDistanceMock());

        $this->assertTrue($this->leg->hasDistance());
        $this->assertSame($distance, $this->leg->getDistance());
    }

    public function testResetDistance()
    {
        $this->leg->setDistance($this->createDistanceMock());
        $this->leg->setDistance(null);

        $this->assertFalse($this->leg->hasDistance());
        $this->assertNull($this->leg->getDistance());
    }

    public function testEndAddress()
    {
        $this->leg->setEndAddress($endAddress = 'address');

        $this->assertTrue($this->leg->hasEndAddress());
        $this->assertSame($endAddress, $this->leg->getEndAddress());
    }

    public function testResetEndAddress()
    {
        $this->leg->setEndAddress('address');
        $this->leg->setEndAddress(null);

        $this->assertFalse($this->leg->hasEndAddress());
        $this->assertNull($this->leg->getEndAddress());
    }

    public function testEndLocation()
    {
        $this->leg->setEndLocation($endLocation = $this->createCoordinateMock());

        $this->assertTrue($this->leg->hasEndLocation());
        $this->assertSame($endLocation, $this->leg->getEndLocation());
    }

    public function testResetEndLocation()
    {
        $this->leg->setEndLocation($this->createCoordinateMock());
        $this->leg->setEndLocation(null);

        $this->assertFalse($this->leg->hasEndLocation());
        $this->assertNull($this->leg->getEndLocation());
    }

    public function testStartAddress()
    {
        $this->leg->setStartAddress($startAddress = 'address');

        $this->assertTrue($this->leg->hasStartAddress());
        $this->assertSame($startAddress, $this->leg->getStartAddress());
    }

    public function testResetStartAddress()
    {
        $this->leg->setStartAddress('address');
        $this->leg->setStartAddress(null);

        $this->assertFalse($this->leg->hasStartAddress());
        $this->assertNull($this->leg->getStartAddress());
    }

    public function testStartLocation()
    {
        $this->leg->setStartLocation($startLocation = $this->createCoordinateMock());

        $this->assertTrue($this->leg->hasStartLocation());
        $this->assertSame($startLocation, $this->leg->getStartLocation());
    }

    public function testResetStartLocation()
    {
        $this->leg->setStartLocation($this->createCoordinateMock());
        $this->leg->setStartLocation(null);

        $this->assertFalse($this->leg->hasStartLocation());
        $this->assertNull($this->leg->getStartLocation());
    }

    public function testSetSteps()
    {
        $this->leg->setSteps($steps = [$step = $this->createStepMock()]);
        $this->leg->setSteps($steps);

        $this->assertTrue($this->leg->hasSteps());
        $this->assertTrue($this->leg->hasStep($step));
        $this->assertSame($steps, $this->leg->getSteps());
    }

    public function testAddSteps()
    {
        $this->leg->setSteps($firstSteps = [$this->createStepMock()]);
        $this->leg->addSteps($secondSteps = [$this->createStepMock()]);

        $this->assertTrue($this->leg->hasSteps());
        $this->assertSame(array_merge($firstSteps, $secondSteps), $this->leg->getSteps());
    }

    public function testAddStep()
    {
        $this->leg->addStep($step = $this->createStepMock());

        $this->assertTrue($this->leg->hasSteps());
        $this->assertTrue($this->leg->hasStep($step));
        $this->assertSame([$step], $this->leg->getSteps());
    }

    public function testRemoveStep()
    {
        $this->leg->addStep($step = $this->createStepMock());
        $this->leg->removeStep($step);

        $this->assertFalse($this->leg->hasSteps());
        $this->assertFalse($this->leg->hasStep($step));
        $this->assertEmpty($this->leg->getSteps());
    }

    public function testSetViaWaypoints()
    {
        $this->leg->setViaWaypoints($viaWaypoints = ['foo' => 'bar']);

        $this->assertTrue($this->leg->hasViaWaypoints());
        $this->assertSame($viaWaypoints, $this->leg->getViaWaypoints());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Duration
     */
    private function createDurationMock()
    {
        return $this->createMock(Duration::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Distance
     */
    private function createDistanceMock()
    {
        return $this->createMock(Distance::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionsStep
     */
    private function createStepMock()
    {
        return $this->createMock(DirectionsStep::class);
    }
}