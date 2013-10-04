<?php
return array(
    'type' => 'form',
    'id' => 'gen-form',
    'method' => 'POST',
    'action' => 'generator.php',
    'title' => 'My Generated Form',
    'fields' => array(
        array(
            'type' => 'text',
            'id' => 'my-first-text',
            'title' => 'Name',
            'placeholder' => 'Name',
            'rules' => array(
                array('required', '', 'Please fill out this field'),
                array('max-char', 20, 'No More than 20 characters')
            )
        ),
        array(
            'type' => 'Ground\\Core\\Fields\\Submit',
            'id' => 'submit',
            'value' => 'Submit'
        )
    )
);
