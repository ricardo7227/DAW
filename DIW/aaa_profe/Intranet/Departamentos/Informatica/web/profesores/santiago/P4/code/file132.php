<?php
class SimpleClass
{
    // member declaration
    public $var = 'a default value';

    // method declaration
    public function displayVar() {
        echo $this->var . "<BR>" ;
    }
}

$instance = new SimpleClass();

// This can also be done with a variable:
$className = 'SimpleClass';
$instance = new $className(); // Foo()

$assigned   =  $instance;
$reference  =& $instance;

$instance->var = '$assigned will have this value';
$assigned->displayVar();
$instance->displayVar();

$instance = null; // $instance and $reference become null

var_dump($instance);
var_dump($reference);
var_dump($assigned);

?> 


