<?php namespace Andytt\LaravelRbac;

class RBAC
{

    protected $resources;
    protected $roles;
    protected $permissions;

    public function __construct(RbacResources $resources, RbacRoles $roles, RbacPermissions $permissions)
    {

        $this->resources   = $resources;
        $this->roles       = $roles;
        $this->permissions = $permissions;

    }

    public function resources()
    {

        return $this->resources;

    }

    public function roles()
    {

        return $this->roles;

    }

    public function permissions()
    {

        return $this->permissions;

    }

    public function can($roleId, $resourceName, $resourceAction)
    {

        $query = $this->permissions->query();

        $query->where('role_id', $roleId);

        $query->whereHas('resources', function ($q) use ($resourceName, $resourceAction) {

            $q->where('resource_name', $resourceName)
              ->where('resource_action', $resourceAction);

        });

        return !empty($query->first());

    }

}
