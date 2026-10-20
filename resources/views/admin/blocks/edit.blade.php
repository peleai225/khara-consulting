@extends('layouts.admin')
@section('title', 'Modifier le bloc - Admin')
@section('page-title', 'Modifier le bloc')
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.blocks.update', $block) }}" method="POST">@csrf @method('PUT')
        @include('admin.blocks.partials.form')
    </form>
</div>
@endsection
