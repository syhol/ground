<?php

include '../vendor/autoload.php';
//include '../manual-init.php';

//Load some useful functions
include 'inc/config.php';

//Build the mutli form
$multiform = (new Ground\Core\Form('myform'))
->setAction(getPageUrl())
->setMethod('POST')
->setOption('title', 'My Multi Form')
->addField(
    (new Ground\Core\Fields\TextBox('mytext0'))
    ->setOption('title', 'Name')
    ->setValue('Test 0')
)
->addField(
    (new Ground\Core\Fields\Multi('mymulti'))
    ->setOption('title', 'Multi')
    ->addField(
        (new Ground\Core\Fields\Section('mysection'))
        ->addField(
            (new Ground\Core\Fields\TextBox('mytext1'))
            ->setOption('title', 'Name')
            ->setValue('')
            ->addRule('required', null, 'Please fill this out')
            ->addRule('max-char', 30)
        )
        ->addField(
            (new Ground\Core\Fields\TextBox('mytext2'))
            ->setOption('title', 'AF Name')
            ->setValue('Anthony Fisher')
        )
        ->addField(
            (new Ground\Core\Fields\Submit('submit'))
        )
    )
);

$model = new Ground\Core\Models\RawDataModel($_REQUEST);
$validator = new Ground\Core\Validator();

$validator->addRule(new Ground\Core\Rules\Required());
$validator->addRule(new Ground\Core\Rules\MaxChar());

$model->loadField($multiform);

$validator->validateField($multiform);

if ($validator->hasErrors()) {
    echo '<h4 style="color: red;">ERRORS</h4>';
}

$writer = new Ground\Core\Writers\ErrorWriter();
$writer = new Ground\Core\Writers\TitleDescriptionWriter($writer);
$writer = new Ground\Core\Writers\WrapperWriter($writer);

echo $multiform->getMarkup($writer);
