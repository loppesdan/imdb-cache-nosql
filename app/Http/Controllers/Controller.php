<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\IMDB\Repositories\IRepository;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    private $repository;

    public function __construct(IRepository $imdbRepository) {
        $this->repository = $imdbRepository;
    }

    public function getFilme() {
        $id = 3781594;
        $film = $this->repository->getFilmById($id);
        return response()->json($film, 200);
    }
    public function getFilmeByAtor() {
        $idPerson = 1522949;
        $films = $this->repository->getFilmByPerson($idPerson);
        return response()->json($films, 200);
    }
    public function getTopFilms() {
        $films = $this->repository->getTopFilms();
        return response()->json($films, 200);
    }

}
