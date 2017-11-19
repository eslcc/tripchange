<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Change
 *
 * @property int $id
 * @property int $source_id
 * @property int $target_id
 * @property string $state
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User $source
 * @property-read \App\User $target
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Change whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Change whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Change whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Change whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Change whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Change whereUpdatedAt($value)
 */
	class Change extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $graph_id
 * @property string|null $has
 * @property string|null $wants
 * @property string|null $contact_info
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $initials
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changeSources
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changeTargets
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGraphId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereHas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInitials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWants($value)
 */
	class User extends \Eloquent {}
}

