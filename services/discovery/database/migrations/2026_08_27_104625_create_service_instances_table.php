<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_instances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('service_name');
            $table->string('host');
            $table->unsignedInteger('port');
            $table->string('protocol');

            $table->string('status');

            $table->timestamp('last_heartbeat_at')->nullable();

            $table->timestamps();

            $table->index('service_name');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_instances');
    }
};