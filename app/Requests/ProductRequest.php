<?php

namespace App\Requests;

class ProductRequest extends Request
{
    protected array $rules = [
        'title' => 'required',
        'brand_id' => '',
        'price' => 'required|number',
        'price_discounted' => 'number',
        'description' => 'required',
    ];
    
    public function validate(array $rules = null, string $returnValue = 'post')
    {
        if (isNotEmpty($rules))
            return $this->validateRequest($rules, $returnValue);

        return $this->validateRequest($this->rules, $returnValue);
    }
}
