-- Query 1: Pencarian & filter lowongan
SELECT l.*, p.nama_perusahaan
FROM lowongan l
JOIN perusahaan p ON p.id_perusahaan = l.id_perusahaan
WHERE l.status = 'aktif'
AND (l.judul_posisi LIKE CONCAT('%', :kata_kunci, '%') OR l.lokasi LIKE CONCAT('%', :kata_kunci, '%'))
AND (:bidang IS NULL OR l.bidang = :bidang);

-- Query 2: Daftar pelamar pada satu lowongan
SELECT a.id_lamaran, a.status, a.dikirim_pada, u.nama, u.email, pp.no_telepon
FROM lamaran a
JOIN profil_pencari_kerja pp ON pp.id_profil = a.id_profil
JOIN users u ON u.id_user = pp.id_user
WHERE a.id_lowongan = :id_lowongan
ORDER BY a.dikirim_pada DESC;

-- Query 3: Mengubah status lamaran (Diterima/Ditolak)
UPDATE lamaran SET status = :status_baru WHERE id_lamaran = :id_lamaran;

-- Query 4: Riwayat lamaran milik satu pencari kerja (Application Tracker)
SELECT a.id_lamaran, lo.judul_posisi, pr.nama_perusahaan, a.status, a.dikirim_pada
FROM lamaran a
JOIN lowongan lo ON lo.id_lowongan = a.id_lowongan
JOIN perusahaan pr ON pr.id_perusahaan = lo.id_perusahaan
WHERE a.id_profil = :id_profil
ORDER BY a.dikirim_pada DESC;