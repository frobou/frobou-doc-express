<?php

namespace Frobou\Doc;

use Frobou\Test\DocTestClassApi;

class FrobuDocTest extends \PHPUnit_Framework_TestCase
{

    public function testSeiLa()
    {
        $api = new FrobouDocApi(DocTestClassApi::class);
        $this->assertArrayHasKey('um nome aqui', $api->seila());
        $this->assertArrayHasKey('construtor', $api->seila());
    }

    public function testSeiLaErrado()
    {
        $api = new FrobouDocApi(FrobouDocApi::class);
        $this->assertNull($api->seila());
    }

}
