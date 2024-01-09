<?php

namespace App\Traits;

use App\Models\Crm\PublisherResourceUser;
use App\Models\User;

trait AuthorTrait
{

    protected function checkAuthor($user_id){

    $publisher_resources = PublisherResourceUser::where('user_id', $user_id)->first();

        if ($publisher_resources){
            $user_is_author = User::where('id', intval(auth()->id()))->first();
            $user_is_author->update([
                'is_author'=>1
            ]);
        }else{
            $user_is_author = User::where('id', intval(auth()->id()))->first();
            $user_is_author->update([
                'is_author'=>0
            ]);
        }
    }
}
