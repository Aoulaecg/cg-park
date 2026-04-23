@extends('layouts.site')

@section('page_title', __('appels_offres.page_title'))
@section('meta_description', __('appels_offres.page_description'))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'tenders-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/appels-offres.css') }}">
@endpush

@section('content')
    @php
        $tenders = [
            [
                'object' => __('appels_offres.row_1_object'),
                'deadline' => __('appels_offres.row_1_deadline'),
                'download_path' => 'documents/appels-offres/maintenance-prestation.pdf',
                'view_path' => 'documents/appels-offres/maintenance-prestation.pdf',
            ],
            [
                'object' => __('appels_offres.row_2_object'),
                'deadline' => __('appels_offres.row_2_deadline'),
                'download_path' => 'documents/appels-offres/fourniture-equipements.pdf',
                'view_path' => 'documents/appels-offres/fourniture-equipements.pdf',
            ],
            [
                'object' => __('appels_offres.row_3_object'),
                'deadline' => __('appels_offres.row_3_deadline'),
                'download_path' => 'documents/appels-offres/exploitation-parking.pdf',
                'view_path' => 'documents/appels-offres/exploitation-parking.pdf',
            ],
            [
                'object' => __('appels_offres.row_4_object'),
                'deadline' => __('appels_offres.row_4_deadline'),
                'download_path' => 'documents/appels-offres/travaux-amenagement.pdf',
                'view_path' => 'documents/appels-offres/travaux-amenagement.pdf',
            ],
        ];

        $regulationPath = 'documents\Reglement-des-achats-CGPark.pdf';
    @endphp

    <section class="tenders-hero">
        <div class="container tenders-hero-inner" data-reveal>
            <!-- <nav class="tenders-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">{{ __('appels_offres.breadcrumb_home') }}</a>
                <span aria-hidden="true">/</span>
                <span>{{ __('appels_offres.breadcrumb_current') }}</span>
            </nav> -->

            <p class="tenders-hero-eyebrow">{{ __('appels_offres.eyebrow') }}</p>
            <h1 class="tenders-hero-title">{{ __('appels_offres.page_heading') }}</h1>
            <p class="tenders-hero-text">{{ __('appels_offres.intro_text') }}</p>
        </div>
    </section>

    <section class="tenders-list-section">
        <div class="container">
            <div class="tenders-section-heading" data-reveal>
                <p class="tenders-section-label">{{ __('appels_offres.table_label') }}</p>
                <h2 class="tenders-section-title">{{ __('appels_offres.table_title') }}</h2>
                <p class="tenders-section-text">{{ __('appels_offres.table_intro') }}</p>
            </div>

            <div class="tenders-table-shell" data-reveal>
                <div class="tenders-table-scroll">
                    <table class="tenders-table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('appels_offres.table_column_object') }}</th>
                                <th scope="col">{{ __('appels_offres.table_column_deadline') }}</th>
                                <th scope="col">{{ __('appels_offres.table_column_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenders as $tender)
                                <tr>
                                    <td data-label="{{ __('appels_offres.table_column_object') }}">{{ $tender['object'] }}</td>
                                    <td data-label="{{ __('appels_offres.table_column_deadline') }}">
                                        <span class="tenders-deadline">{{ $tender['deadline'] }}</span>
                                    </td>
                                    <td data-label="{{ __('appels_offres.table_column_action') }}">
                                        <div class="tenders-actions">
                                            <a href="{{ asset($tender['download_path']) }}" class="tenders-action tenders-action-primary" download>
                                                {{ __('appels_offres.download') }}
                                            </a>
                                            <a href="{{ asset($tender['view_path']) }}" class="tenders-action tenders-action-secondary" target="_blank" rel="noreferrer">
                                                {{ __('appels_offres.view') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="tenders-regulation-section">
        <div class="container">
            <div class="tenders-regulation-card" data-reveal>
                <p class="tenders-section-label">{{ __('appels_offres.regulation_label') }}</p>
                <h2 class="tenders-regulation-title">{{ __('appels_offres.regulation_title') }}</h2>
                <p class="tenders-regulation-text">{{ __('appels_offres.regulation_text') }}</p>
                <a href="{{ asset($regulationPath) }}" class="tenders-regulation-button" download>
                    {{ __('appels_offres.regulation_button') }}
                </a>
            </div>
        </div>
    </section>
@endsection
