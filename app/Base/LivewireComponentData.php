<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class LivewireComponentData extends Component
{
    use WithPagination;

    abstract protected function builder();

    public $model;
    public string $filterSort = '';
    public $search_query;

    protected function builderBuild(Builder &$q)
    {
        if ($this->filterSort) {
            $q->orderBy(ltrim($this->filterSort, '-'), $this->isFilterSortDesc() ? 'desc' : 'asc');
        }
    }

    public function setFilterSort($field)
    {
        if (ltrim($this->filterSort, '-') === $field) {
            $this->filterSort = $this->isFilterSortDesc() ? $field : '-' . $field;
        } else {
            $this->filterSort = '-' . $field;
        }
    }

    public function isFilterSortDesc()
    {
        return \Str::startsWith($this->filterSort, '-');
    }

    public function canHapus()
    {
        return $this->model;
    }

    public function doHapusItem($id)
    {
        session()->flash('status', 'Item berhasil dihapus.');
        $this->model::destroy($id);
        $this->redirect(url()->previous('?'), true);
    }


}
