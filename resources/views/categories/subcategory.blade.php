<!-- resources/views/categories/subcategory.blade.php -->
@extends('layouts.app')

@section('title', 'Liste - GALALEARN')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cate_list.css') }}">
@endsection

@section('content')

<div class="subcategory-title">
    <h1>{{ $subCategory->name }}</h1>
</div>

<div class="list-content-main">

    @php
    $isEmpty = !$subCategory->contents->isNotEmpty()
    && !$subCategory->quizzes->isNotEmpty()
    && !$subCategory->blogs->isNotEmpty();
    @endphp

    @if($subCategory->contents->isNotEmpty())
    <div class="content-grid-liste">
        @foreach($subCategory->contents as $content)
        <div class="content-item-liste">
            <a href="{{ route('contents.show', [$category->category_id, $subCategory->category_id, $content->content_id]) }}">
                <h3>{{ $content->title }}</h3>
                <p>{{ Str::limit($content->text, 100) }}</p>
            </a>
        </div>
        @endforeach
    </div>
    @endif

    @if($subCategory->quizzes->isNotEmpty())
    <div class="content-grid-liste">
        @foreach($subCategory->quizzes as $quiz)
        <div class="content-item-liste">
            <a href="{{ route('quizzes.show', [$category->category_id, $subCategory->category_id, $quiz->quiz_id]) }}">
                <h3>{{ $quiz->title }}</h3>
            </a>
        </div>
        @endforeach
    </div>
    @endif

    @if($subCategory->blogs->isNotEmpty())
    <div class="content-grid-liste">
        @foreach($subCategory->blogs as $blog)
        <div class="content-item-liste">
            <a href="{{ route('blogs.show', [$category->category_id, $subCategory->category_id, $blog->blog_id]) }}">
                <h3>{{ $blog->title }}</h3>
            </a>
        </div>
        @endforeach
    </div>
    @endif

    @if($isEmpty)
    <p>Cette section est vide.</p>
    @endif


</div>





@endsection