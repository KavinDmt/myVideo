<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VideoLike;
use App\Models\videos;

class VideoLikeController extends Controller
{
    public function toggle(Request $request)
    {
        
        $userId = Auth::id(); // получаем текущего пользователя
        $videoId = $request->input('videos_id');


        // Проверка: есть ли уже лайк от этого пользователя
        $existingLike = VideoLike::where('user_id', $userId)
            ->where('videos_id', $videoId)
            ->first();

        
        if ($existingLike) {
            
            // Лайк есть — удаляем (снимаем лайк)
            $existingLike->delete();
        } else {
            // Лайка нет — создаем новый
            VideoLike::create([
                'user_id' => $userId,
                'videos_id' => $videoId,
            ]);
        }

        // Подсчитываем текущее количество лайков
        $likeCount = VideoLike::where('videos_id', $videoId)->count();

        // Обновление поля count_like
        videos::where('id', $videoId)->update([
            'count_like' => $likeCount
        ]);


        // Возвращаем обновленное число лайков
         return response()->json([
            'like_count' => $likeCount,
        ]); 
    }

        // Отобразить форму загрузки
    public function create()
    {
        return view('cabinet.load');
    }

    // Обработать загрузку файла
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:102400',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048', // максимум 2MB
        ]);

       // Пути к папкам в public
        $videoDirectory = public_path('videos');
        $imageDirectory = public_path('images');
         // Создаем папки, если их нет
        if (!is_dir($videoDirectory)) {
            mkdir($videoDirectory, 0755, true);
        }
        if (!is_dir($imageDirectory)) {
            mkdir($imageDirectory, 0755, true);
        }
            // Загружаем видео
        $videoFileName = uniqid() . '.' . $request->video->extension();
        $request->video->move($videoDirectory, $videoFileName);

        // Загружаем изображение
        $imageFileName = uniqid() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move($imageDirectory, $imageFileName);


        // Создаем запись
        $video = new videos();
        $video->user_id = Auth::id();
        $video->title = $request->input('title');
        $video->path = '/videos/' . $videoFileName;;
        $video->img_path = '/images/' . $imageFileName;;
        $video->count_like = 0;
        $video->save();

        return redirect()->route('cabinet.load')->with('success', 'Видео и миниатюра успешно загружены!');
}
}
