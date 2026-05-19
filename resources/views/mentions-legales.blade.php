@extends('layouts.site')

@section('page_title', __('mentions.page_title'))
@section('meta_description', __('mentions.page_description'))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'mentions-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mentions-legales.css') }}">
@endpush

@section('content')
    <section class="mentions-hero">
        <div class="container mentions-hero-inner">
            <h1 class="mentions-hero-title">{{ __('mentions.page_heading') }}</h1>
            <p class="mentions-hero-subtitle">{{ __('mentions.subtitle') }}</p>
        </div>
    </section>

    <section class="mentions-content-section">
        <div class="container mentions-content">
            <p>{!! __('mentions.intro') !!}</p>

            <h2>{{ __('mentions.contents_title') }}</h2>
            <p>{!! __('mentions.contents_text') !!}</p>

            <h2>{{ __('mentions.access_title') }}</h2>
            <p>{!! __('mentions.access_text_1') !!}</p>
            <p>{!! __('mentions.access_text_2') !!}</p>
            <p>{!! __('mentions.access_text_3') !!}</p>

            <h2>{{ __('mentions.data_title') }}</h2>
            <p>{!! __('mentions.data_text_1') !!}</p>
            <p>{!! __('mentions.data_text_2') !!}</p>
            <p>
                {!! __('mentions.data_text_3_prefix') !!}
                <a href="{{ asset('documents/Mentions Légales .pdf') }}" target="_blank" rel="noopener noreferrer" class="mentions-link">{{ __('mentions.cgu_mobile_link') }}</a>{!! __('mentions.data_text_3_suffix') !!}
            </p>

            <h2>{{ __('mentions.copyright_title') }}</h2>
            <p>{!! __('mentions.copyright_text_1') !!}</p>
            <p>{!! __('mentions.copyright_text_2') !!}</p>
            <p>{!! __('mentions.copyright_text_3') !!}</p>

            <h2>{{ __('mentions.photo_title') }}</h2>
            <p>{!! __('mentions.photo_text_1') !!}</p>
            <p>{!! __('mentions.photo_text_2') !!}</p>
            <p>{!! __('mentions.photo_text_3') !!}</p>
            <ul class="mentions-list">
                <li>{{ __('mentions.photo_credit_1') }}</li>
                <li>{{ __('mentions.photo_credit_2') }}</li>
            </ul>
        </div>
    </section>
@endsection
