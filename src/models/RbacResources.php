<?php namespace Andytt\LaravelRbac;

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletingTrait as SoftDeletingTrait;
use \Illuminate\Support\Facades\Validator as Validator;
use \Andytt\Uuid\Uuid as Uuid;

class RbacResources extends Eloquent
{

    use SoftDeletingTrait;

    protected $table = 'rbac_resources';

    protected $fillable = [

        'resource_id',
        'resource_name',
        'resource_action'

    ];

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    protected $errors;

    protected $rules = [

        'resource_id'     => 'required|size:36',
        'resource_name'   => 'required|max:100',
        'resource_action' => 'required|max:100'

    ];

    public static function boot()
    {

        parent::boot();

        // Events
        self::saving(function ($resources) {

            if (!$resources->isValid()) { return false; }

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

        $attributes['resource_id'] = (new Uuid)->get(4)->toString();

        return parent::create($attributes);

    }

}
