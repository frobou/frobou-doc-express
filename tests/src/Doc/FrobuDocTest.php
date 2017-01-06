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
            ['Manda a carroça para algum lugar', $obj['DocTestClassApi']['umnomeaqui']['description'][0]],
            ['$arg1=deve ser uma string', $obj['DocTestClassApi']['umnomeaqui']['rule'][0]],
            ['{"A carroça foi 5 vezes para pinda"}', $obj['DocTestClassApi']['umnomeaqui']['return'][0]],
            ['nome=true para pinda, false para monhangaba', $obj['DocTestClassApi']['umnomeaqui']['optrule'][0]]
        ];
    }

    public function testSeiLaErrado()
    {
        $api = new FrobouDocApi();
        $this->assertNull($api->getClassDoc(FrobouDocApi::class));
    }

}
