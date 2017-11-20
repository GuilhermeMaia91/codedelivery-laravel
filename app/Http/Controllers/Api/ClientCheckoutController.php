<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientCheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $service;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository, OrderService $service)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->service = $service;
    }

    public function index(Request $request){
        $clientId = $this->userRepository->find($request->user()->id)->client->id;

        $orders = $this->orderRepository->with('items')->scopeQuery(function($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }

    public function store(Request $request){
        $data = $request->all();
        $clientId = $this->userRepository->find($request->user()->id)->client->id;

        $data['client_id'] = $clientId;
        $ob = $this->service->create($data);
        
        return $this->orderRepository->with('items')->find($ob->id);
    }

    public function show($id){
        $orders = $this->orderRepository->with(['client', 'cupom', 'items'])->find($id);

        $orders->items->each(function($item){
            $item->product;
        });

        return $orders;
    }
}
