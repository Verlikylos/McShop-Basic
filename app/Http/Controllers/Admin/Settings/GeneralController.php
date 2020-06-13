<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Requests\UpdateGeneralSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class GeneralController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
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
    
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => Lang::get('admin.settings.logs.general')
        ]);
    
        return Redirect::route('admin.settings.general.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => Lang::get('admin.settings.saved')
            ]);
    }
}
