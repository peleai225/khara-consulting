@extends('layouts.admin')

@section('title', 'Nouvelle réalisation - Admin')
@section('page-title', 'Nouvelle réalisation')

@section('content')
<div class="admin-card max-w-4xl">
    <form action="{{ route('admin.realisations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.realisations.partials.form')
    </form>
</div>
@endsection
