<?php

include '../vendor/autoload.php';
//include '../manual-init.php';

//Load some useful functions
include 'inc/config.php';

//$formarray = include(__DIR__ . '/inc/standard-form.php');
//$generator = Ground\Core\Generator::usingArray($formarray);

//$formjson = file_get_contents(__DIR__ . '/inc/standard-form.json');
//$generator = Ground\Core\Generator::usingJsonString($formjson);

//$generator = Ground\Core\Generator::usingArrayFile(__DIR__ . '/inc/standard-form.php');

$generator = Ground\Core\Generator::usingJsonFile(__DIR__ . '/inc/standard-form.json');

$form = $generator->get();

$model = new Ground\Core\Models\RawDataModel($_REQUEST);
$validator = new Ground\Core\Validator();

$validator->addRule(new Ground\Core\Rules\Required());
$validator->addRule(new Ground\Core\Rules\MaxChar());

$model->loadField($form);

$validator->validateField($form);

if ($validator->hasErrors()) {
    echo '<h4 style="color: red;">ERRORS</h4>';
}

echo $form;
