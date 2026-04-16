@extends('layouts.site')

@section('page_title', __('gouvernance.page_title'))
@section('meta_description', __('gouvernance.page_description'))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'governance-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/governance.css') }}">
@endpush

@section('content')
    @php
        $boardMembers = [
            __('gouvernance.board_member_1'),
            __('gouvernance.board_member_2'),
            __('gouvernance.board_member_3'),
            __('gouvernance.board_member_4'),
            __('gouvernance.board_member_5'),
            __('gouvernance.board_member_6'),
        ];
    @endphp

    <section class="governance-hero">
        <div class="container governance-hero-inner" data-reveal>
            <p class="governance-hero-eyebrow">{{ __('gouvernance.eyebrow') }}</p>
            <h1 class="governance-hero-title">{{ __('gouvernance.page_heading') }}</h1>
        </div>
    </section>

    <section class="governance-section">
        <div class="container governance-content">
            <article class="governance-card" data-reveal>
                <header class="governance-card-header">
                    <h2 class="governance-card-title">{{ __('gouvernance.director_title') }}</h2>
                    <span class="governance-card-symbol" aria-hidden="true"></span>
                </header>

                <div class="governance-card-body governance-director-body">
                    <div class="governance-director-aside">
                        <div class="governance-director-avatar">
                            <span>{{ __('gouvernance.director_initials') }}</span>
                        </div>
                        <p class="governance-director-caption">{{ __('gouvernance.director_caption') }}</p>
                    </div>

                    <div class="governance-director-copy">
                        <p class="governance-director-name">{{ __('gouvernance.director_name') }}</p>
                        <p class="governance-director-text">{{ __('gouvernance.director_message') }}</p>
                    </div>
                </div>
            </article>

            <article class="governance-card" data-reveal>
                <header class="governance-card-header">
                    <h2 class="governance-card-title">{{ __('gouvernance.board_title') }}</h2>
                    <span class="governance-card-symbol" aria-hidden="true"></span>
                </header>

                <div class="governance-card-body">
                    <ul class="governance-board-list">
                        @foreach ($boardMembers as $member)
                            <li class="governance-board-item">
                                <span class="governance-board-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M8 12.5L10.8 15.2L16.2 9.7"></path>
                                    </svg>
                                </span>
                                <span class="governance-board-text">{{ $member }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </article>
        </div>
    </section>
@endsection
