<?php
namespace Ground\Core\Interfaces;

/**
 * Defines an interface for a ground writer
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
interface WriterInterface
{
    public function __construct(WriterInterface $writer = null);
    public function beforeField(FieldInterface $field);
    public function afterField(FieldInterface $field);
    public function beforeChildren(FieldInterface $field);
    public function afterChildren(FieldInterface $field);
}
