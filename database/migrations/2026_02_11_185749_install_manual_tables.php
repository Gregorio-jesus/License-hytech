<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Usamos DB::unprepared para ejecutar el bloque de SQL convertido a Postgres
        DB::unprepared("
            CREATE TABLE IF NOT EXISTS users (
                id SERIAL PRIMARY KEY,
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL UNIQUE,
                email_verified_at timestamp NULL,
                password varchar(255) NOT NULL,
                two_factor_secret text,
                two_factor_recovery_codes text,
                two_factor_confirmed_at timestamp NULL,
                remember_token varchar(100),
                created_at timestamp NULL,
                updated_at timestamp NULL
            );

            INSERT INTO users (id, name, email, password, created_at, updated_at) 
            VALUES (1, 'Administrador Licencias', 'HyTech.SaaS@gmail.com', '$2y$12$Zq45NS.GilEXjnL/zvhGou8n0.F5wyyNHh1PrvnW2XdI6hW.2A4BW', NOW(), NOW())
            ON CONFLICT (email) DO NOTHING;

            CREATE TABLE IF NOT EXISTS services (
                id SERIAL PRIMARY KEY,
                name varchar(255) NOT NULL,
                description text,
                created_at timestamp NULL,
                updated_at timestamp NULL
            );

            INSERT INTO services (id, name, description, created_at, updated_at) VALUES
            (1, 'Gym Syfit', 'Software administrativo para Gimnasios', NOW(), NOW()),
            (2, 'DelishOps', 'Software administrativo para Restaurantes', NOW(), NOW()),
            (3, 'Auto Lavado', 'Software administrativo para Car Wash', NOW(), NOW())
            ON CONFLICT DO NOTHING;

            CREATE TABLE IF NOT EXISTS gym_clients (
                id SERIAL PRIMARY KEY,
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL UNIQUE,
                gym_name varchar(255) NOT NULL,
                phone varchar(255) NOT NULL,
                created_at timestamp NULL,
                updated_at timestamp NULL
            );

            CREATE TABLE IF NOT EXISTS licenses (
                id SERIAL PRIMARY KEY,
                gym_client_id bigint NOT NULL REFERENCES gym_clients(id) ON DELETE CASCADE,
                service_id bigint NOT NULL REFERENCES services(id) ON DELETE CASCADE,
                license_key varchar(255) NOT NULL UNIQUE,
                device_limit int NOT NULL DEFAULT 1,
                hardware_id varchar(255) DEFAULT NULL,
                start_date date NOT NULL,
                expiration_date date NOT NULL,
                last_check_in timestamp NULL,
                status varchar(20) NOT NULL DEFAULT 'active',
                is_trial boolean NOT NULL DEFAULT false,
                created_at timestamp NULL,
                updated_at timestamp NULL
            );
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TABLE IF EXISTS licenses, gym_clients, services, users CASCADE;");
    }
};