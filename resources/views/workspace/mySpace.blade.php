<!-- resources/views/workspace/mySpace.blade.php -->

@extends('layouts.app')

@section('title', 'My Space')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/workspace.css') }}">
@endsection

@section('content')
<div class="main-workspace">
    <div id="sidebar">
        <ul class="nav flex-column">

            @if($user->student)
            <li class="nav-item">
                <a class="nav-link" href="#" id="profil-toggle">Profil</a>
                <ul class="nav flex-column collapse" id="profil-menu">
                    <li class="nav-item"><a class="nav-link" href="#indexUserProfile" id="indexUserProfileLink">Mes informations</a></li>
                    <li class="nav-item"><a class="nav-link" href="#indexResult" id="indexResultLink">Mes resultats</a></li>
                </ul>
            </li>
            @endif
           

            @if($user->instructor)
            <li class="nav-item">
                <a class="nav-link" href="#" id="academie-toggle">Académie</a>
                <ul class="nav flex-column collapse" id="academie-menu">
                    <li class="nav-item"><a class="nav-link" href="#create-content" id="createContentLink">Créer un Cours</a></li>
                    <li class="nav-item"><a class="nav-link" href="#index-content" id="indexContentLink">Modifier ou Supprimer un Cours</a></li>
                    <li class="nav-item"><a class="nav-link" href="#create-blog" id="createBlogLink">Créer un Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#index-blog" id="indexBlogLink">Modifier ou Supprimer un Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#createQuiz" id="createQuizLink">Créer un Quiz</a></li>
                    <li class="nav-item"><a class="nav-link" href="#indexQuiz" id="indexQuizLink">Modifier ou Supprimer un Quiz</a></li>
                </ul>
            </li>
            @endif

            @if($user->administrator)
            <li class="nav-item">
                <a class="nav-link" href="#" id="administration-toggle">Administration</a>
                <ul class="nav flex-column collapse" id="administration-menu">
                    <li class="nav-item"><a class="nav-link" href="#delete-user" id="deleteUserLink">Supprimer un Utilisateur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#add-role-user" id="addRoleUserLink">Ajouter un rôle Utilisateur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#remove-role-user" id="removeRoleUserLink">Supprimer un rôle Utilisateur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#create-category" id="createCategoryLink">Créer une Catégorie</a></li>
                    <li class="nav-item"><a class="nav-link"  href="#delete-category" id="deleteCategoryLink" >Supprimer une Catégorie</a></li>
                    <li class="nav-item"><a class="nav-link"  href="#delete-comment" id="deleteCommentLink" >Supprimer un Commentaire</a></li>
                </ul>
            </li>
            @endif

        </ul>
    </div>
    
    <div class="containerWorkspace">
        <h1>Bienvenue dans ton espace, <br> {{ Auth::user()->username }}.</h1>
        @include('workspace.create_category')
        @include('workspace.delete_category')
        @include('workspace.delete_user')
        @include('workspace.add_role_user')
        @include('workspace.index_user')
        @include('workspace.remove_role_user')
        @include('workspace.delete_comment')
        @include('workspace.create_quiz')
        @include('workspace.index_quiz')
        @include('workspace.create_content')
        @include('workspace.index_content')
        @include('workspace.create_blog')
        @include('workspace.index_blog')
        @include('workspace.index_result')

        

    </div>

    

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/workspace.js') }}"></script>
@endsection 
  



