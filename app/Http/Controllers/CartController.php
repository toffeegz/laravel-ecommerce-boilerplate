<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Services\Checkout\CheckoutServiceInterface;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Services\Utils\Response\ResponseServiceInterface;

class CartController extends Controller
{
    private $checkoutService;
    private $responseService;
    private $name = 'Cart';
    
    public function __construct(
        CheckoutServiceInterface $checkoutService, 
        CartRepositoryInterface $modelRepository, 
        ResponseServiceInterface $responseService,
    ) {
        $this->checkoutService = $checkoutService;
        $this->modelRepository = $modelRepository;
        $this->responseService = $responseService;
    }

    public function index()
    {
        $results = $this->modelRepository->index(request(['search']), ['user']);
        return $this->responseService->successResponse($this->name, $results);
    }

    public function checkout(Request $request)
    {
        $results = $this->checkoutService->checkout($request->all());
        return $this->responseService->successResponse($this->name, $results);
    }
}
