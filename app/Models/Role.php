<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function employeeRoleOrganizations()
    {
        return $this->hasMany(EmployeeRoleOrganization::class, 'role_id');
    }

}
