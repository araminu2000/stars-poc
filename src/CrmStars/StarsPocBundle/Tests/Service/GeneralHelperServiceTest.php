<?php

namespace CrmStars\StarsPocBundle\Tests\Service;


use CrmStars\StarsPocBundle\Service\GeneralHelperService;

class GeneralHelperServiceTest extends \PHPUnit_Framework_TestCase {

    public function testGenerateRandomString_Default() {
        $string = GeneralHelperService::generateRandomString();

        $this->assertNotNull($string);
        $this->assertEquals(10, strlen($string));
    }

    public function testGenerateRandomString_ValidData() {
        $size = 20;
        $string = GeneralHelperService::generateRandomString($size);

        $this->assertNotNull($string);
        $this->assertEquals($size, strlen($string));
    }
}