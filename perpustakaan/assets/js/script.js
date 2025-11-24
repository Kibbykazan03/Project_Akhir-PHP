  document.getElementById('formTambah').addEventListener('submit', function(e) {
      const judul = document.getElementById('judul').value;
      if (!judul) {
          alert('Judul wajib diisi!');
          e.preventDefault();
      }
  });
  