<!-- resources/views/categories/show.blade.php -->

@extends('layouts.app')

@section('title', 'Categories - GALALEARN')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cate_list.css') }}">
@endsection

@section('content')
<div class="subcategory-title">
    <h1>{{ $category->name }}</h1>
</div>


@if($category->subCategories->isNotEmpty())
<div class="subcategory-container">
    @foreach($category->subCategories as $index => $subCategory)
    <div class="subcategory-item {{ $loop->iteration == 3 ? 'full-width' : '' }}">
        <a href="{{ route('categories.showSubCategory', [$category->category_id, $subCategory->category_id]) }}">
            <h3>{{ $subCategory->name }}</h3>
        </a>
    </div>
    @endforeach
</div>
@else
<p>Cette section est vide.</p>
@endif
@endsection