<?php

namespace App\FormDTO;

class ObjectMappingDTO
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string|null
     */
    public $columnName;

    /**
     * ObjectMappingDTO constructor.
     *
     * @param string      $title
     * @param string|null $columnName
     */
    public function __construct(string $title, string $columnName = null)
    {
        $this->title = $title;
        $this->columnName = $columnName;
    }
}
