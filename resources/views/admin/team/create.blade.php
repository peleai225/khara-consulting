@extends('layouts.admin')
@section('title', 'Nouveau membre - Admin')
@section('page-title', 'Nouveau membre')
@section('content')
<div class="admin-card max-w-3xl">
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">@csrf
        @include('admin.team.partials.form')
    </form>
</div>
@endsection
