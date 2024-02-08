<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

use Spatie\Permission\Traits\HasRoles;

class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * 在创建团队时添加全局管理员
     * 
     */
    public static function boot()
    {
        parent::boot();

        // here assign this team to a global user with global default role
        self::created(function ($model) {
           // temporary: get session team_id for restore at end
           $session_team_id = getPermissionsTeamId();
           // set actual new team_id to package instance
           setPermissionsTeamId($model);
           // get the admin user and assign roles/permissions on new team model
           User::find('62662626-6662-6626-2666-262662626226')->assignRole('SuperAdmin');
           // restore session team_id to package instance using temporary value stored above
           setPermissionsTeamId($session_team_id);
        });
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];
}
