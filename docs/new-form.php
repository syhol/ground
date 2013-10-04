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

echo '<p>';

//Print the form
echo $form;

//Print the field value
echo 'mytext was "' . $form->getField('mytext')->getValue() . '"';

//Change a field value
$form->getField('mytext')->setValue('Yawolloh Nomis');

echo '<br>';

//Echo the new field value
echo 'mytext is now "' . $form->getField('mytext')->getValue() . '"';

echo '</p><p>';

//Loop through the form fields
foreach ($form as $textfield) {
    //Echo the field markup
    echo $textfield . '<br>';
    //Echo the field value
    echo $textfield->getValue();
}

echo '</p>';
