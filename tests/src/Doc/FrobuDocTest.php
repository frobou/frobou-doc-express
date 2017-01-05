<?php

namespace Frobou\Doc;

use Frobou\Test\DocTestClassApi;

require_once 'DocTestClassApi.php';

class FrobuDocTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provider
     */
    public function testSeiLa($val,$field){

        $this->assertEquals($val,$field);
    }

    public function provider(){
        $api = new FrobouDocApi();
        $obj = $api->getClassDoc(DocTestClassApi::class);
        return [
            ['Adicionar um novo domínio de email', $obj->umnomeaqui->description[0]],
            ['nome=como deve ser', $obj->umnomeaqui->rule[0]],
            ['o retorno', $obj->umnomeaqui->return[0]],
            ['nome=como deve ser', $obj->umnomeaqui->optrule[0]]
        ];
    }

    public function testSeiLaErrado()
    {
        $api = new FrobouDocApi();
        $this->assertNull($api->getClassDoc(FrobouDocApi::class));
    }

}
