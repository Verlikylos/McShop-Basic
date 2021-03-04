<?php


namespace App\Http\Repositories;


use App\Models\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PageRepositoryInterface
{
    public function getActive(): Collection;
    
    public function paginate(): LengthAwarePaginator;
    
    public function getLastSortIndex(): int;
    
    public function getWithLowerSortIdThan(Page $page): ?Page;
    
    public function getWithHigherSortIdThan(Page $page): ?Page;
    
    public function new(array $data): Page;
    
    public function update(Page $page, array $data): int;
    
    public function delete(Page $page): int;
}
