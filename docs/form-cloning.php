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

$firstform = clone $form;
$firstform->getField('mytext')->setValue('David Barker');
$firstform->setOption('title', 'First Form');

$secondform = clone $firstform;

$secondform->getField('mytext')->setValue('John Stiles');
$secondform->setOption('title', 'Second Form');

$thirdform = clone $secondform;
$thirdform->getField('mytext')->setValue('Ben Hutchins');
$thirdform->setOption('title', 'Third Form');

echo $firstform;
echo $secondform;
echo $thirdform;
