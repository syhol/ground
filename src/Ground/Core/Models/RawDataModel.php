<?php
namespace Ground\Core\Models;

use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Interfaces\ModelInterface;

/**
 * Use array of data provided at instantiation to populate field values
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class RawDataModel implements ModelInterface
{
    protected $data;

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    public function loadField(FieldInterface $field, $data = null)
    {
        $data = is_null($data) ? $this->data : $data ;

        if (isset($data[$field->getId()])) {
            $field->setValue($data[$field->getId()]);
        }

        foreach ($field as $child) {
            if (isset($data[$field->getId()][$child->getId()])) {
                $this->loadField($child, $data[$field->getId()]);
            }
        }
    }

    public function saveField(FieldInterface $field)
    {
        throw new Exception('Nothing to save data to');
    }
}
