<?php

namespace App\Livewire\Announcement;

use App\Models\Announcement;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AnnouncementList extends Component
{
    use WithPagination;

    #[Url()]
    public $query = '';

    public $limit = 10;

    public function updated($property): void
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $announcements = Announcement::query()
                            ->when($this->query, function($query) {
                                $query->where('title', 'like', '%'.$this->query.'%');
                            })
                            ->latest()
                            ->paginate($this->limit);
        return view('livewire.announcement.announcement-list', compact('announcements'));
    }
}
