<?php

namespace Frobou\Test;

/**
 * @entrypoint
 * @entrypoint
 * @name    DocTestClassApi
 */

class DocTestClassApi
{
    /**
     * @var teste=ok
     */
    private $prop1;

    /**
     * @endpoint false
     * DocTestClassApi constructor.
     * @name prop1
     * @telefone  naot   tem nada
     */
    public function __construct($prop1)
    {
        $this->prop1 = $prop1;
    }

    /**
     * @endpoint
     * @name umnomeaqui
     * @description Manda a carroça para algum lugar
     * @method GET
     * @expected {"arg1": "","arg2":"","arg3":""}
     * @field $arg1=decricao do campo
     * @field $arg2=descricao do campo
     * @optfield $arg3=descricao do campo
     * @rule $arg1=deve ser uma string
     * @rule $arg2=deve ser um inteito de 0 a 10
     * @optrule nome=true para pinda, false para monhangaba
     * @obs Para que o recurso funcione é necessário que use o PHP
     * @example {"arg1": "Carroça","arg2":5,"arg3":true}
     * @return {"A carroça foi 5 vezes para pinda"}
     * @teste esse trem tem mais de
     uma linha
     e outra,
     e outra...
     */
    public function func1($arg1, $arg2, $arg3=false)
    {
        $vou = 'pinda';
        if ($arg3){
            $vou = 'monhangaba';
        }
        return json_encode("A {$arg1} foi {$arg2} vez(es) para {$vou}");
    }

}