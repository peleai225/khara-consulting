@extends('layouts.admin')
@section('title', 'Nouveau programme - Admin')
@section('page-title', 'Nouveau programme')
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.programs.store') }}" method="POST">@csrf
        @include('admin.programs.partials.form')
    </form>
</div>
@endsection
