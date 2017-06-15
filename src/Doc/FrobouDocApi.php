<?php

namespace Frobou\Doc;

class FrobouDocApi
{

    /**
     * @param object $ref
     * @return null|string
     */
    private function getEntryPoint($ref)
    {
        preg_match_all("/(@[\w]+ {0,})+[\n]+/m", $ref->getDocComment(), $tag_class, PREG_PATTERN_ORDER);
        $entrypoint = array_unique($tag_class[1]);
        if (!in_array('@entrypoint', $entrypoint)) {
            //se nao for, pula tudo
            return null;
        }
        //define o nome do entrypoint
        preg_match_all("/(@[\w]+ {1,}+[^\n]+)/m", $ref->getDocComment(), $tag_name, PREG_PATTERN_ORDER);
        $n = array_unique($tag_name[1]);
        foreach ($n as $value) {
            if (strpos($value, '@name ') !== false) {
                $entry_name = trim(str_replace('@name ', '', $value));
                break;
            }
        }
        if (!isset($entry_name)) {
            //se nao for, pula tudo
            return null;
        }
        return $entry_name;
    }

    /**
     * @param object $ref
     * @return null|string
     */
    private function getEndPoint($ref)
    {
        //define se o metodo é elgivel ou nao
        preg_match_all("/(@[\w]+ {0,})+[\n]+/m", $ref->getDocComment(), $tag_method, PREG_PATTERN_ORDER);
        $endpoint = array_unique($tag_method[1]);
        if (!in_array('@endpoint', $endpoint)) {
            //se nao for, pula tudo
            return null;
        }
        //define o nome do entrypoint
        preg_match_all("/(@[\w]+ {1,}+[^\n]+)/m", $ref->getDocComment(), $meth_tag_name, PREG_PATTERN_ORDER);
        $n = array_unique($meth_tag_name[1]);
        foreach ($n as $value) {
            if (strpos($value, '@name ') !== false) {
                $point_name = trim(str_replace('@name ', '', $value));
                break;
            }
        }
        if (!isset($point_name)) {
            //se nao for, pula tudo
            return null;
        }
        return $point_name;
    }

    public function getClassDoc($classname)
    {
        $ref_class = new \ReflectionClass($classname);
        //define se a classe é elgivel ou nao
        $entry = $this->getEntryPoint($ref_class);
        if (is_null($entry)) {
            return null;
        }
        $result[$entry] = [];


        //hora de colocar os endpoints
        //pega os metodos anotados
        $mets = $ref_class->getMethods();
        foreach ($mets as $value) {
            $ref_meth = new \ReflectionMethod($classname, $value->name);
            if ($ref_meth->getDocComment() === false) {
                continue;
            }
            $point = $this->getEndPoint($ref_meth);
            if (is_null($point)) {
                continue;
            }
            $result[$entry][$point] = [];

            //agora é que eu quero ver....
            preg_match_all("/(@[\w]+ {1,}+[^\*]+)/m", $ref_meth->getDocComment(), $tags, PREG_PATTERN_ORDER);
            foreach ($tags[1] as $value) {
                if (strpos($value, '@name ') !== false) {
                    continue;
                }
                $val = explode(' ', $value, 2);
                $name = str_replace('@', '', trim($val[0]));
                if (!isset($result[$entry][$point][$name])) {
                    $result[$entry][$point][$name] = [];
                }
                array_push($result[$entry][$point][$name], trim($val[1]));
            }
        }
        return $result;

    }
}
