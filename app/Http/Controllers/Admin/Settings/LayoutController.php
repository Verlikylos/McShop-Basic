<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLayoutSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class LayoutController extends Controller
{
    public function index()
    {
        return View::make('admin.settings.layout');
    }
    
    public function update(UpdateLayoutSettingsRequest $request)
    {
        setting([
            'layout_theme' => $request->get('layoutTheme')
        ])->save();
    
        return Redirect::route('admin.settings.layout.index')->with('sessionMessage', ['type' => 'success', 'content' => 'Ustawienia zostały pomyślnie zapisane!']);
    }
}
