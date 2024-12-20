<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabla Categorias
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Tabla Usuarios
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 100)->unique();
            $table->string('telefono', 15)->nullable();
            $table->timestamp('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        // Tabla Libros
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->string('isbn', 13)->unique()->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->timestamps();
        });

        // Tabla Autores
        Schema::create('autores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('nacionalidad', 50)->nullable();
            $table->timestamps();
        });

        // Tabla Libros_Autores (Relación muchos a muchos)
        Schema::create('libros_autores', function (Blueprint $table) {
            $table->foreignId('libro_id')->constrained('libros')->onDelete('cascade');
            $table->foreignId('autor_id')->constrained('autores')->onDelete('cascade');
            $table->primary(['libro_id', 'autor_id']);
        });

        // Tabla Editoriales
        Schema::create('editoriales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->string('pais', 50)->nullable();
            $table->timestamps();
        });

        // Tabla Libros_Editoriales (Relación uno a muchos)
        Schema::create('libros_editoriales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('libro_id')->constrained('libros');
            $table->foreignId('editorial_id')->constrained('editoriales');
            $table->timestamps();
        });

        // Tabla EstadosPrestamo
        Schema::create('estados_prestamo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->timestamps();
        });

        // Tabla Prestamos
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->timestamp('fecha_prestamo')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('fecha_devolucion')->nullable();
            $table->foreignId('estado_id')->constrained('estados_prestamo');
            $table->timestamps();
        });

        // Tabla DetallePrestamos
        Schema::create('detalle_prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id')->constrained('prestamos');
            $table->foreignId('libro_id')->constrained('libros');
            $table->integer('cantidad');
            $table->date('fecha_devolucion_real')->nullable();
            $table->timestamps();
        });

        // Tabla Reservas
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('libro_id')->constrained('libros');
            $table->timestamp('fecha_reserva')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('estado', 50)->default('Activa');
            $table->timestamps();
        });

        // Tabla Likes (Relación Polimórfica)
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->integer('likeable_id');
            $table->string('likeable_type');
            $table->timestamp('fecha_like')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        // Tabla Comentarios (Relación Polimórfica)
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->integer('comentable_id');
            $table->string('comentable_type');
            $table->timestamp('fecha_comentario')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        // Tabla Archivos (Relación Polimórfica)
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_archivo');
            $table->string('ruta_archivo');
            $table->integer('archivoable_id');
            $table->string('archivoable_type');
            $table->timestamp('fecha_subida')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        // Tabla Sanciones
        Schema::create('sanciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->string('motivo');
            $table->decimal('monto', 10, 2);
            $table->timestamp('fecha_sancion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        // Tabla HistorialLectura
        Schema::create('historial_lectura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('libro_id')->constrained('libros');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_lectura');
        Schema::dropIfExists('sanciones');
        Schema::dropIfExists('archivos');
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('reservas');
        Schema::dropIfExists('detalle_prestamos');
        Schema::dropIfExists('prestamos');
        Schema::dropIfExists('estados_prestamo');
        Schema::dropIfExists('libros_editoriales');
        Schema::dropIfExists('editoriales');
        Schema::dropIfExists('libros_autores');
        Schema::dropIfExists('autores');
        Schema::dropIfExists('libros');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('categorias');
    }
};
