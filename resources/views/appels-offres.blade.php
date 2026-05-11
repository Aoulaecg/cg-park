@extends('layouts.site')

@section('page_title', __('appels_offres.page_title'))
@section('meta_description', __('appels_offres.page_description'))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'tenders-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/appels-offres.css') }}">
@endpush

@section('content')
    <section class="tenders-hero">
        <div class="container tenders-hero-inner" data-reveal>
            <p class="tenders-hero-eyebrow">{{ __('appels_offres.eyebrow') }}</p>
            <h1 class="tenders-hero-title">{{ __('appels_offres.page_heading') }}</h1>
            <p class="tenders-hero-text">{{ __('appels_offres.intro_text') }}</p>
        </div>
    </section>

    <section class="tenders-list-section">

            
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
                            @forelse ($appels as $appel)
                                <tr>
                                    <td data-label="{{ __('appels_offres.table_column_object') }}">
                                        {{ $appel->objet }}
                                    </td>
                                    <td data-label="{{ __('appels_offres.table_column_deadline') }}">
                                        <span class="tenders-deadline">{{ $appel->date_limite_formatted ?: '—' }}</span>
                                    </td>
                                    <td data-label="{{ __('appels_offres.table_column_action') }}">
                                        @if ($appel->fichier_path)
                                            @php
                                                $extension = strtolower(pathinfo($appel->fichier_path, PATHINFO_EXTENSION));
                                                $isArchive = in_array($extension, ['zip', 'rar']);
                                            @endphp
                                            <div class="tenders-actions">
                                                <a href="{{ route('appels-offres.download', $appel) }}"
                                                   class="tenders-action tenders-action-primary">
                                                    @if ($isArchive)
                                                        <!-- <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:4px;">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v6m-3-3h6"/>
                                                        </svg> -->
                                                    @endif
                                                    {{ __('appels_offres.download') }}
                                                </a>
                                                <!-- @if (!$isArchive)
                                                    <a href="{{ Storage::url($appel->fichier_path) }}"
                                                       class="tenders-action tenders-action-secondary"
                                                       target="_blank" rel="noreferrer">
                                                        {{ __('appels_offres.view') }}
                                                    </a>
                                                @endif -->
                                            </div>
                                        @else
                                            <span style="color:rgba(7,27,53,0.4);font-size:0.9rem;">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align:center;padding:32px;color:rgba(7,27,53,0.5);">
                                        Aucun appel d'offres disponible pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
