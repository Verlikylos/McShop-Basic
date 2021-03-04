<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Repositories\PageRepositoryInterface;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PagesController extends Controller
{
    private $pageRepository;
    private $logRepository;
    
    public function __construct(PageRepositoryInterface $pageRepository, LogRepositoryInterface $logRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        $pages = $this->pageRepository->paginate();
        
        return View::make('admin.pages.index')->with(['pages' => $pages]);
    }
    
    public function create()
    {
        return View::make('admin.pages.create');
    }
    
    public function store(StorePageRequest $request)
    {
        $data = [
            'name' => $request->get('pageName'),
            'icon' => $request->get('pageIcon'),
            'type' => $request->get('pageType'),
            'content' => $request->get('pageType') == 'PAGE' ? $request->get('pageContent') : $request->get('pageLink'),
            'active' => false,
            'sort_id' => $this->pageRepository->getLastSortIndex()
        ];
        
        $page = $this->pageRepository->new($data);
    
        $this->logRepository->new([
            'category' => 'PAGES',
            'color' => 'success',
            'details' => Lang::get('admin.pages.logs.created', [
                'page' => $page->getName(),
                'page_id' => $page->getId(),
            ])
        ]);
    
        return Redirect::route('admin.pages.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.pages.created', [
                    'page' => $page->getName(),
                    'page_id' => $page->getId(),
                ])
            ]);
    }
    
    public function toggle_active(Page $page) {
        $this->pageRepository->update($page, ['active' => !$page->isActive()]);
        
        if ($page->isActive()) {
            $this->logRepository->new([
                'category' => 'PAGES',
                'color' => 'primary',
                'details' => Lang::get('admin.pages.logs.status.disabled', [
                    'page' => $page->getName(),
                    'page_id' => $page->getId(),
                ])
            ]);
            
            return Redirect::back()
                ->with('sessionMessage', [
                    'type' => 'success',
                    'content' => Lang::get('admin.pages.status.disabled', [
                        'page' => $page->getName(),
                        'page_id' => $page->getId(),
                    ])
                ]);
        }
    
        $this->logRepository->new([
            'category' => 'PAGES',
            'color' => 'primary',
            'details' => Lang::get('admin.pages.logs.status.enabled', [
                'page' => $page->getName(),
                'page_id' => $page->getId(),
            ])
        ]);
        
        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.pages.status.enabled', [
                    'page' => $page->getName(),
                    'page_id' => $page->getId(),
                ])
            ]);
    }
    
    public function swap(Page $page, bool $up)
    {
        $secondPage = null;
        
        if ($up) {
            $secondPage = $this->pageRepository->getWithLowerSortIdThan($page);
        } else {
            $secondPage = $this->pageRepository->getWithHigherSortIdThan($page);
        }
        
        if ($secondPage == null) {
            throw new BadRequestHttpException();
        }
        
        $firstPageData = [
            'sort_id' => $secondPage->getSortId()
        ];
        
        $secondPageData = [
            'sort_id' => $page->getSortId()
        ];
        
        $this->pageRepository->update($page, $firstPageData);
        $this->pageRepository->update($secondPage, $secondPageData);
    
        $this->logRepository->new([
            'category' => 'PAGES',
            'color' => 'primary',
            'details' => Lang::get('admin.pages.logs.order.updated', [
                'page' => $page->getName(),
                'page_id' => $page->getId(),
            ])
        ]);
        
        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.pages.order.updated', [
                    'page' => $page->getName(),
                    'page_id' => $page->getId(),
                ])
            ]);
    }
    
    public function edit(Page $page)
    {
        return View::make('admin.pages.edit')->with(['page' => $page]);
    }
    
    public function update(UpdatePageRequest $request, Page $page)
    {
        $data = [
            'name' => $request->get('pageName'),
            'icon' => $request->get('pageIcon'),
            'type' => $request->get('pageType'),
            'content' => $request->get('pageType') == 'PAGE' ? $request->get('pageContent') : $request->get('pageLink'),
        ];
        
        $this->pageRepository->update($page, $data);
    
        $this->logRepository->new([
            'category' => 'PAGES',
            'color' => 'info',
            'details' => Lang::get('admin.pages.logs.updated', [
                'page' => $page->getName(),
                'page_id' => $page->getId(),
            ])
        ]);
    
        return Redirect::route('admin.pages.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.pages.updated', [
                    'page' => $page->getName(),
                    'page_id' => $page->getId(),
                ])
            ]);
    }
    
    // TODO make delete request of all entities with HTTP DELETE method instead of GET
    public function delete(Page $page)
    {
        $this->pageRepository->delete($page);
    
        $this->logRepository->new([
            'category' => 'PAGES',
            'color' => 'danger',
            'details' => Lang::get('admin.pages.logs.deleted', [
                'page' => $page->getName(),
                'page_id' => $page->getId(),
            ])
        ]);
    
        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.pages.deleted', [
                    'page' => $page->getName(),
                    'page_id' => $page->getId(),
                ])
            ]);
    }
}
