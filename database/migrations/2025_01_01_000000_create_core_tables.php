<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('np', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
        });
        Schema::create('telepules', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->foreignId('npid')->constrained('np')->cascadeOnDelete();
            $table->index('npid','idx_telepules_npid');
        });
        Schema::create('ut', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->float('hossz')->nullable();
            $table->integer('allomas')->nullable();
            $table->float('ido')->nullable();
            $table->boolean('vezetes')->default(false);
            $table->foreignId('telepulesid')->constrained('telepules')->cascadeOnDelete();
            $table->index('telepulesid','idx_ut_telepulesid');
        });
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->timestamp('created_at')->useCurrent();
        });
        // users táblát a Laravel hozza létre a default migrációival – kiegészítjük role mezővel
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users','role')) {
                $table->string('role')->default('registered');
            }
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users','role')) {
                $table->dropColumn('role');
            }
        });
        Schema::dropIfExists('messages');
        Schema::dropIfExists('ut');
        Schema::dropIfExists('telepules');
        Schema::dropIfExists('np');
    }
};
