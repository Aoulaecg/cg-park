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
                                                <button
                                                    type="button"
                                                    class="tenders-action tenders-action-primary open-download-modal"
                                                    data-download-action="{{ route('appels-offres.download', $appel) }}"
                                                    data-appel-object="{{ $appel->objet }}"
                                                >
                                                 {{ __('appels_offres.download') }}
                                                </button>
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
    <div id="downloadModal" class="download-modal" aria-hidden="true">
    <div class="download-modal-overlay"></div>

    <div class="download-modal-content" role="dialog" aria-modal="true">
        <button
            type="button"
            class="download-modal-close"
            id="closeDownloadModal"
            aria-label="Fermer"
        >
            ×
        </button>

        <h2 class="download-modal-title">
            Téléchargement du dossier
        </h2>

        <p class="download-modal-description" id="downloadAppelObject"></p>

        <form
            method="POST"
            id="downloadCompanyForm"
            action=""
        >
            @csrf

            <div class="download-form-group">
                <label for="company_name">
                    Nom de la société <span aria-hidden="true">*</span>
                </label>

                <input
                    type="text"
                    name="company_name"
                    id="company_name"
                    maxlength="255"
                    required
                    autocomplete="organization"
                    placeholder="Saisissez le nom de votre société"
                >
            </div>

            <div class="download-modal-actions">
                <button
                    type="button"
                    class="download-modal-cancel"
                    id="cancelDownloadModal"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    class="download-modal-submit"
                >
                    Télécharger
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('downloadModal');
        const form = document.getElementById('downloadCompanyForm');
        const companyInput = document.getElementById('company_name');
        const appelObject = document.getElementById('downloadAppelObject');

        const closeButton = document.getElementById('closeDownloadModal');
        const cancelButton = document.getElementById('cancelDownloadModal');
        const overlay = modal.querySelector('.download-modal-overlay');

        const downloadButtons = document.querySelectorAll('.open-download-modal');

        function openModal(button) {
            form.action = button.dataset.downloadAction;
            appelObject.textContent = button.dataset.appelObject;

            companyInput.value = '';
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');

            setTimeout(function () {
                companyInput.focus();
            }, 100);
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');

            form.action = '';
            companyInput.value = '';
        }

        downloadButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                openModal(button);
            });
        });

        closeButton.addEventListener('click', closeModal);
        cancelButton.addEventListener('click', closeModal);
        overlay.addEventListener('click', closeModal);

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });
    });
</script>
@endsection
