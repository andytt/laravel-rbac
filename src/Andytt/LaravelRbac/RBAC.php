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

    public function enable($roleName, $resourceName, $resourceAction)
    {

        $roles = $this->roles->query();
        $role  = $roles->where('role_name', $roleName)->first();

        if (empty($role)) {

            $role = $this->roles->create([

                'role_name' => $roleName

            ]);

        }

        $resources = $this->resources->query();
        $resources->where('resource_name', $resourceName);
        $resources->where('resource_action', $resourceAction);

        $resource = $resources->first();

        if (empty($resource)) {

            $resource = $this->resources->create([

                'resource_name'   => $resourceName,
                'resource_action' => $resourceAction

            ]);

        }

        return !empty($this->permissions->create([

            'role_id'     => $role->role_id,
            'resource_id' => $resource->resource_id

        ]));

    }

    public function getRoleByRoleName($roleName)
    {

        $roles = $this->roles->query();
        $roles->where('role_name', $roleName);

        return $roles->first();

    }

}
