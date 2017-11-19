<?php

namespace App\Http\Controllers;

use App\Change;
use App\Notifications\ChangeAccepted;
use App\Notifications\ChangeOffered;
use App\Notifications\ChangeRejected;
use App\Transformers\ChangeTransformer;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function notifications() {
        return request()->user()->notifications;
    }

    public function openChanges() {
        $data = User::canChangeWith(request()->user())->get();

        return fractal($data, new UserTransformer())->respond();
    }

    public function createChange() {
        $source = request()->user();
        /** @var \App\User Target user */
        $target = User::find(request()->input('target_id'));
        if ($target === null) {
            return response()->json([
                'error' => [
                    'code' => 'ERR_CH_USER_NOTFOUND',
                    'message' => 'The other user you asked for does not exist.'
                ]
            ], 404);
        }

        if (!$target->checkCanChangeWith($source)) {
            return response()->json([
                'error' => [
                    'code' => 'ERR_CH_CHANGE_INVALID',
                    'message' => 'Change invalid. (Probably either you or the other person has already accepted a change, or you\'ve already offered a change to this person..)'
                ]
            ], 422);
        }

        $change = Change::create([
           'source_id' => $source->id,
           'target_id' => $target->id,
           'state' => 'pending'
        ]);

        $target->notify(new ChangeOffered($change));

        return fractal($change, new ChangeTransformer())->parseIncludes('source,target')->respond();
    }

    public function acceptChange($id) {
        $change = Change::find($id);
        if ($change === null) {
            return response()->json([
                'error' => [
                    'code' => 'ERR_CH_NOTFOUND',
                    'message' => 'The change you asked for does not exist.'
                ]
            ], 404);
        }
        if (Auth::id() !== $change->target->id) {
            return response()->json([
                'error' => [
                    'code' => 'ERR_CH_UNAUTHORISED',
                    'message' => 'You cannot do that.'
                ]
            ], 403);
        }

        $change->state = 'accepted';
        $change->save();

        $change->source->notify(new ChangeAccepted($change));

        $change->source->notifications()
            ->where([['data->data->id', $change->id], ['type' => 'App\Notifications\ChangeOffered']])
            ->update(['invalid' => true]);

        return fractal($change, new ChangeTransformer())->parseIncludes('source,target')->respond();
    }

    public function rejectChange($id) {
        $change = Change::find($id);
        if ($change === null) {
            return response()->json([
                'error' => [
                    'code' => 'ERR_CH_NOTFOUND',
                    'message' => 'The change you asked for does not exist.'
                ]
            ], 404);
        }
        if (Auth::id() !== $change->target->id) {
            return response()->json([
                'error' => [
                    'code' => 'ERR_CH_UNAUTHORISED',
                    'message' => 'You cannot do that.'
                ]
            ], 403);
        }

        $change->state = 'rejected';
        $change->save();

        $change->source->notify(new ChangeRejected($change));

        $change->source->notifications()
            ->where([['data->data->id', $change->id], ['type' => 'App\Notifications\ChangeOffered']])
            ->update(['invalid' => true]);

        return fractal($change, new ChangeTransformer())->parseIncludes('source,target')->respond();
    }
}
