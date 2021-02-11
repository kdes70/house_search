<?php

use App\Models\House\House;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /** @var string */
    private $table;

    /**
     * CreateFeedsTable constructor.
     */
    public function __construct()
    {
        $this->table = House::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->index();
            $table->unsignedInteger('price')->index();
            $table->unsignedTinyInteger('bedrooms')->index();
            $table->unsignedTinyInteger('bathrooms')->index();
            $table->unsignedTinyInteger('storeys')->index();
            $table->unsignedTinyInteger('garages')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
