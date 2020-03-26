<?php
include APPPATH . 'third_party/math_parser/src/MathParser/StdMathParser.php';
include APPPATH . 'third_party/math_parser/src/MathParser/AbstractMathParser.php';
include APPPATH . 'third_party/math_parser/src/MathParser/Interpreting/Evaluator.php';
class Math_parser{
    public function get_parser(){
        $parser = new StdMathParser();
        return $parser;
    }
    public function get_evaluator(){
        $evaluator = new Evaluator();
        return $evaluator;
    }
}