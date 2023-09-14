<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Video; // Videoモデルを使用するためにインポート
use Illuminate\Support\Facades\Auth; // Authファサードを使用するためにインポート
use Illuminate\Support\Facades\Storage;
use App\Models\Usermeta;

class Upload extends Component
{

    use WithFileUploads;

    public $title;
    public $description;
    public $thumbnail;
    public $video;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.upload');
    }

    public function save() {

    }
}
