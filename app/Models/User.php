<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

use App\Models\EntryBranch;
use App\Models\EntryBranchUser;

use App\Traits\UUID;
use App\Traits\Status;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use Laravel\Scout\Searchable;


class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;

    use Notifiable;
    use TwoFactorAuthenticatable;

    use UUID;
    use Status;
    use HasRoles;

    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Determine if the user has verified their email address and superadmin role.
     *
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        setPermissionsTeamId($this->current_team_id);//这一句务必加
        return $this->hasRole('SuperAdmin') && $this->hasVerifiedEmail();
    }

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            // Add other fields you want to index here
        ];
    }

    public function emailVerifications()
    {
        return $this->hasMany(EmailVerification::class);
    }

    /**
     * 返回收藏夹
     * 
     */
    public function favorites() {
        return $this->belongsToMany(Favorite::class, 'user_favorites', 'user_id', 'favorite_id');
    }
    /**
     * 返回用户持有的分支EntryBranch
     * 
     * 修改:拥有多个
     */
    public function branches() {
        return $this->belongsToMany(EntryBranch::class, 'entry_branch_users', 'user_id', 'entry_branch_id')
                    ->where('role', 1);
    }

    /**
     * 用户持有的EntryVersion
     * 拥有多个
     */
    public function versions() {
        return $this->hasMany(EntryVersion::class, 'author_id');
    }

    /**
     * 用户持有的EntryVersionTask
     * 拥有多个
     */
    public function versiontasks() {
        return $this->hasMany(EntryVersionTask::class, 'author_id');
    }

    /**
     * 用户发表的Topic
     * 拥有多个
     */
    public function topics() {
        return $this->hasMany(Topic::class, 'user_id');
    }

    /**
     * 用户发表的Comments
     * 拥有多个
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * 用户拥有的Medias
     * 拥有多个
     */
    public function medias() {
        return $this->hasMany(Media::class, 'user_id');
    }

    /**
     * 用户拥有的Albums
     * 拥有多个
     */
    public function albums() {
        return $this->hasMany(Album::class, 'user_id');
    }
}
