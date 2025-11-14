<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\videos;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');

        $videosQuery = videos::query();

        if ($query) {
            // Поиск по названию
            $videosQuery->where('title', 'LIKE', "%{$query}%");
        } else {
            // Без поиска — показываем последние видео
            // Можно оставить так или изменить по необходимости
        }

        // Обработка сортировки
        switch ($sort) {
            case 'date_desc':
                $videosQuery->orderBy('created_at', 'desc');
                break;
            case 'date_asc':
                $videosQuery->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $videosQuery->orderBy('title', 'asc');
                break;
            case 'name_desc':
                $videosQuery->orderBy('title', 'desc');
                break;
            case 'countLike_desc':
                $videosQuery->orderBy('count_like', 'desc'); // Предполагается поле likes_count
                break;
            case 'countLike_asc':
                $videosQuery->orderBy('count_like', 'asc');
                break;
            default:
                // Можно оставить без сортировки или по умолчанию
                break;
        }
  
        $videos = $videosQuery->get();


        // Передача данных в представление, включая текущий выбор сортировки
        return view('home', [
            'newVideo' => $videos,
            'searchQuery' => $query,
            'currentSort' => $sort,
        ]);
    }

    public function myvideo() {
        $videos = videos::where('user_id', Auth::user()->id)->get();

       return view('cabinet.myvideo',[
        'newVideo' => $videos,
       ]); 
    }
}