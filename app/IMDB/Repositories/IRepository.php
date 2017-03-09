<?php

namespace App\IMDB\Repositories;


interface IRepository {

    public function getFilmById($id);
    public function getFilmByPerson($id);
    public function getTopFilms();

}
