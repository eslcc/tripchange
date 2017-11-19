<?php
/**
 * Created by PhpStorm.
 * User: Marks
 * Date: 2017-11-19
 * Time: 12:16
 */

namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform (User $user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'has' => $user->has,
            'wants' => explode(';', $user->wants)
        ];
    }
}