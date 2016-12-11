<?php

namespace Frobou\Test;

/**
 * Class DocTestClassApi
 * @package Frobou\Test
 */

class DocTestClassApi
{
    /**
     * @var teste=ok
     */
    private $prop1;

    public function __construct($prop1)
    {
        $this->prop1 = $prop1;
    }

    /**
     * @description Adicionar um novo domínio de email
     * @nada   dsadf
     * @method GET
     * @expected {"domain": "","description":"","aliases":"","mailboxes":"","maxquota":"","backupmx":"","active":"","default-aliases":""}
     * @field nome=o que o campo faz
     * @field nome=o que o campo faz 2
     * @optfield nome=o que o campo faz
     * @optfield nome=o que o campo faz2
     * @rule nome=como deve ser
     * @rule nome=como deve ser
     * @optrule nome=como deve ser
     * @obs alguma coisa relevante
     * @example {"domain": "","description":"","aliases":"","mailboxes":"","maxquota":"","backupmx":"","active":"","default-aliases":"",
     *  "domain": "","description":"","aliases":"","mailboxes":"","maxquota":"","backupmx":"","active":"","default-aliases":""}
     * @example {"domain": "","description":"","aliases":"","mailboxes":"","maxquota":"","backupmx":"","active":"","default-aliases":""}
     * @return o retorno
     * @return o retorno
     * @naosei (algum=valor, outro=valor)
     * nao pode
     * @name umnomeaqui
     */
    public function func1($arg1, $arg2)
    {
        return $arg1 + $arg2;
    }

}