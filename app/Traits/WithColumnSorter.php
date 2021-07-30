<?php

namespace App\Traits;

trait WithColumnSorter
{
    public $sort = [
        'column' => '',
        'direction' => '',
    ];

    public function sortBy($column)
    {
        $sortDirections = [
            '' => 'asc',
            'asc' => 'desc',
            'desc' => '',
        ];

        if ($this->sort['column'] == $column) {
            $this->sort['direction'] = $sortDirections[$this->sort['direction']];
        } else {
            $this->sort['column'] = $column;
            $this->sort['direction'] = 'asc';
        }
    }

    public function resetSort()
    {
        $this->sort = [
            'column' => '',
            'direction' => '',
        ];
    }
}
