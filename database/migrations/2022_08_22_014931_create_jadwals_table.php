<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\supir;
use App\Models\mobil;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->datetime('berangkat')->nullable();
            $table->datetime('pulang')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('bidang')->nullable();
            $table->text('status');
            $table->foreignIdFor(supir::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(mobil::class)->constrained()->cascadeOnDelete();
            
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
