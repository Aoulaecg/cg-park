@extends('layouts.site')

@section('page_title', 'Politique de confidentialité - MobilePark | CGPark')

@section(
    'meta_description',
    'Politique de confidentialité de l’application MobilePark éditée par la Compagnie Générale des Parkings.'
)

@section(
    'body_class',
    trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'mentions-page privacy-page')
)

@section('content')

    <div class="container mentions-hero-inner">
        <h1 class="mentions-hero-title">
            Politique de confidentialité
        </h1>
    </div>

    <section class="mentions-content-section">
        <div class="container mentions-content">

            <h2>Politique de confidentialité de l’application MobilePark</h2>

            <p>
                La présente politique de confidentialité a pour objet d’informer les
                utilisateurs de l’application <strong>MobilePark</strong>, éditée par la
                <strong>Compagnie Générale des Parkings (CGPark)</strong>, sur les modalités
                de collecte, d’utilisation, de conservation et de protection de leurs données
                à caractère personnel.
            </p>

           
            <p>
                Les traitements de données à caractère personnel réalisés dans le cadre de
                l’utilisation de l’application MobilePark sont effectués conformément aux
                dispositions de la <strong>loi n°09-08</strong> relative à la protection des
                personnes physiques à l’égard du traitement des données à caractère personnel,
                ainsi qu’à ses textes d’application.
            </p>

            <p>
                Le traitement des données mis en œuvre par la Compagnie Générale des Parkings
                bénéficie de l’autorisation de la Commission Nationale de Contrôle de la
                Protection des Données à Caractère Personnel (CNDP)
                <strong>n° A-GC-964/2026</strong>.
            </p>

            <h2>Collecte et utilisation des données</h2>

            <p>
               Les données à caractère personnel sont collectées uniquement dans le cadre de l'utilisation des services proposés par l'application MobilePark.
            </p>

            <p>Elles sont traitées exclusivement pour assurer la fourniture des services, le bon fonctionnement de l'application et l'amélioration continue des services proposés par la Compagnie Générale des Parkings, dans le respect des dispositions de la loi n°09-08 relative à la protection des données à caractère personnel.</p>

            <p>
                Les données collectées ne sont utilisées que pour les finalités pour lesquelles elles ont été recueillies.
</p>

         

            <h2>Protection des données</h2>

            <p>
                CGPark met en œuvre les mesures techniques, organisationnelles et de sécurité
                appropriées afin d’assurer la confidentialité, l’intégrité et la protection des
                données personnelles contre tout accès, divulgation, modification ou destruction
                non autorisés.
            </p>

            <p>
                Les données personnelles sont hébergées sur des infrastructures sécurisées.
            </p>

            <h2>Hébergement et transfert des données</h2>

            <p>
                Les données personnelles traitées dans le cadre de l’application MobilePark sont
                hébergées au Maroc.
            </p>

            <p>
                Aucun transfert de données à caractère personnel vers un pays étranger n’est
                effectué, sauf dans les cas prévus par la réglementation applicable et après
                accomplissement des formalités requises auprès de la CNDP.
            </p>

           <h2> Droits des utilisateurs</h2>

<p>Conformément aux dispositions de la loi n°09-08 relative à la protection des personnes physiques à l'égard du traitement des données à caractère personnel, tout utilisateur dispose d'un droit d'accès, de rectification et, dans les conditions prévues par la réglementation en vigueur, d'opposition au traitement de ses données à caractère personnel.</p>

<p>Toute demande relative à l'exercice de ces droits peut être adressée à la Compagnie Générale des Parkings aux coordonnées indiquées ci-dessous.</p>
            

            <h2>Conditions Générales d’Utilisation</h2>

            <p>
                Les Conditions Générales d'Utilisation (CGU) de l'application MobilePark complètent la présente politique de confidentialité et précisent les modalités d'utilisation des services proposés.
            </p>


            <h2>Contact</h2>

            <p>
                Pour toute question relative à la protection des données personnelles ou à
                l’exercice de vos droits, vous pouvez contacter :
            </p>

            <p>
                <strong>Compagnie Générale des Parkings (CGPark)</strong><br>
                Téléphone : 05 37 71 38 15 <br>
                E-mail :
                <a
                    href="mailto:cgp@cdg-cgpark.com"
                    class="mentions-link"
                >
                    cgpark@cdg-cgpark.com
                </a>
            </p>

        </div>
    </section>

@endsection