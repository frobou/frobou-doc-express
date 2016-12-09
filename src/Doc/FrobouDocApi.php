<?php

namespace Frobou\Doc;

class FrobouDocApi
{
    private $classname;
    private $output = null;

    public function __construct($classname)
    {
        $this->classname = $classname;
    }

    private function arruma($data)
    {
        $out = [];
        foreach ($data as $value) {
            $out[trim(substr($value, 1, strpos($value, ' ')))] = trim(substr($value, strpos($value, ' ')));
        }
        if (key_exists('name', $out)) {
            $this->output[$out['name']] = [];
            foreach ($out as $key => $value) {
                if ($key == 'name') {
                    continue;
                }
                array_push($this->output[$out['name']], [$key => $value]);
            }
        }
    }

    public function seila()
    {
        $ref_class = new \ReflectionClass($this->classname);
        $mets = $ref_class->getMethods();
        foreach ($mets as $value) {
            $ref_meth = new \ReflectionMethod($this->classname, $value->name);
            if ($ref_meth->getDocComment() === false) {
                continue;
            }
            preg_match_all("/(@[\w]+ {1,}+[^\n]+)/m", $ref_meth->getDocComment(), $tags, PREG_PATTERN_ORDER);
            $this->arruma($tags[1]);
        }
        return $this->output;
    }

}

//        var_dump($ref_class->getDocComment());die;
//        var_dump($ref_class->getProperties());die;

//        $ref_prop = new \ReflectionProperty($this->classname, 'prop1');
//        $ref_meth = new \ReflectionMethod($this->classname, 'func1');
//        var_dump($ref_prop->getDocComment());die;