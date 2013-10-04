<?php

include '../vendor/autoload.php';
//include '../manual-init.php';

//Load some useful functions
include 'inc/config.php';

//Build the form
$form = (new Ground\Core\Form('myform'))
->setAction(getPageUrl())
->setMethod('POST')
->setOption('title', 'My Form')
->addField(
    (new Ground\Core\Fields\TextBox('mytext'))
    ->setOption('title', 'Name')
    ->setValue('Simon Holloway')
);

echo $form;

$formserial = serialize($form);

echo $formserial;

$form = unserialize($formserial);

echo $form;
