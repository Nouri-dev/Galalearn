<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('title', 'Accueil - GALALEARN')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="container_home main">

    @if (session('error_email_verify'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error_email_verify') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @auth
    <div class="welcome-username-home">
        <h1>Bienvenue,<br> {{ Auth::user()->username }}.</h1>
    </div>
    @endauth



    @guest
    <div class="register-link-home">
        <p>Vous n'avez pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></p>
    </div>
    @endguest



    @if(isset($latestBlog))
    <div class="latest-blog-home">
        <div class="latest-blog-home-publi">
            <h2>Dernières Nouvelles</h2>
            <p class="latest-blog-home-p">Découvrez notre dernière publication où nous explorons des sujets captivants et actuels. <br>
                Que vous soyez à la recherche de conseils, d'informations ou d'inspiration, ce nouvel article est fait pour vous. </p>
        </div>

        <a href="{{ route('blogs.show', ['categoryId' => $latestBlog->category->parentCategory->category_id ?? $latestBlog->category->category_id, 'subCategoryId' => $latestBlog->category->category_id, 'blog_id' => $latestBlog->blog_id]) }}" class="blog-card latest-blog-home-card">
            <div class="blog-card-content">
                <h3 class="blog-title latest-blog-home-title">{{ $latestBlog->title }}</h3>
                <p class="blog-excerpt latest-blog-home-excerpt">{{ Str::limit($latestBlog->text, 100, '...') }} <br> Posté le : {{ $latestBlog->created_at }}</p>

            </div>
        </a>

    </div>
    @endif



    <div class="home-content-description">
        <p>GalaLean est une plateforme d'apprentissage en ligne innovante, offrant une gamme complète de blogs informatifs, de quiz interactifs et une formation entièrement gratuite. Découvrez un univers d'apprentissage flexible et accessible à tous.</p>
    </div>




    @if(isset($latestContents) && $latestContents->isNotEmpty())
    <div class="latest-contents">
        <h2>Derniers Cours</h2>
        <div class="content-grid">
            @foreach($latestContents->take(3) as $content) <!-- Limite à 3 contenus -->
                <div class="content-item">
                    <a href="{{ route('contents.show', [
                        'categoryId' => $content->category->parentCategory->category_id ?? $content->category->category_id, 
                        'subCategoryId' => $content->category->category_id, 
                        'content_id' => $content->content_id
                    ]) }}" class="content-link">
                        <h3>{{ $content->title }}</h3>
                        <p>{{ Str::limit($content->text, 100) }}</p> <!-- Affiche un extrait du texte -->
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif






</div>
@endsection