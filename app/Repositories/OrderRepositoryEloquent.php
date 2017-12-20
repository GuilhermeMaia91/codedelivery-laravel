<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Models\Order;
use CodeDelivery\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent
 * @package namespace Codedelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = ['data' => []];

        $collectionOrders = $this->findWhere(
            [
                'id' => $id,
                'user_deliveryman_id' => $idDeliveryman
            ]
        );

        if ($collectionOrders instanceof Collection) {
            $result = $collectionOrders->first();
        }
        else{
            if (isset($collectionOrders['data']) and count($collectionOrders['data']) == 1){
                $result = [
                    'data' => $collectionOrders['data'][0]
                ];
            }
            else{
                throw new ModelNotFoundException("Order não encontrada.");
            }
        }


        return $result;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function presenter()
    {
        return OrderPresenter::class;
    }
}
