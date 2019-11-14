<?php

namespace App\Aweloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AweloquentModel extends Model
{
    protected static $rules    = [];
    protected static $messages = [];

    public $errors;

    public function __construct(array $attributes = [])
    {
        $attributes = $this->autoHydrate($attributes);
        parent::__construct($attributes);
    }

    public function validate()
    {
        static::$rules = $this->mergeValidationRules();
        $validator     = \Validator::make($this->attributes, static::$rules, static::$messages);
        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    private function mergeValidationRules()
    {
        if ($this->exists)
            $mergedRules =
                array_merge_recursive(static::$rules['everytime'],
                    static::$rules
                    ['update']);
        else
            $mergedRules =
                array_merge_recursive(static::$rules['everytime'],
                    static::$rules
                    ['create']);
        $finalRules = [];
        foreach ($mergedRules as $field => $rules) {
            if (is_array($rules))
                $finalRules[$field] = implode("|", $rules);
            else
                $finalRules[$field] = $rules;
        }
        return $finalRules;
    }

    private function autoHydrate(array $attributes)
    {
        $request     = app(Request::class);
        $requestData = $request->except('_token');
        foreach ($requestData as $name => $value) {
            if (!isset($attributes[$name]))
                $attributes[$name] = $value;
        }
        return $attributes;
    }
}
