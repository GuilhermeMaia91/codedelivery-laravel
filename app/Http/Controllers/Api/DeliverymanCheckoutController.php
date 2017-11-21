<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliverymanCheckoutController extends Controller
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
     * @var OrderService
     */
    private $service;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, OrderService $service)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function index(Request $request){
        $deliverymanId = $request->user()->id;

        $orders = $this->orderRepository->with('items')->scopeQuery(function($query) use($deliverymanId){
            return $query->where('user_deliveryman_id', '=', $deliverymanId);
        })->paginate();

        return $orders;
    }

    public function show($id){
        $orders = $this->orderRepository->with(['client', 'cupom', 'items'])->find($id);

        $orders->items->each(function($item){
            $item->product;
        });

        return $orders;
    }
}
