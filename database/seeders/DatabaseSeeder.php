<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Journal;
use App\Models\Evaluation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign keys to safely truncate and delete existing records
        Schema::disableForeignKeyConstraints();
        
        // Delete only intern users, preserving any existing admin users
        User::where('role', 'intern')->delete();
        
        // Truncate other tables to get fresh seed data
        Attendance::truncate();
        Journal::truncate();
        Evaluation::truncate();
        
        Schema::enableForeignKeyConstraints();

        // 1. Seed Administrator ONLY if it does not already exist
        // This ensures the admin user is NOT modified or reset if it is already present.
        $adminExists = User::where('role', 'admin')->exists();
        if (!$adminExists) {
            User::create([
                'name' => 'Administrator Dinas Sosial',
                'email' => 'admin@dinsos.lamongankab.go.id',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 'approved',
                'email_verified_at' => now(),
            ]);
        }

        // 2. Data Intern Candidates (Universities & Schools)
        $schools = [
            'Universitas Airlangga (UNAIR)',
            'Institut Teknologi Sepuluh Nopember (ITS)',
            'Universitas Brawijaya (UB)',
            'Universitas Gadjah Mada (UGM)',
            'Universitas Islam Lamongan (UNISLA)',
            'Universitas Muhammadiyah Lamongan (UMLA)',
            'SMKN 1 Lamongan',
            'SMKN 2 Lamongan'
        ];

        $internsData = [
            // Status: APPROVED (Active Interns)
            [
                'name' => 'Alexandra Deff',
                'email' => 'alexandra@student.unair.ac.id',
                'nim' => '082111633041',
                'school' => $schools[0], // UNAIR
                'major' => 'Sistem Informasi',
                'status' => 'approved',
            ],
            [
                'name' => 'Edwin Adenike',
                'email' => 'edwin@student.its.ac.id',
                'nim' => '5025211024',
                'school' => $schools[1], // ITS
                'major' => 'Teknik Informatika',
                'status' => 'approved',
            ],
            [
                'name' => 'David Oshodi',
                'email' => 'david@student.ugm.ac.id',
                'nim' => '21/473829/TK/52110',
                'school' => $schools[3], // UGM
                'major' => 'Teknik Elektro',
                'status' => 'approved',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@unisla.ac.id',
                'nim' => '0412210082',
                'school' => $schools[4], // UNISLA
                'major' => 'Manajemen Informatika',
                'status' => 'approved',
            ],

            // Status: PENDING (New Applicants)
            [
                'name' => 'Isaac Oluwatemilorun',
                'email' => 'isaac@student.ub.ac.id',
                'nim' => '215060700111029',
                'school' => $schools[2], // UB
                'major' => 'Kesejahteraan Sosial',
                'status' => 'pending',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'fauzi@umla.ac.id',
                'nim' => '2212009831',
                'school' => $schools[5], // UMLA
                'major' => 'Administrasi Negara',
                'status' => 'pending',
            ],
            [
                'name' => 'Rini Astuti',
                'email' => 'rini@smkn1lmg.sch.id',
                'nim' => '9908311234',
                'school' => $schools[6], // SMKN 1 Lamongan
                'major' => 'RPL (Rekayasa Perangkat Lunak)',
                'status' => 'pending',
            ],

            // Status: REJECTED (Unfit qualifications / Full capacity)
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'nim' => '22051204091',
                'school' => $schools[4], // UNISLA
                'major' => 'Teknik Sipil',
                'status' => 'rejected',
            ],
            [
                'name' => 'Lani Marlina',
                'email' => 'lani@smkn2lmg.sch.id',
                'nim' => '9906129843',
                'school' => $schools[7], // SMKN 2 Lamongan
                'major' => 'Multi Media',
                'status' => 'rejected',
            ],

            // Status: FINISHED (Alumni / Completed internship)
            [
                'name' => 'Totok Michael',
                'email' => 'totok.michael@student.its.ac.id',
                'nim' => '5025201088',
                'school' => $schools[1], // ITS
                'major' => 'Sistem Informasi',
                'status' => 'finished',
            ],
            [
                'name' => 'Mega Utami',
                'email' => 'mega@student.unair.ac.id',
                'nim' => '082011633008',
                'school' => $schools[0], // UNAIR
                'major' => 'Kesejahteraan Sosial',
                'status' => 'finished',
            ],
            [
                'name' => 'Rian Hidayat',
                'email' => 'rian@student.ub.ac.id',
                'nim' => '205060700111002',
                'school' => $schools[2], // UB
                'major' => 'Ilmu Pemerintahan',
                'status' => 'finished',
            ],
        ];

        $seededInterns = [];

        foreach ($internsData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('password'),
                'role' => 'intern',
                'nim' => $data['nim'],
                'school' => $data['school'],
                'major' => $data['major'] ?? 'Sistem Informasi',
                'status' => $data['status'],
                'proposal_path' => 'proposals/sample_proposal.pdf',
                'photo_path' => null,
                'email_verified_at' => now(),
            ]);

            if ($data['status'] === 'approved' || $data['status'] === 'finished') {
                $seededInterns[] = $user;
            }
        }

        // 3. Daily Attendance & Journal Entries (Last 10 Working Days)
        $journalsList = [
            'Orientasi program magang, pengenalan mentor lapangan dan struktur organisasi Dinas Sosial Lamongan.',
            'Mempelajari alur birokrasi pelayanan kesejahteraan sosial dan tata kelola administrasi surat masuk.',
            'Membantu proses verifikasi berkas pendaftar Program Keluarga Harapan (PKH) tingkat kecamatan.',
            'Melakukan entri data PMKS (Penyandang Masalah Kesejahteraan Sosial) Lamongan ke basis data spreadsheet.',
            'Mendampingi survei lapangan penyaluran bantuan sosial sembako kepada keluarga rentan di Kelurahan Jetis.',
            'Menyusun kerangka alur sistem informasi manajemen magang (SIMASOS) bersama tim IT Dinsos Lamongan.',
            'Koding dasar antarmuka pengguna halaman registrasi dan formulir pengunggahan proposal magang.',
            'Membantu pengarsipan dokumen surat keputusan (SK) program pemberdayaan disabilitas Dinas Sosial.',
            'Diskusi rutin mingguan bersama mentor lapangan mengenai laporan progres magang masing-masing bidang.',
            'Membantu penyusunan draf laporan bulanan realisasi anggaran bantuan sosial Dinsos Lamongan.'
        ];

        // We seed for the last 14 calendar days (excluding weekends) to get roughly 10 working days
        $today = Carbon::today('Asia/Jakarta');
        $workingDaysCount = 0;
        $calendarDay = clone $today;
        $calendarDay->subDays(14);

        $workingDates = [];
        while ($calendarDay->lte($today)) {
            if (!$calendarDay->isWeekend()) {
                $workingDates[] = clone $calendarDay;
            }
            $calendarDay->addDay();
        }

        foreach ($seededInterns as $intern) {
            foreach ($workingDates as $index => $date) {
                // Determine attendance status randomly with 90% attendance rate
                $rand = rand(1, 10);
                if ($rand <= 8) {
                    $status = 'hadir';
                    $checkIn = Carbon::parse($date->format('Y-m-d') . ' 07:' . str_pad(rand(30, 55), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(10, 59), 2, '0', STR_PAD_LEFT));
                    $checkOut = Carbon::parse($date->format('Y-m-d') . ' 16:' . str_pad(rand(0, 15), 2, '0', STR_PAD_LEFT) . ':' . str_pad(rand(10, 59), 2, '0', STR_PAD_LEFT));
                    $ket = null;
                } elseif ($rand == 9) {
                    $status = 'sakit';
                    $checkIn = null;
                    $checkOut = null;
                    $ket = 'Mengalami demam tinggi dan flu, beristirahat sesuai anjuran dokter.';
                } else {
                    $status = 'izin';
                    $checkIn = null;
                    $checkOut = null;
                    $ket = 'Menghadiri agenda ujian praktikum mata kuliah di kampus asal.';
                }

                // Create attendance entry
                Attendance::create([
                    'user_id' => $intern->id,
                    'date' => $date->format('Y-m-d'),
                    'check_in_time' => $checkIn ? $checkIn->format('H:i:s') : null,
                    'check_out_time' => $checkOut ? $checkOut->format('H:i:s') : null,
                    'status' => $status,
                    'keterangan' => $ket,
                    'keterangan_file' => ($status !== 'hadir') ? 'sakit_izin/sample_docs.pdf' : null,
                ]);

                // Create journal entry if present
                if ($status === 'hadir') {
                    $journalIndex = $index % count($journalsList);
                    Journal::create([
                        'user_id' => $intern->id,
                        'date' => $date->format('Y-m-d'),
                        'activity' => $journalsList[$journalIndex],
                        'photo_path' => 'journals/activity_' . rand(1, 4) . '.jpg',
                    ]);
                }
            }
        }

        // 4. Mentor Evaluations for FINISHED Interns (Alumni)
        $evaluationsData = [
            // Totok Michael
            [
                'email' => 'totok.michael@student.its.ac.id',
                'grades' => [92, 90, 94, 91, 93, 90, 95], // Avg: ~92.14
                'comments' => 'Totok menunjukkan kapabilitas teknis pemrograman yang luar biasa dan dedikasi penuh selama membantu tim IT menyusun aplikasi SIMASOS.',
            ],
            // Mega Utami
            [
                'email' => 'mega@student.unair.ac.id',
                'grades' => [88, 89, 90, 86, 89, 91, 88], // Avg: ~88.71
                'comments' => 'Mega sangat berinisiatif, komunikatif, dan terampil dalam mengelola data administrasi bantuan sosial terpadu di Dinas Sosial.',
            ],
            // Rian Hidayat
            [
                'email' => 'rian@student.ub.ac.id',
                'grades' => [85, 86, 82, 85, 87, 84, 86], // Avg: ~85.00
                'comments' => 'Rian beradaptasi dengan sangat baik di lingkungan kantor dan selalu menyelesaikan tugas inventarisasi arsip dengan rapi.',
            ]
        ];

        foreach ($evaluationsData as $eval) {
            $user = User::where('email', $eval['email'])->first();
            if ($user) {
                $grades = $eval['grades'];
                $avg = array_sum($grades) / count($grades);
                
                // Determine predicate based on average grade
                if ($avg >= 90) {
                    $predicate = 'Sangat Baik';
                } elseif ($avg >= 80) {
                    $predicate = 'Baik';
                } elseif ($avg >= 70) {
                    $predicate = 'Cukup';
                } else {
                    $predicate = 'Kurang';
                }

                Evaluation::create([
                    'user_id' => $user->id,
                    'kedisiplinan' => $grades[0],
                    'tanggung_jawab' => $grades[1],
                    'kerja_sama' => $grades[2],
                    'kreativitas' => $grades[3],
                    'kemampuan_beradaptasi' => $grades[4],
                    'kualitas_hasil_kerja' => $grades[5],
                    'penyusunan_laporan' => $grades[6],
                    'average' => round($avg, 2),
                    'predicate' => $predicate,
                    'comments' => $eval['comments'],
                    'finished_at' => Carbon::today('Asia/Jakarta')->subDays(2)->format('Y-m-d'),
                ]);
            }
        }
    }
}
