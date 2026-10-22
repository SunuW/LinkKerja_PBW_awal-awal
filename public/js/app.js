// Validasi ekstensi file di sisi klien sebelum dikirim ke server
// (validasi utama tetap dilakukan Laravel lewat rule "mimes:pdf,jpg,jpeg" pada Controller)
document.querySelectorAll('input[type="file"][accept]').forEach((input) => {
  input.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const ext = file.name.split('.').pop().toLowerCase();
    const diizinkan = this.accept.replace(/\./g, '').split(',');
    if (!diizinkan.includes(ext)) {
      alert('Unggah file dalam bentuk PDF atau JPG.');
      this.value = '';
    }
  });
});
