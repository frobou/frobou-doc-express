<?php

namespace Frobou\Doc;

use Frobou\Test\DocTestClassApi;

require_once 'DocTestClassApi.php';

class FrobuDocTest extends \PHPUnit_Framework_TestCase
{

    public function testSeiLa()
    {
        $api = new FrobouDocApi(DocTestClassApi::class);
        $obj = $api->seila();
        $this->assertEquals('Adicionar um novo domínio de email',$obj->umnomeaqui->description[0]);
        $this->assertEquals('nome=como deve ser',$obj->umnomeaqui->rule[0]);
    }

    public function testSeiLaErrado()
    {
        $api = new FrobouDocApi(FrobouDocApi::class);
        $this->assertNull($api->seila());
    }

    /**
     * @dataProvider provider
     */
    public function testData($um, $dois){

    }

    public function provider(){
        return [
            ['um', 'dois'],
            ['tres', 'quatro']
        ];
    }

}
