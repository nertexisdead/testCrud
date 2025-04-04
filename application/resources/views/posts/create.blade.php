@extends('layouts.app')
@section('content')

    <form data-action="{{ route('posts.save') }}" class="new_post_form">
        <div class="card card-success mt-4">
            <div class="card-header">
                <div class="row justify-content-between align-items-center">
                    <div class="col-6 center-align">
                        <h3 class="card-title">{{__('Create post')}}</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>{{__('Post: title')}}</label>
                    <input name="title" type="text" class="form-control" placeholder="{{__('Enter post title')}}">
                    <span class="error title"></span>
                </div>
                <div class="form-group">
                    <label>{{__('Post: content')}}</label>
                    <textarea name="content" type="text" class="form-control js-posts-editor"
                              placeholder="{{__('Enter post content')}}" rows="4"></textarea>
                    <span class="error content"></span>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">{{__('Create post')}}</button>
                <a href="{{route('posts.index')}}"
                   class="btn btn-outline-secondary float-right">{{__('Cancel')}}</a>
            </div>
        </div>
    </form>
@endsection

@push('js')
    @vite([
        'resources/js/posts.js',
    ])
@endpush
