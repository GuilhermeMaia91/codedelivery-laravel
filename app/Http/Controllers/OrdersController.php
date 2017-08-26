<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminProductRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){

        $orders = $this->repository->paginate(5);

        return view('admin.orders.index', compact('orders'));
    }

    public function create(){
        
    }

    public function store(AdminOrderRequest $request){
        
    }

    public function edit($id, UserRepository $userRepository){
        $list_status = [0 => 'Pendente', 1 => 'A Caminho', 2 => 'Entregue'];
        $order = $this->repository->find($id);

        $deliveryman = $userRepository->getDeliveryMen();

        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(Request $request, $id){
        $all = $request->all();
        $this->repository->update($all, $id);

        return redirect()->route('admin.orders.index');
    }

    public function destroy($id){
        $this->repository->delete($id);

        return redirect()->route('admin.orders.index');
    }
}
