<div class="col">
    <div class="card shadow-sm">
        <article>    
            <div class="video" >
                <video style="width: 100%; height: 100%" controls poster="{{ $video->img_path }}">
                    <source src="{{ $video->path }}" type="video/mp4">
                    Ваш браузер не поддерживает тег video.
                </video>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $video->title }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <form action="/like" method="post" class="like-form">
                        @csrf
                        <input type="hidden" name="videos_id" value="{{ $video->id }}">
                        <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
                            <div class="btn-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg>
                                <p class="like-count">{{ $video->count_like }}</p>
                            </div>
                        </button>
                    </form>
                </div>
        </article> 
    </div>
</div>

<script>
   
document.querySelectorAll('.like-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // отменить стандартное поведение формы

        const formData = new FormData(this);
        fetch('{{ route("video.toggleLike") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // После успешного ответа обновляем число лайков
            const likeCountElement = this.querySelector('.like-count');
            likeCountElement.textContent = data.like_count;
        })
        .catch(error => {
            console.error('Ошибка при отправке запроса:', error);
        });
    });
});
</script>