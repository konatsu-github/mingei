<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Video;
use App\Models\Usermeta;

class VideoList extends Component
{
    public $videosItems = [];
    public $searchResultsCount = 0;
    public $perPage = 12;
    public $page = 1;

    public $loadMoreButtonVisible = false;

    public string $s = ''; // URLのクエリ名
    protected $queryString = ['s' => ['except' => '']];

    public function loadMore()
    {

        if ($this->s) {
            // 検索キーワード
            $searchQuery = $this->s;

            // ユーザーニックネーム、ピンネーム、コンビネームのカラムを検索
            $userIdsFromUsermetas = Usermeta::where('nickname', 'LIKE', "%$searchQuery%")
                ->orWhere('pinname', 'LIKE', "%$searchQuery%")
                ->orWhere('combiname', 'LIKE', "%$searchQuery%")
                ->pluck('user_id');

            // タイトル、説明のカラムを検索
            $videoIdsFromVideos = Video::where('title', 'LIKE', "%$searchQuery%")
                ->orWhere('description', 'LIKE', "%$searchQuery%")
                ->pluck('id');

            // user_idを指定して動画データを取得
            $videos = Video::whereIn('user_id', $userIdsFromUsermetas)
                ->orWhereIn('id', $videoIdsFromVideos)
                ->orderBy('created_at', 'desc')
                ->skip(($this->page - 1) * $this->perPage)
                ->take($this->perPage)
                ->get();

            // 検索結果数を取得
            $this->searchResultsCount = count($videos);
        } else {
            // クエリパラメータ "s" が存在しない場合は通常の処理
            $videos = Video::orderBy('created_at', 'desc')
                ->skip(($this->page - 1) * $this->perPage)
                ->take($this->perPage)
                ->get();
        }


        // 連想配列にサムネイルのURLを追加する
        foreach ($videos as $video) {
            $usermeta = Usermeta::where('user_id', $video->user_id)->first();
            $avatarUrl = GetS3TemporaryUrl($usermeta->avatar);
            $thumbnailUrl = GetS3TemporaryUrl($video->image_file_path);
            $this->videosItems[] = [
                'videoId' => $video->id,
                'title' => $video->title,
                'description' => $video->description,
                'createdAt' => $video->created_at->format('Y/m/d'),
                'viewCount' => $video->view_count,
                'videoUserId' => $video->user_id,
                'usermeta' => $usermeta,
                'avatarUrl' => $avatarUrl,
                'thumbnailUrl' => $thumbnailUrl,
                'pinname' => $usermeta->pinname ?: $usermeta->nickname,
                'combiname' => $usermeta->combiname,
            ];
        }

        // $videos が空である場合、すべてのアイテムを表示しました
        if ($videos->isEmpty()) {
            $this->loadMoreButtonVisible = true;
        }

        $this->page++;

        // 表示件数をセッションに保存
        session(['currentPage' => $this->page]);
    }

    public function mount()
    {
        if (!is_null(session('currentPage'))) {
            for ($i = session('currentPage'); $i > 1; $i--) {
                $this->loadMore();
            }
        } else {
            $this->loadMore();
        }
    }


    public function render()
    {
        return view('livewire.video-list');
    }
}
