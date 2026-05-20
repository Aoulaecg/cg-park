<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // City slug used to group parkings under a city.
        DB::table('parkings')
            ->where('city_slug', 'ElHoceima')
            ->update(['city_slug' => 'alhoceima']);

        // Per-parking slug, name and location derived from the old city name.
        // The numeric suffix on the slug is seeder-generated, so match the stem.
        foreach (DB::table('parkings')->where('slug', 'like', 'aquapark-elhoceima-%')->get() as $parking) {
            DB::table('parkings')
                ->where('id', $parking->id)
                ->update([
                    'slug'     => str_replace('aquapark-elhoceima-', 'aquapark-alhoceima-', $parking->slug),
                    'name'     => 'Aquapark Al hoceïma',
                    'location' => 'Al hoceïma, Aquapark',
                    'address'  => 'Al hoceïma, Aquapark',
                ]);
        }
    }

    public function down(): void
    {
        DB::table('parkings')
            ->where('city_slug', 'alhoceima')
            ->update(['city_slug' => 'ElHoceima']);

        foreach (DB::table('parkings')->where('slug', 'like', 'aquapark-alhoceima-%')->get() as $parking) {
            DB::table('parkings')
                ->where('id', $parking->id)
                ->update([
                    'slug'     => str_replace('aquapark-alhoceima-', 'aquapark-elhoceima-', $parking->slug),
                    'name'     => 'Aquapark ElHoceima',
                    'location' => 'ELHoceima, Aquapark',
                    'address'  => 'ELHoceima, Aquapark',
                ]);
        }
    }
};
