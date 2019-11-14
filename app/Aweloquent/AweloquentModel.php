<?php

namespace App\Aweloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AweloquentModel extends Model
{
    public function __construct(array $attributes = [])
    {
        $attributes = $this->autoHydrate($attributes);
        parent::__construct($attributes);
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
