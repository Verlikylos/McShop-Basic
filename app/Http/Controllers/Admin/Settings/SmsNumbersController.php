<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\SmsNumberRepositoryInterface;
use Illuminate\Http\Request;
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
        if (!in_array($operator, config('mcshop.sms_operators'))) {
            throw new BadRequestHttpException();
        }

        $numbers = $this->numberRepository->paginateWhereOperatorIs($operator);

        return View::make('admin.settings.numbers.index')->with(['numbers' => $numbers, 'activeOperator' => $operator]);
    }
}
