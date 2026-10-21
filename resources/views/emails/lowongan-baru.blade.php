<div style="font-family: Arial, sans-serif; max-width: 560px; margin: 0 auto; color: #101324;">
    <div style="background: linear-gradient(120deg, #00c8ff, #5000ff); padding: 20px 24px; border-radius: 12px 12px 0 0;">
        <h2 style="margin: 0; color: #ffffff;">LinkKerja</h2>
    </div>
    <div style="border: 1px solid #e3e7f0; border-top: none; padding: 24px; border-radius: 0 0 12px 12px;">
        <p>Halo {{ $penerima->name }},</p>
        <p>Ada lowongan baru yang cocok dengan pencarian Anda:</p>
 
        <h3 style="margin-bottom: 4px;">{{ $lowongan->judul_posisi }}</h3>
        <p style="margin-top: 0; color: #545a72;">
            {{ $lowongan->perusahaan->nama_perusahaan }} · {{ $lowongan->lokasi }} · {{ $lowongan->bidang }}
        </p>
        <p>{{ $lowongan->deskripsi }}</p>
 
        <p>
            <a href="{{ route('pencari.detail', $lowongan) }}"
               style="background: #5000ff; color: #ffffff; padding: 10px 18px; border-radius: 8px; text-decoration: none;">
                Lihat lowongan
            </a>
        </p>
        <p style="font-size: 12px; color: #545a72;">Email ini dikirim karena Anda pernah mencari lowongan serupa di LinkKerja.</p>
    </div>
</div>
