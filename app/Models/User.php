<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
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
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function created_regions()
    {
        return $this->morphMany(Region::class, 'creatable');
    }
    public function created_townships()
    {
        return $this->morphMany(Township::class, 'creatable');
    }
    public function created_departments()
    {
        return $this->morphMany(Department::class, 'creatable');
    }
    public function created_payment_methods()
    {
        return $this->morphMany(PaymentMethod::class, 'creatable');
    }
    public function created_payment_types()
    {
        return $this->morphMany(PaymentType::class, 'creatable');
    }
    public function created_cities()
    {
        return $this->morphMany(City::class, 'creatable');
    }
    public function created_branches()
    {
        return $this->morphMany(Branch::class, 'creatable');
    }
    public function created_owners()
    {
        return $this->morphMany(Owner::class, 'creatable');
    }
    public function created_shops()
    {
        return $this->morphMany(Shop::class, 'creatable');
    }
    public function created_providers()
    {
        return $this->morphMany(Provider::class, 'creatable');
    }
    public function created_products()
    {
        return $this->morphMany(Product::class, 'creatable');
    }
    public function created_provider_branches()
    {
        return $this->morphMany(ProviderBranche::class, 'creatable');
    }
    public function created_shop_staffs()
    {
        return $this->morphMany(ShopStaff::class, 'creatable');
    }
}
