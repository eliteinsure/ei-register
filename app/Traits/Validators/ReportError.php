<?php

namespace App\Traits\Validators;

trait ReportError
{
    public function reportErrors($validator)
    {
        $errors = collect($validator->messages())->transform(function ($item) {
            return $item[0];
        })->values()->all();

        return view('pdf.error', compact('errors'));
    }
}
