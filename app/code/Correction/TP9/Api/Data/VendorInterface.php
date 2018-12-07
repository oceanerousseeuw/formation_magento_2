<?php

namespace Correction\TP9\Api\Data;

/**
 * Vendor DTO
 */
interface VendorInterface
{
    const ID = 'id';
    const NAME = 'name';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);
}