@extends('layouts.admin')
@section('title', 'Nouveau chiffre clé - Admin')
@section('page-title', 'Nouveau chiffre clé')
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.stats.store') }}" method="POST">@csrf
        @include('admin.stats.partials.form')
    </form>
</div>
@endsection
