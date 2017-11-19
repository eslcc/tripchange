<?php

namespace App;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Query;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'has', 'wants'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function changeSources()
    {
        return $this->hasMany('App\Change', 'source_id');
    }

    public function changeTargets()
    {
        return $this->hasMany('App\Change', 'target_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (User $model) {
            $model->generateApiToken();
        });
    }

    public function scopeCanChangeWith(EloquentBuilder $builder, User $user)
    {
        return $builder->where('id', '!=', $user->id)
            ->where('wants', 'LIKE', DB::raw('\'%' . $user->has . '%\''))
            ->whereRaw('\'' . $user->wants . '\'' . ' LIKE CONCAT(\'%\', has, \'%\')')
            ->whereNotExists(function (QueryBuilder $q) use ($user) {
                $q->select(DB::raw(1))
                    ->from('changes')
                    ->where(function (QueryBuilder $q) use ($user) {
                        $q->where('source_id', $user->id)
                            ->orWhere('target_id', $user->id);
                    })
                    ->where('state', '==', '\'accepted\'');
            });
    }

    private function generateApiToken()
    {
        $this->attributes['api_token'] = generateRandomString(60);

        if (is_null($this->attributes['api_token']))
            return false;
        else
            return true;
    }

    public function checkCanChangeWith(User $other) {
        if ($other->id === $this->id) {
            return false;
        }
        if (!User::checkChanges($this)) {
            return false;
        }
        if (!User::checkChanges($other)) {
            return false;
        }
        if ($this->changeSources()->where('target_id', $other->id)->exists()) {
            return false;
        }
        if ($this->changeTargets()->where('source_id', $other->id)->exists()) {
            return false;
        }
        if ($other->changeSources()->where('target_id', $this->id)->exists()) {
            return false;
        }
        if ($other->changeTargets()->where('source_id', $this->id)->exists()) {
            return false;
        }
        return true;
    }

    private static function checkChanges(User $user) {
        if ($user->changeSources()->where('state', '==', 'accepted')->exists()) {
            return false;
        }
        if ($user->changeTargets()->where('state', '==', 'accepted')->exists()) {
            return false;
        }
        return true;
    }
}
