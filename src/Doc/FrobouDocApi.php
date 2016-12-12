<?php

namespace Frobou\Doc;

class FrobouDocApi
{
    private $classname;
    private $output = [];

    public function __construct($classname)
    {
        $this->classname = $classname;
    }

    private function generateOutput($data)
    {
        $out = [];
        foreach ($data as $value) {
            $key = trim(substr($value, 1, strpos($value, ' ')));
            if (!isset($out[$key])){
                $out[$key] = [];
            }
            array_push($out[$key], trim(substr($value, strpos($value, ' '))));
        }
        if (key_exists('name', $out)) {
            $this->output[$out['name'][0]] = [];

            foreach ($out as $key => $value) {
                if ($key == 'name') {
                    continue;
                }
                foreach ($value as $val){
                    $index = $out['name'][0];
                    if (!isset($this->output[$index][$key])){
                        $this->output[$index][$key] = [];
                    }
                    array_push($this->output[$index][$key], $val);
                }
            }
        }
    }

    public function getClassDoc()
    {
        $ref_class = new \ReflectionClass($this->classname);
        $mets = $ref_class->getMethods();
        foreach ($mets as $value) {
            $ref_meth = new \ReflectionMethod($this->classname, $value->name);
            if ($ref_meth->getDocComment() === false) {
                continue;
            }
            preg_match_all("/(@[\w]+ {1,}+[^\n]+)/m", $ref_meth->getDocComment(), $tags, PREG_PATTERN_ORDER);
            $this->generateOutput($tags[1]);
        }
        if (count($this->output) == 0){
            return null;
        }
        return json_decode(json_encode($this->output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

}

//        var_dump($ref_class->getDocComment());die;
//        var_dump($ref_class->getProperties());die;

//        $ref_prop = new \ReflectionProperty($this->classname, 'prop1');
//        $ref_meth = new \ReflectionMethod($this->classname, 'func1');
//        var_dump($ref_prop->getDocComment());die;