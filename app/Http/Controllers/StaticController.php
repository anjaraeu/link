<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use GrahamCampbell\Markdown\Facades\Markdown;

class StaticController extends Controller
{

    public function legal() {
        if (Storage::exists('md/legal.'.App::getLocale().'.md')) {
            return view('static.legal', ['md' => Markdown::convertToHtml(Storage::get('md/legal.'.App::getLocale().'.md'))]);
        } elseif (Storage::exists('md/legal.md')) {
            return view('static.legal', ['md' => Markdown::convertToHtml(Storage::get('md/legal.md'))]);
        } else {
            return view('static.legal', ['md' => '']);
        }
    }

}
