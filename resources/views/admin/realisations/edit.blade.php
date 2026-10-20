@extends('layouts.admin')

@section('title', 'Modifier la réalisation - Admin')
@section('page-title', 'Modifier : ' . $realisation->title)

@section('content')
<div class="admin-card max-w-4xl">
    <form action="{{ route('admin.realisations.update', $realisation) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.realisations.partials.form')
    </form>
</div>
@endsection
