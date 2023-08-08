<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function employeeRoleOrganizations()
    {
        return $this->hasMany(EmployeeRoleOrganization::class, 'organization_id');
    }

    public function employeeWithTeamMemberRole()
    {
        return $this->hasManyThrough(User::class, EmployeeRoleOrganization::class, 'organization_id', 'id')
            ->whereHas('employeeRoleOrganization.role', function ($query) {
                $query->where('slug', 'team-member');
            });
    }
}
