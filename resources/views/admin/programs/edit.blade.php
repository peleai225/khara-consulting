@extends('layouts.admin')
@section('title', 'Modifier le programme - Admin')
@section('page-title', 'Modifier : ' . $program->title)
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.programs.update', $program) }}" method="POST">@csrf @method('PUT')
        @include('admin.programs.partials.form')
    </form>
</div>
@endsection
