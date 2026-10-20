@extends('layouts.admin')
@section('title', 'Nouveau bloc - Admin')
@section('page-title', 'Nouveau bloc de contenu')
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.blocks.store') }}" method="POST">@csrf
        @include('admin.blocks.partials.form')
    </form>
</div>
@endsection
