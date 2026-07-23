 <!-- resources/views/blogs/show.blade.php -->

 @extends('layouts.app')


 @section('title', 'GALALEARN')

 @section('styles')
<link rel="stylesheet" href="{{ asset('css/quiz_cont_blo.css') }}">
@endsection

 @section('content')

 <div class="cours-container">

 <div class="blogs-container">
    
    <div class="blogs-header">
        <h1>{{ $blog->title }}</h1>
        <p>Posté le : {{ $blog->created_at }} , modifié le : {{ $blog->updated_at }}</p>
        <p>{{ $subCategory->name }}</p>
    </div>

    @if($blog->url_media)
    <div class="blogs-image">
        <img src="{{ asset('storage/' . $blog->url_media) }}" alt="{{ $blog->title }}">
    </div>
    @endif

    <div class="blogs-content">
        <p>{!! nl2br(e($blog->text)) !!}</p>
    </div>

    <div class="blogs-navigation">
        <a href="{{ route('home') }}" class="blogs-link">Retour à l'accueil</a>
        <a href="{{ route('categories.showSubCategory', [$category->category_id, $subCategory->category_id]) }}" class="blogs-link">Retour</a>
    </div>

    @if(session('success_comment_blog'))
    <div class="alert alert-success blogs-alert">
        {{ session('success_comment_blog') }}
    </div>
    @endif

    <div class="blogs-comments">
        <h2>Commentaires</h2>
        @foreach($comments as $comment)
        <div class="blogs-comment">
            <p><strong>{{ $comment->student->user->username ?? 'Utilisateur inconnu' }}</strong> a dit :</p>
            <p>{!! nl2br(e($comment->text)) !!}</p>
            <p><small>Publié le : {{ $comment->created_at }}</small></p>
        </div>
        @endforeach
    </div>

    <div class="blogs-comment-form">
        @auth
        <form action="{{ route('comments.store', [$category->category_id, $subCategory->category_id, $blog->blog_id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="text">Votre commentaire :</label>
                <textarea name="text" id="text" class="form-control blogs-textarea" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary blogs-button">Ajouter un commentaire</button>
        </form>
        @else
        <p>Vous devez être connecté pour laisser un commentaire.</p>
        @endauth
    </div>
</div>



 @endsection