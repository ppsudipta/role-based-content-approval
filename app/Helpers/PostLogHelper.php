<?php

namespace App\Helpers;

use App\Models\PostLog;

class PostLogHelper
{
    public static function log($postId, $action, $userId, $meta = [])
    {
        PostLog::create([
            'post_id' => $postId,
            'action' => $action,
            'performed_by' => $userId,
            'meta' => $meta,
        ]);
    }
}