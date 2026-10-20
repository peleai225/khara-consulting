@extends('layouts.admin')
@section('title', 'Modifier le chiffre clé - Admin')
@section('page-title', 'Modifier le chiffre clé')
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.stats.update', $stat) }}" method="POST">@csrf @method('PUT')
        @include('admin.stats.partials.form')
    </form>
</div>
@endsection
