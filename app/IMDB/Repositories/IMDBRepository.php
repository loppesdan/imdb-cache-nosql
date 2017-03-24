<?php

namespace App\IMDB\Repositories;

use Illuminate\Support\Facades\DB;

class IMDBRepository  implements IRepository{

    public function getFilmById($id) {
        $film = DB::table('title')
                        ->select('title.id', 'title.title', 'movie_info.id', 'movie_info.info_type_id', 'movie_info.info', 
                        'cast_info.note', 'role_type.role', 'role_type.id', 'name.id', 'name.name')
                        ->leftJoin('movie_info', 'title.id', '=', 'movie_info.movie_id')
                        ->leftJoin('cast_info', 'title.id', '=', 'cast_info.movie_id')
                        ->leftJoin('role_type', 'cast_info.role_id', '=', 'role_type.id')
                        ->leftJoin('name', 'cast_info.person_id', '=', 'name.id')
                        ->where('movie_info.info_type_id', 98)
                        ->where('title.id', $id)->get();

        return $film;
    }

    public function getFilmByPerson($id) {
        $films = DB::table('title')
                        ->select('title.id', 'title.title', 'title.production_year')
                        ->leftJoin('movie_info', 'title.id', '=', 'movie_info.movie_id')
                        ->leftJoin('cast_info', 'title.id', '=', 'cast_info.movie_id')
                        ->leftJoin('role_type', 'cast_info.role_id', '=', 'role_type.id')
                        ->leftJoin('name', 'cast_info.person_id', '=', 'name.id')
                        ->where('movie_info.info_type_id', 98)
                        ->where('name.id', $id)
                        ->groupBy('title.id')->get();

        return $films;
    }
    
    public function getTopFilms() {
        $films = DB::table('title')
                        ->select('title.id', 'title.title', 'title.production_year', 'movie_info_idx.info')
                        ->leftJoin('movie_info_idx', 'title.id', '=', 'movie_info_idx.movie_id')
                        ->where('movie_info_idx.info_type_id', 112)->get();

        return $films;
    }

}
