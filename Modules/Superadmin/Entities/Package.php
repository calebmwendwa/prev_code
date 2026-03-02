<?php

namespace Modules\Superadmin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'custom_permissions' => 'array',
    ];

    /**
     * Scope a query to only include active packages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Returns the list of active pakages
     *
     * @return object
     */
    public static function listPackages($exlude_private = false)
    {
        $packages = Package::active()
                        ->orderby('sort_order');

        if ($exlude_private) {
            $packages->notPrivate();
        }

        return $packages->get();

    }

    public static function listPackagesByCategory($exlude_private = false){
        // Retrieve PackageCategory with filtered packages
        $categories = PackageCategory::with(['packages' => function($query) use ($exlude_private) {
            $query->active()->orderBy('sort_order');

            if ($exlude_private) {
                $query->notPrivate();
            }
        }])->orderBy('priority')->get();

        return $categories;
    }

    /**
     * Scope a query to exclude private packages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPrivate($query)
    {
        return $query->where('is_private', 0);
    }

    public function superadmin_package_categories(){
        return $this->belongsTo(PackageCategory::class, 'package_category_id');
    }
}
