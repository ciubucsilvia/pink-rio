<?php

namespace Corp\Policies;

use Corp\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function save(User $user) {
        return $user->CanDo('ADD_ARTICLES');
    }

    public function edit(User $user) {
        return $user->CanDo('UPDATE_ARTICLES');
    }

    public function destroy(User $user, Article $article) {
        return ( ($user->id == $article->user_id) 
                && ($user_canDo('DELETE_ARTICLES')) );
    }
}
