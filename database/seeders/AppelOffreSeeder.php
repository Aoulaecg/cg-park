<?php

namespace Database\Seeders;

use App\Models\AppelOffre;
use Illuminate\Database\Seeder;

class AppelOffreSeeder extends Seeder
{
    public function run(): void
    {
        $appels = [
            [
                'titre'            => "Avis d'appel d'offres ouvert n°003/2026",
                'numero'           => '003/2026',
                'objet'            => "Avis d appel d offres ouvert n°003/2026 seance non publique, realisation des travaux de refection de la peinture au niveau du parking vegetal HAY RYAD",
                'date_publication' => '2026-03-01',
                'date_limite'      => '2026-04-01',
                'statut'           => 'ferme',
                'fichier_path'     => 'appels-offres/maintenance-prestation.pdf',
                'fichier_nom'      => 'maintenance-prestation.pdf',
                'sort_order'       => 0,
            ],
            [
                'titre'            => "Avis d'appel d'offres ouvert n°002/2026",
                'numero'           => '002/2026',
                'objet'            => "Avis d appel d offres ouvert n°002/2026 seance non publique, realisation des travaux de refection de la peinture au niveau du parking de la place MOULAY EL HASSAN",
                'date_publication' => '2026-02-15',
                'date_limite'      => '2026-03-31',
                'statut'           => 'ferme',
                'fichier_path'     => 'appels-offres/fourniture-equipements.pdf',
                'fichier_nom'      => 'fourniture-equipements.pdf',
                'sort_order'       => 1,
            ],
            [
                'titre'            => "Appel d'offres ouvert n°001/2026",
                'numero'           => '001/2026',
                'objet'            => "Appel d offres ouvert n°001/2026 seance non publique, les travaux de realisation de la signaletique verticale interieure et exterieure au niveau des parkings du nouveau terminal de l aeroport de RABAT- SALE",
                'date_publication' => '2026-02-01',
                'date_limite'      => '2026-03-09',
                'statut'           => 'ferme',
                'fichier_path'     => 'appels-offres/exploitation-parking.pdf',
                'fichier_nom'      => 'exploitation-parking.pdf',
                'sort_order'       => 2,
            ],
            [
                'titre'            => "Avis d'appel d'offre ouvert N° CGP/Torres T/04-25",
                'numero'           => 'CGP/Torres T/04-25',
                'objet'            => "Avis d appel d offre ouvert N° CGP/Torres T/04-25 Pour le compte de la Compagnie Générale des parkings",
                'date_publication' => '2025-04-01',
                'date_limite'      => '2025-05-08',
                'statut'           => 'archive',
                'fichier_path'     => 'appels-offres/travaux-amenagement.pdf',
                'fichier_nom'      => 'travaux-amenagement.pdf',
                'sort_order'       => 3,
            ],
        ];

        foreach ($appels as $appel) {
            AppelOffre::create($appel);
        }
    }
}
