<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadVideo extends Component
{
    use WithFileUploads;

    public $video;

    
    public function save()
    {
        $path = $this->video->store('videos', 's3');

        // ファイルの保存に成功した場合は、メッセージを表示します
        if ($path) {
            session()->flash('message', 'ファイルがアップロードされました。');
        } else {
            session()->flash('message', 'ファイルのアップロードに失敗しました。');
        }
    }

    public function render()
    {
        return view('livewire.upload-video');
    }
}
