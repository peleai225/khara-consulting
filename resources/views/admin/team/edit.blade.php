@extends('layouts.admin')
@section('title', 'Modifier le membre - Admin')
@section('page-title', 'Modifier : ' . $member->name)
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.team.update', $member) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
        @include('admin.team.partials.form')
    </form>
</div>
@endsection
