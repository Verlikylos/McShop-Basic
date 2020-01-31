<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGeneralSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class GeneralController extends Controller
{
    public function index()
    {
        return View::make('admin.settings.general');
    }
    
    public function update(UpdateGeneralSettingsRequest $request)
    {
        setting([
           'general_page_title' => $request->get('settingPageTitle'),
           'general_page_description' => $request->get('settingPageDescription'),
           'general_page_tags' => $request->get('settingPageTags'),
           'general_page_favicon' => $request->get('settingFavicon'),
           'general_page_logo' => $request->get('settingPageLogo'),
           'general_page_background' => $request->get('settingPageBackground')
        ])->save();
        
        return Redirect::route('admin.settings.general.index')->with('sessionMessage', ['type' => 'success', 'content' => 'Ustawienia zostały pomyślnie zapisane!']);
    }
}
