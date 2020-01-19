<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\SmsNumberRepositoryInterface;
use App\Http\Requests\StoreSmsNumberRequest;
use App\Models\SmsNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SmsNumbersController extends Controller
{
    /**
     * @var SmsNumberRepositoryInterface
     */
    private $numberRepository;

    public function __construct(SmsNumberRepositoryInterface $numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function index(string $operator = 'cashbill')
    {
        if (!array_key_exists($operator, config('mcshop.sms_operators'))) {
            throw new BadRequestHttpException();
        }

        $numbers = $this->numberRepository->paginateWhereOperatorIs($operator);

        return View::make('admin.settings.numbers.index')->with(['numbers' => $numbers, 'activeOperator' => $operator]);
    }
    
    public function create()
    {
        return View::make('admin.settings.numbers.create');
    }
    
    public function store(StoreSmsNumberRequest $request)
    {
        $data = [
            'operator' => $request->get('numberOperator'),
            'number' => $request->get('numberNumber'),
            'netto_cost' => $request->get('numberNetto') * 100,
        ];
        
        $number = $this->numberRepository->new($data);
    
        return Redirect::route('admin.settings.numbers.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie dodano nowy numer ' .
                '<span class="font-weight-bold">' . $number->getNumber() .
                ' (ID: #' . $number->getId() . ')</span> ' .
                'dla operatora <span class="font-weight-bold">' . config('mcshop.sms_operators')[$number->getOperator()] . '</span>!']);
    }
    
    public function delete(SmsNumber $number)
    {
        $this->numberRepository->delete($number->getId());
    
        return Redirect::route('admin.settings.numbers.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie usunięto numer ' .
                '<span class="font-weight-bold">' . $number->getNumber() .
                ' (ID: #' . $number->getId() . ')</span> ' .
                'obsługiwany przez operatora <span class="font-weight-bold">' .
                config('mcshop.sms_operators')[$number->getOperator()] .
                '</span>!']);
    }
}
