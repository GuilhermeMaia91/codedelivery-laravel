<?php

namespace CodeDelivery\Repositories;

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
    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $collectionOrders = $this->findWhere(
            [
                'id' => $id,
                'user_deliveryman_id' => $idDeliveryman
            ]
        );

        $result = $collectionOrders->first();
        if ($result) {
            $result->items->each(function ($item) {
                $item->product;
            });
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
}
