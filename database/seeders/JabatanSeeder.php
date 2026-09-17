<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Parent / Kepala
        |--------------------------------------------------------------------------
        */

        $kasubbagtu = Jabatan::updateOrCreate(
            ['kode' => 'kasubbagtu'],
            [
                'nama' => 'Kasubbag Tata Usaha',
                'parent_id' => null,
                'kelompok' => 1,
            ]
        );

        $kasisp = Jabatan::updateOrCreate(
            ['kode' => 'kasisp'],
            [
                'nama' => 'Kasi Survey dn Pemetaan',
                'parent_id' => null,
                'kelompok' => 2,
            ]
        );

        $kasiphp = Jabatan::updateOrCreate(
            ['kode' => 'kasiphp'],
            [
                'nama' => 'Kasi Penetapan Hak dan Pendaftaran',
                'parent_id' => null,
                'kelompok' => 3,
            ]
        );

        $kasipp = Jabatan::updateOrCreate(
            ['kode' => 'kasipp'],
            [
                'nama' => 'Kasi Penataan dan Pemberdayaan',
                'parent_id' => null,
                'kelompok' => 4,
            ]
        );

        $kasiptp = Jabatan::updateOrCreate(
            ['kode' => 'kasiptp'],
            [
                'nama' => 'Kasi Pengadaan Tanah',
                'parent_id' => null,
                'kelompok' => 5,
            ]
        );

        $kasipps = Jabatan::updateOrCreate(
            ['kode' => 'kasipps'],
            [
                'nama' => 'Kasi Pengendalian dan Penanganan Sengketa',
                'parent_id' => null,
                'kelompok' => 6,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Kelompok 1
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(
            ['kode' => 'kksuk'],
            [
                'nama' => 'KKS Umum dan Kepegawaian',
                'parent_id' => $kasubbagtu->id,
                'kelompok' => 1,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kkspep'],
            [
                'nama' => 'KKS Perencanaan Evaluasi dan Pelaporan',
                'parent_id' => $kasubbagtu->id,
                'kelompok' => 1,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kksbmn'],
            [
                'nama' => 'KKS Keuangan dan BMN',
                'parent_id' => $kasubbagtu->id,
                'kelompok' => 1,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Kelompok 2
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(
            ['kode' => 'kkspdt'],
            [
                'nama' => 'KKS Survey dan Pemetaan Dasar dan Tematik',
                'parent_id' => $kasisp->id,
                'kelompok' => 2,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kksudpk'],
            [
                'nama' => 'KKS Pengukuran dan Pemetaan Kadastral',
                'parent_id' => $kasisp->id,
                'kelompok' => 2,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Kelompok 3
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(
            ['kode' => 'kksphdr'],
            [
                'nama' => 'KKS Penetapan Hak dan Ruang',
                'parent_id' => $kasiphp->id,
                'kelompok' => 3,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kksphrtk'],
            [
                'nama' => 'KKS Pendaftaran Tanah dan Ruang',
                'parent_id' => $kasiphp->id,
                'kelompok' => 3,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kkshtppat'],
            [
                'nama' => 'KKS Pemeliharaan Tanah dan Ruang',
                'parent_id' => $kasiphp->id,
                'kelompok' => 3,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kksptp'],
            [
                'nama' => 'KKS Penetapan dan Pengelolaan Tanah Pemerintah',
                'parent_id' => $kasiphp->id,
                'kelompok' => 3,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Kelompok 4
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(
            ['kode' => 'kkspt'],
            [
                'nama' => 'KKS Penatagunaan Tanah',
                'parent_id' => $kasipp->id,
                'kelompok' => 4,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kkslptm'],
            [
                'nama' => 'KKS Landreform',
                'parent_id' => $kasipp->id,
                'kelompok' => 4,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Kelompok 5
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(
            ['kode' => 'kkskot'],
            [
                'nama' => 'KKS Konsolidasi Tanah',
                'parent_id' => $kasiptp->id,
                'kelompok' => 5,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kkspppt'],
            [
                'nama' => 'KKS Pengadaan dan Pencadangan Tanah',
                'parent_id' => $kasiptp->id,
                'kelompok' => 5,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Kelompok 6
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(
            ['kode' => 'kkspskpp'],
            [
                'nama' => 'KKS Penanganan Sengketa',
                'parent_id' => $kasipps->id,
                'kelompok' => 6,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kks pnt'],
            [
                'nama' => 'KKS Pengendalian Tanah',
                'parent_id' => $kasipps->id,
                'kelompok' => 6,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Administrator, Kepala Kantor, dan Petugas Arsip
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(
            ['kode' => 'administrator'],
            [
                'nama' => 'Administrator',
                'parent_id' => null,
                'kelompok' => null,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'kakaantah'],
            [
                'nama' => 'Kepala Kantor Pertanahan',
                'parent_id' => null,
                'kelompok' => null,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'petugassu'],
            [
                'nama' => 'Petugas SU',
                'parent_id' => null,
                'kelompok' => null,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'petugasbt'],
            [
                'nama' => 'Petugas BT',
                'parent_id' => null,
                'kelompok' => null,
            ]
        );

        Jabatan::updateOrCreate(
            ['kode' => 'petugaswarkah'],
            [
                'nama' => 'Petugas Warkah',
                'parent_id' => null,
                'kelompok' => null,
            ]
        );
    }
}