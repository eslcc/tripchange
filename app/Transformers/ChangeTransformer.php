<?php
/**
 * Created by PhpStorm.
 * User: Marks
 * Date: 2017-11-19
 * Time: 12:19
 */

namespace App\Transformers;


use App\Change;
use League\Fractal\TransformerAbstract;

class ChangeTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'source', 'target'
    ];

    public function transform (Change $change) {
        return [
            'id' => $change->id,
            'state' => $change->state
        ];
    }

    public function includeSource(Change $change) {
        return $this->item($change->source, $change->state === 'accepted' ? new UserFullTransformer() : new UserTransformer());
    }

    public function includeTarget(Change $change) {
        return $this->item($change->target, $change->state === 'accepted' ? new UserFullTransformer() : new UserTransformer());
    }
}