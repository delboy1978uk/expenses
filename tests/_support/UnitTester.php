<?php


use Codeception\Test\Unit;

class UnitTester extends Unit
{
    /** @var \Pimple\Container $container */
    private $container;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }
}