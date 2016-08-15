<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\StatController;

/*Контроллер вывода страниц сайта*/
class MathController extends Controller {


    public function __construct() {
    }
    public function count($operation) {
        /*Задача №1*/
        /*Парсим входные данные, в случае ошибки возвращаем ошибку*/
        if(preg_match("/^([0-9.]+)([+-:\*]?)([0-9.]+)$/", $operation, $matches))
        {
            $a = $matches[1];
            $b = $matches[3];
            $action = $matches[2];
            /* Вычичляем операцию */
            $new_op = new Operation($a,$b,$action,'float');
            /* Возвращаем полученное значения */
            $out = array('success'=>'ok','value'=>$new_op->getValue());
        }else $out = array('success'=>'error');;
        return json_encode($out);
    }

    public function results() {
       
        $content = '';
       
        /*Задача №3*/
        //Алгоритм 1)Разделяем слово пополам 2) Символы в половинках делаем в обратном порядке 3) Объедияем полученные половинки в обратном порядке и между ними ставим средний символ, если в слове нечетное количество символов. 4) Полученное слово: результат
        $word = 'test_word';
        $half = floor(strlen($word)/2);
        $half1 = str_split(substr($word,0,$half));
        $half2 = str_split(substr($word,-$half));
        $new_half1 = $new_half2 = '';
        for( $i=($half-1); $i>=0; $i-- )
        {
            $new_half1 .= $half1[$i];
            $new_half2 .= $half2[$i];
        }
        $new_word = $new_half2.(strlen($word)%2 ? substr($word, $half, 1) :'').$new_half1;
        
        
        $content .= '<h2>Задача №3</h2><h4>Old word: '.$word.'</h4>';
        $content .= '<h4>New word: '.$new_word.'</h4>';
        
        $response = response(view('results', ['content' => $content]));
        return $response;
    }
}
/**
 * A class of variable
 *
 * @property      string $type
 * @property      $value
 */
class Variable {
    private $type;
    private $value;
    public function __construct( $value, $type = 'int' )
    {
        $this->type = $type;
        $this->setValue($value);
    }
    public function setType($type){
        $this->type = $type;
    }
    public function setValue($value){
        switch ($this->type)
        {
            case 'float': $this->value = floatval($value); break;
            case 'int': $this->value = intval($value); break;
        }        
    }
    public function getValue()
    {
        return $this->value;
    }
}
  
/**
 * A class of operation
 *
 * @property      Variable $A
 * @property      Variable $B
 * @property      Variable $C
 * @property      string $action
 */
class Operation {
    private $A;
    private $B;
    private $C;
    private $action;
    public function __construct( $valueA, $valueB, $action, $type = 'int' )
    {
        $this->A = new Variable($valueA, $type);
        $this->B = new Variable($valueB, $type);
        $this->C = new Variable(0, $type);
        $this->action = $action;
        $this->doit();
    }
    public function setValueA($value){
        $this->A->setValue($value);
    }
    public function setValueB($value){
        $this->B->setValue($value);
    }
    public function doit(){
        $value = 0;
        switch ($this->action)
        {
            case '+': $value = $this->A->getValue()+$this->B->getValue(); break;
            case '-': $value = $this->A->getValue()-$this->B->getValue(); break;
            case ':': $value = $this->A->getValue()/$this->B->getValue(); break;
            case '/': $value = $this->A->getValue()/$this->B->getValue(); break;
            case '*': $value = $this->A->getValue()*$this->B->getValue(); break;
        }
        $this->C->setValue($value);
    }
    public function getValue()
    {
        return $this->C->getValue();
    }
}
