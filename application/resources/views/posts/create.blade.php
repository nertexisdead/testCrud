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
                    <label>{{ __('Post: alias') }}</label>
                    <input name="alias" type="text" class="form-control" placeholder="{{ __('Enter post alias') }}" >
                </div>
                <ul class="nav nav-tabs" role="tablist">
                    @foreach(config('app.availables_locales') as $index => $locale)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($index === 0) active @endif" id="tab-{{ $locale }}"
                                    data-bs-toggle="tab" data-bs-target="#content-{{ $locale }}" type="button"
                                    role="tab" aria-controls="content-{{ $locale }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ strtoupper($locale) }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <!-- Контент табов -->
                <div class="tab-content mt-3">
                    @foreach(config('app.availables_locales') as $index => $locale)
                        <div class="tab-pane fade @if($index === 0) show active @endif" id="content-{{ $locale }}"
                             role="tabpanel" aria-labelledby="tab-{{ $locale }}">
                            <div class="form-group">
                                <label>{{ __('Post: title') }} ({{ $locale }})</label>
                                <input name="title[{{ $locale }}]" type="text" class="form-control"
                                       placeholder="{{ __('Enter post title') }}">
                                <span class="error title_{{ $locale }}"></span>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Post: content') }} ({{ $locale }})</label>
                                <textarea name="content[{{ $locale }}]" class="form-control js-posts-editor"
                                          placeholder="{{ __('Enter post content') }}" rows="4"></textarea>
                                <span class="error content_{{ $locale }}"></span>
                            </div>
                        </div>
                    @endforeach
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
