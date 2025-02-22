<?php

namespace Modules\Organization\Models;

use App\Models\Admin;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// use Modules\Organization\Database\Factories\OrganizationFactory;

class Organization extends Model implements HasMedia
{
    use HasFactory, SoftDeletes,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'address',
        'contact_number',
        'status',
        'is_sms',
        'start_date',
        'end_date',
        'current_package'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::guard('admin')->check()) {
            $model->admin_id = Auth::guard('admin')->user()->id;
            $model->updated_by = Auth::guard('admin')->user()->id;
            }

            // Generate a unique slug
            $slug = Str::slug(implode('', array_map(function($word) {
                return $word[0];
            }, array_slice(explode(' ', $model->name), 0, 8))));
            $originalSlug = $slug;
            $counter = 1;

            while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
            }

            $model->slug = $slug;
        });

        static::updating(function ($model) {
            if (Auth::guard('admin')->check()) {
                $model->updated_by = Auth::guard('admin')->user()->id;
            }
        });

        static::deleting(function ($model) {
            if (Auth::guard('admin')->check()) {
                $model->deleted_by = Auth::guard('admin')->user()->id;
                $model->save();
            }
        });
    }

}
