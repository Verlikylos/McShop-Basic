<?php


namespace App\Http\Repositories\SQL;


use App\Http\Repositories\PageRepositoryInterface;
use App\Models\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageRepository implements PageRepositoryInterface
{
    private $table = 'pages';
    
    public function getActive(): Collection
    {
        return Page::where('active', 1)->get();
    }
    
    public function paginate(): LengthAwarePaginator
    {
        return Page::orderBy('sort_id')->paginate(10);
    }
    
    public function getLastSortIndex(): int
    {
        try {
            return Page::orderBy('sort_id', 'desc')->firstOrFail()->getSortId();
        } catch (ModelNotFoundException $e) {
            return 0;
        }
    }
    
    public function getWithLowerSortIdThan(Page $page): ?Page
    {
        return Page::orderBy('sort_id', 'desc')->where('sort_id', '<', $page->getSortId())->first();
    }
    
    public function getWithHigherSortIdThan(Page $page): ?Page
    {
        return Page::orderBy('sort_id')->where('sort_id', '>', $page->getSortId())->first();
    }
    
    public function new(array $data): Page
    {
        $page = new Page($data);
        $page->slug = Str::slug($data['name']);
        
        $page->save();
        
        return $page;
    }
    
    public function update(Page $page, array $data): int
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }
    
        return DB::table($this->table)->where('id', $page->getId())->update($data);
    }
    
    public function delete(Page $page): int
    {
        return DB::table($this->table)->where('id', $page->getId())->delete();
    }
    
}
