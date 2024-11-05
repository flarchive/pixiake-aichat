<?php

namespace Pixiake\AiChat\Access;

use Flarum\Discussion\Discussion;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class DiscussionPolicy extends AbstractPolicy
{
    public function canMarkAnswer(User $actor, Discussion $discussion)
    {
        // 管理员始终可以标记
        if ($actor->isAdmin()) {
            return true;
        }

        // 讨论作者可以标记
        if ($actor->id === $discussion->user_id) {
            return true;
        }

        // 有特定权限的用户可以标记
        if ($actor->hasPermission('discussion.moderate')) {
            return true;
        }

        return false;
    }
}
