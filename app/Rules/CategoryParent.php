<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CategoryParent implements Rule
{
    /**
     * @param string  $attribute
     * @param mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $parentCategory = Category::findOrFail($value);
        $parentCategoryPath = $parentCategory->path;
        $parentCategoryLevel = count(explode('/', $parentCategoryPath));

        if ($parentCategoryLevel > 3) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'Parent category level must be lower than 4.';
    }
}
