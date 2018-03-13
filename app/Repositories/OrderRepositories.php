<?php


namespace App\Repositories;

use App\Order;

class OrderRepositories
{
    /**
     * Получить заказы с пагинацией и сортировкой
     * @param $perPage
     * @param $sortBy
     * @param $sort
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithSort($perPage, $sortBy, $sort)
    {
        return Order::with('user', 'positions.product')
            ->select('orders.*', 'users.email')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->orderBy($sortBy, $sort)
            ->paginate($perPage);
    }
}