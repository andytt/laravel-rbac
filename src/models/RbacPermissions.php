<?php namespace Andytt\LaravelRbac;

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Support\Facades\Validator as Validator;
use \Andytt\Uuid\Uuid as Uuid;

class RbacPermissions extends Eloquent
{

    protected $table = 'rbac_permissions';

    protected $fillable = [

        'role_id',
        'resource_id'

    ];

    protected $softDelete = true;

    protected $errors;

    protected $rules = [

        'role_id'     => 'required|size:36',
        'resource_id' => 'required|size:36'

    ];

    public function resources()
    {
        // new RbacResources();
        return $this->hasMany('\Andytt\LaravelRbac\RbacResources', 'resource_id', 'resource_id');

    }

    public static function boot()
    {

        parent::boot();

        // Events
        self::saving(function ($model) {

            if (!$model->isValid()) { return false; }

        });

    }

    public function isValid()
    {

        $v = Validator::make($this->toArray(), $this->rules);

        if ($v->fails()) { $this->errors = $v->errors(); }

        return $v->passes();

    }

    public function errors()
    {

        return $this->errors;

    }

    public static function create(array $attributes)
    {

        return parent::create($attributes);

    }

}
