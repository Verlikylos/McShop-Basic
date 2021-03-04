<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PageRepositoryInterface;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;
    
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }
    
    public function index(Page $page)
    {
        if (!$page->isActive()) {
            if (Auth::user()) {
                Session::flash('shopSessionMessage', [
                    'type' => 'warning',
                    'content' => Lang::get('main.page.not_active', [
                            'link' => '<a href="' . route('admin.pages.index') . '">',
                            'endlink' => '</a>'
                        ])
                ]);
            } else {
                return abort(404);
            }
        }
        
        if ($page->getType() == 'LINK') {
            return Redirect::to($page->getContent());
        }
        
        $pages = $this->pageRepository->getActive();
        
        return View::make('page', ['page' => $page, 'pages' => $pages]);
    }
}
