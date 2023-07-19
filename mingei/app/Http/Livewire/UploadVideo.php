<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadVideo extends Component
{
    use WithFileUploads;

    public $video;
    public $loading = false;

    public function upload()
    {
        $this->loading = true;
    
        $path = $this->video->store('videos', 's3');
    
        if ($path) {
            $this->dispatchBrowserEvent('resetFileInput');
            session()->flash('message', 'ファイルがアップロードされました。');
        } else {
            session()->flash('message', 'ファイルのアップロードに失敗しました。');
        }
    
        $this->loading = false;
    }

    public function save()
    {
        $this->loading = true;
    
        $path = $this->video->store('videos', 's3');
    
        if ($path) {
            $this->dispatchBrowserEvent('resetFileInput');
            session()->flash('message', 'ファイルがアップロードされました。');
        } else {
            session()->flash('message', 'ファイルのアップロードに失敗しました。');
        }
    
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.upload-video');
    }
}
