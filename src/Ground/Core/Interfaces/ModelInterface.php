<?php
namespace Ground\Core\Interfaces;

/**
 * Defines an interface for a ground model
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
interface ModelInterface
{
    public function loadField(FieldInterface $field);
    public function saveField(FieldInterface $field);
}
