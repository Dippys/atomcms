<?php

namespace App\Rules;

use App\Models\WebsiteWordfilter;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Str;

class WebsiteWordfilterRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        $words = WebsiteWordfilter::where('word', 'nigga')
            ->get()
            ->pluck('word')
            ->toArray();

        if (in_array(strtolower($value), $words) || Str::contains(strtolower($value), $words)) {
            $fail(__('The entered username is not allowed on :hotel', ['hotel' => setting('hotel_name')]));
        }
    }
}