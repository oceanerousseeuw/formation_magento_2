<?php

namespace Correction\TP8\Test\Unit\Observer;

class AddTrigramme extends \PHPUnit\Framework\TestCase
{
    /** @var  \Correction\TP7\Observer\AddTrigramme */
    protected $realInstance;

    protected $objectManagerHelper;

    protected $currentValue = '';

    protected function setUp()
    {
        $this->objectManagerHelper = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->realInstance = $this->objectManagerHelper->getObject(\Correction\TP7\Observer\AddTrigramme::class, [
            'trigrammeHelper' => $this->objectManagerHelper->getObject(\Correction\TP7\Helper\Trigramme::class)
        ]);
    }

    public function testSimple()
    {
        $this->assertGreaterThan(1, 2);
    }

    public function testTrigrammeOK()
    {
        $observerDataMock = $this->createMock(\Magento\Framework\Event\Observer::class);
        $eventMock = $this->createPartialMock(\Magento\Framework\Event::class, ['getCustomer']);
        $customer = $this->createPartialMock(\Magento\Customer\Model\Customer::class, ['getFirstname', 'getLastname', 'setData']);

        $customer
            ->expects($this->at(0))
            ->method('getFirstname')
            ->will($this->returnValue('Alain'));
        $customer
            ->expects($this->at(1))
            ->method('getLastname')
            ->will($this->returnValue('Dupont'));
        $customer
            ->expects($this->at(2))
            ->method('setData')
            ->with('trigramme')
            ->willReturnCallback(
                function ($key, $value) {
                    $this->currentValue = $value;
                }
            );

        $eventMock->expects($this->any())
            ->method('getCustomer')
            ->will($this->returnValue($customer));

        $observerDataMock->expects($this->any())
            ->method('getEvent')
            ->will($this->returnValue($eventMock));

        $this->realInstance->execute($observerDataMock);
        $this->assertEquals($this->currentValue, 'ADU');
        $this->assertNotEquals($this->currentValue, 'ADL');
    }

    protected function tearDown()
    {
        // pas nécessaire, mais présent à titre d'exemple
        unset($this->realInstance);
    }
}