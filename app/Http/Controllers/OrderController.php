<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Utils\Response\ResponseServiceInterface;

class OrderController extends Controller
{
    private $modelService;
    private $responseService;
    private $name = 'Order';
    
    public function __construct(
        OrderRepositoryInterface $modelRepository, 
        ResponseServiceInterface $responseService,
    ) {
        $this->modelRepository = $modelRepository;
        $this->responseService = $responseService;
    }

    public function index()
    {
        $results = $this->modelRepository->lists(request(['search']), ['user']);
        return $this->responseService->successResponse($this->name, $results);
    }

    public function show($id)
    {
        $result = $this->modelRepository->show($id, ['user','address','products']);
        return $this->responseService->successResponse($this->name, $result);
    }
}
