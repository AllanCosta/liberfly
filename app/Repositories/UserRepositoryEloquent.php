<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Presenters\UserPresenter;
use App\Http\Resources\AuthResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Log;

/**
 * Class UserRepositoryEloquent.
 */
class UserRepositoryEloquent implements UserRepository
{
    protected $model;
    protected $presenter;
    protected $skipPresenter = false;


    public function __construct(User $user, UserPresenter $presenter)
    {
        $this->model = $user;
        $this->presenter = $presenter;
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @return string
     */
    public function presenter(): string
    {
        return UserPresenter::class;
    }


    public function paginate(int $limit = 15): LengthAwarePaginator
    {
        return $this->model->paginate($limit);
    }

    /**
     * Define se o presenter deve ser ignorado.
     *
     * @return $this
     */
    public function skipPresenter(): self
    {
        $this->skipPresenter = true;
        return $this;
    }

    /**
     * Reseta a configuração para não ignorar o presenter.
     *
     * @return $this
     */
    public function resetPresenter()
    {
        $this->skipPresenter = false;
        return $this;
    }

    /**
     * Listar todos os registros com paginação.
     *
     * @param int $limit
     * @return mixed
     */
    public function all(int $limit = 15): LengthAwarePaginator
    {
        $result = $this->model->newQuery()->paginate($limit);
        //$result = $this->model->newQuery()->get();

        // LOG::debug('teste');
        // LOG::debug($result);
        //LOG::debug($this->parserResult($result));

        $transformedData = $this->presenter->presentCollection($result);

        return $transformedData;
    }











    /**
     * Listar todos os registros sem paginação.
     *
     * @return mixed
     */
    public function allWithoutPagination()
    {
        $query = $this->model->newQuery();
        $result = $query->get();
        return $this->parserResult($result);
    }

    /**
     * Criar um novo registro.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $result = $this->model->create($data);
        return $this->parserResult($result);
    }

    /**
     * Encontrar um registro por ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $query = $this->model->newQuery();
        $result = $query->find($id);
        return $this->parserResult($result);
    }

    /**
     * Atualizar um registro existente.
     *
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $this->parserResult($model);
    }

    /**
     * Deletar um registro.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $model = $this->model->find($id);
        $result = $model ? $model->delete() : false;
        return $this->parserResult($result);
    }


    /**
     * Aplica o presenter se não estiver configurado para ser ignorado.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyPresenter($query)
    {
        if ($this->skipPresenter) {
            return $query;
        }

        return $query;
    }

    /**
     * Parser de resultados para aplicar transformações, se necessário.
     *
     * @param mixed $result
     * @return mixed
     */
    protected function parserResult($result)
    {
        if ($this->skipPresenter) {
            return $result;
        }


        return $result;
    }
}
