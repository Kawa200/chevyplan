<?php

use App\Models\DocType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });

        $datos_iniciales = [
            [ 'code' => 'CC', 'name' => 'Cédula de ciudadanía' ],
            [ 'code' => 'CE', 'name' => 'Cédula de extranjería' ],
            [ 'code' => 'NIT', 'name' => 'NIT' ],
            [ 'code' => 'PS', 'name' => 'Pasaporte' ],
        ];

        foreach ($datos_iniciales as $tipo) {
            DocType::create($tipo);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_types');
    }
}
