<?php

namespace Database\Factories;

use App\Models\Facture;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Facture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "montant"=>$this->faker->randomNumber(),
            "dateDebut"=>$this->faker->date(),
            "dateFin"=>$this->faker->date(),
            "etat"=>rand(0,1),
            "structure_id"=>rand(1,6),
            "fournisseur_id"=> rand(1,5)
        ];
    }
}
