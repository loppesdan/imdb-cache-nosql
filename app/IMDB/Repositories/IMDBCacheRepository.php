<?php

namespace App\IMDB\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\IMDB\Repositories\IMDBRepository;

class IMDBCacheRepository implements IRepository{

    private $imdbRepository;

    public function __construct(IMDBRepository $imdbRepository) {
        $this->imdbRepository = $imdbRepository;
    }

    public function getFilmById($id) {
        $film = Cache::remember('film_' . $id, 15, function() use (&$id) {
                    return $this->imdbRepository->getFilmById($id);
                });
              
        return $film;
    }

    public function getFilmByPerson($id) {
        $films = Cache::remember('person_' . $id, 15, function() use (&$id) {
                    return $this->imdbRepository->getFilmByPerson($id);
                });

        return $films;
    }

    public function getTopFilms() {
        $films = Cache::remember('top250', 15, function() {
                    return $this->imdbRepository->getTopFilms();
                });

        return $films;
    }

}
