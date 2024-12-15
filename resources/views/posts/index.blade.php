@extends('layouts.app')

@section('content')

    <div class="card card-success mt-4">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col-6">
                    <h3 class="card-title">{{__('Posts management')}}</h3>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-secondary" href="{{route('posts.create')}}">
                        <i class="fa fa-plus"></i> {{__('Create post')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body posts-table">
            <livewire:posts-table/>
        </div>
    </div>

@endsection
