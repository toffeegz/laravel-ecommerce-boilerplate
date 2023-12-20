<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest as ModelRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Utils\Response\ResponseServiceInterface;

class ProductController extends Controller
{
    private $responseService;
    private $name = 'Product';
    
    public function __construct(
        ProductRepositoryInterface $modelRepository, 
        ResponseServiceInterface $responseService,
    ) {
        $this->modelRepository = $modelRepository;
        $this->responseService = $responseService;
    }

    public function index()
    {
        $results = $this->modelRepository->lists(request(['search']));
        return $this->responseService->successResponse($this->name, $results);
    }

    public function store(ModelRequest $request)
    {
        $result = $this->modelRepository->create($request->all());
        return $this->responseService->storeResponse($this->name, $result);
    }

    public function show($id)
    {
        $result = $this->modelRepository->show($id);
        return $this->responseService->successResponse($this->name, $result);
    }

    public function update(ModelRequest $request, $id)
    {
        $result = $this->modelRepository->update($request->all(), $id);
        return $this->responseService->updateResponse($this->name, $result);
    }

    public function delete(string $id)
    {
        $result = $this->modelRepository->delete($id);
        return $this->responseService->successResponse($this->name, $result);
    }
}
