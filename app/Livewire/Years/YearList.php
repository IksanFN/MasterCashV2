<?php

namespace App\Livewire\Years;

use App\Models\Year;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class YearList extends Component
{
    use WithPagination;

    #[Url()]
    public $query = '';

    public $limit = 10;

    public function render()
    {
        $years = Year::query()
                    ->when($this->query, function($query) {
                        $query->where('title', 'like', '%'.$this->query.'%');
                    })
                    ->latest()
                    ->paginate($this->limit);
        return view('livewire.years.year-list', [
            'years' => $years,
            'query' => $this->query,
        ]);
    }
}
