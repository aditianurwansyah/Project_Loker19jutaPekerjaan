// Data dummy perusahaan
const companies = [
  { id: 1, name: "PT Teknologi Maju", desc: "Perusahaan IT berbasis cloud dan AI.", address: "Jl. Teknologi No. 10, Jakarta" },
  { id: 2, name: "CV Logistik Nusantara", desc: "Jasa pengiriman ekspres nasional.", address: "Jl. Logistik Raya No. 5, Surabaya" },
  { id: 3, name: "UD Agro Sejahtera", desc: "Pertanian organik dan distribusi pangan.", address: "Jl. Tani Subur No. 8, Bandung" }
];

// Halaman Detail
if (window.location.pathname.endsWith('detail.html')) {
  const urlParams = new URLSearchParams(window.location.search);
  const id = parseInt(urlParams.get('id'));
  const detailContent = document.getElementById('detail-content');

  if (!id || !companies.find(c => c.id === id)) {
    detailContent.innerHTML = `
      <div class="alert alert-warning">
        <h4>⚠️ Perusahaan Tidak Ditemukan</h4>
        <p>Silakan pilih perusahaan dari <a href="index.html">halaman utama</a>.</p>
      </div>
    `;
  } else {
    const company = companies.find(c => c.id === id);
    detailContent.innerHTML = `
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h2>${company.name}</h2>
        </div>
        <div class="card-body">
          <p><strong>Deskripsi:</strong> ${company.desc}</p>
          <p><strong>Alamat:</strong> ${company.address}</p>
        </div>
      </div>
    `;
  }
}

// Form Login
if (document.getElementById('loginForm')) {
  document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Simulasi user valid
    if (username === "admin" && password === "123456") {
      localStorage.setItem('isLoggedIn', 'true');
      localStorage.setItem('username', username);
      alert('Login berhasil!');
      window.location.href = 'menu.html';
    } else {
      alert('❌ Username atau password salah!');
    }
  });
}

// Form Register
if (document.getElementById('registerForm')) {
  document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const password = document.getElementById('regPassword').value;
    const confirm = document.getElementById('confirmPassword').value;

    if (password !== confirm) {
      alert('❌ Password dan konfirmasi tidak sama!');
      return;
    }

    // Simpan ke localStorage (simulasi)
    const username = document.getElementById('regUsername').value;
    localStorage.setItem('registeredUser', JSON.stringify({
      name: document.getElementById('name').value,
      email: document.getElementById('email').value,
      username: username
    }));

    alert(`✅ Registrasi berhasil!\nSilakan login dengan username: ${username}`);
    window.location.href = 'login.html';
  });
} 