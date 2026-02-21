<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\InviteStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'birthdate',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthdate' => 'date',
        ];
    }

    public function avatarPath(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? Storage::url($value) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name),
        );
    }

    public function age(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->birthdate) {
                return null;
            }

            return Carbon::parse($this->birthdate)->age;
        });
    }

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    public function mainCharacter()
    {
        return $this->hasOne(Character::class)->latestOfMany();
    }

    public function attachPendingEventRegistrations(): void
    {
        EventRegistration::query()
            ->where('email', $this->email)
            ->whereNull('user_id')
            ->update([
                'user_id' => $this->id,
                'linked_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
