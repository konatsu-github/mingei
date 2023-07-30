<?php
use Illuminate\Support\Facades\Storage;

function GetS3TemporaryUrl($filePath)
{
    // S3のファイルに期限付きURLを取得する
    $expires = now()->addMinutes(env('AWS_S3_TMP_TIME'));

    $temporaryUrl = Storage::disk('s3')->temporaryUrl($filePath, $expires);

    return $temporaryUrl;
}
