<?php namespace Andytt\LaravelRbac;

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletingTrait as SoftDeletingTrait;
use \Illuminate\Support\Facades\Validator as Validator;
use \Andytt\Uuid\Uuid as Uuid;

class RbacRoles extends Eloquent
{

    use SoftDeletingTrait;

    protected $table = 'rbac_roles';

    protected $fillable = [

        'role_id',
        'role_name'

    ];

    protected $softDelete = true;

    protected $errors;

    protected $rules = [

        'role_id'     => 'required|size:36',
        'role_name'   => 'required|max:100',

    ];

    public static function boot()
    {

        parent::boot();

        // Events
        self::saving(function ($roles) {

            if (!$roles->isValid()) { return false; }

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

        $attributes['role_id'] = (new Uuid)->get(4)->toString();

        return parent::create($attributes);

    }

}
