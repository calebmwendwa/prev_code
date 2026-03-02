<?php

namespace Modules\Superadmin\Entities;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    protected $table = 'superadmin_package_categories';
    protected $guarded = ['id'];


    public function packages(){
        return $this->hasMany(Package::class, 'package_category_id');
    }

    public static function forDropDown(){
        $package_category = PackageCategory::select('name', 'id')->orderBy('priority', 'asc')
        ->get();

        $dropdown =  $package_category->pluck('name', 'id');

        return $dropdown;

    }


}
