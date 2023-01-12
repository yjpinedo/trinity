<?php

namespace App\Traits;

trait WithOrderTrait
{
    public $sortColumn = 'id';
    public $sortDirection = 'desc';

    public function sortBy($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'desc';
        }
    }
}
