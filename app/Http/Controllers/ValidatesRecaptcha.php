<?php
/**
 * Created by PhpStorm.
 * User: Audi
 * Date: 14.11.2017
 * Time: 21:24
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

trait ValidatesRecaptcha
{
    protected function validateRecaptcha(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => 'recaptcha'
        ]);
    }
}