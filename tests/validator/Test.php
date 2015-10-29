<?php
use Defrauder\Validator;

class validatorTest extends PHPUnit_Framework_TestCase
{
    public function testAmountIsValid()
    {
        $validator = new Validator();
        $result = $validator->amountIsValid(10, 200, 10);
        $this->assertFalse($result);

        $result = $validator->amountIsValid(10, 90, 10);
        $this->assertTrue($result);
    }

    public function testLocationIsValid()
    {
        $zipcodes = array(
          48438,
          48471,
          48460,
          45071,
          56043
        );

        $validator = new Validator();
        $result = $validator->locationIsValid($zipcodes, 90210);
        $this->assertFalse($result);

        $validator = new Validator();
        $result = $validator->locationIsValid($zipcodes, 54332);
        $this->assertTrue($result);
    }
}
