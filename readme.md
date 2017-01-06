## Frobou Doc Go, by frobou ##

--- readme mal e porcamente escrito, nao é o foco agora...

regras:

classe deve ter anotacao @endpoint e @name  

/**
 * @entrypoint  
 * @name DocTestClassApi  
 */  
@entrypoint indica se a classe é um ponto de entrada  
@name indica o nome do recurso  

cada classe apta deve ter anotacoes nos metodos necessarios, exemplo:

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
     */
    public function func1($arg1, $arg2, $arg3=false)
    {
		return $arg1 + $arg2;
    }
    
para usar faça o seguinte:  
crie o objeto principal  
$api = new FrobouDocApi();  
vasculhe uma classe anotada  
$obj = $api->getClassDoc(DocTestClassApi::class);  
use o array associativo resultante da forma que precisar.  

uma ideia é criar uma anotação @teste teste=(valor1=valor,valor2=valor) e parsear conforme necessário  
a imaginação é o limite
