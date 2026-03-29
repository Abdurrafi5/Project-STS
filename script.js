const bencana = [
  {
    id: 1,
    tempat: "Pekanbaru - Jl. Bwa Bwa",
    jenis: "Banjir",
    tanggal: "12 Mei 2026",
    deskripsi:
      "Banjir terjadi akibat curah hujan tinggi yang menyebabkan sungai meluap dan merendam rumah warga.",
  },
  {
    id: 2,
    tempat: "Padang - Jl. Contoh",
    jenis: "Gempa",
    tanggal: "10 Mei 2026",
    deskripsi:
      "Gempa bumi berkekuatan 5.6 SR mengguncang daerah Padang dan menyebabkan beberapa bangunan rusak.",
  },
];

function tampilkanBencana() {
  const container = document.getElementById("bencanaList");
  container.innerHTML = "";
  bencana.forEach((item) => {
    const div = document.createElement("div");
    div.classList.add("bencana-item");
    div.innerHTML = `
        <div class="bencana-info">
          <div><strong>${item.tempat}</strong></div>
          <div>Jenis Bencana: ${item.jenis}</div>
          <div>Tanggal: ${item.tanggal}</div>
        </div>
        <button class="info-btn" onclick="lihatDetail(${item.id})">Info</button>
      `;
    container.appendChild(div);
  });
}

function lihatDetail(id) {
  const item = bencana.find((b) => b.id === id);
  document.getElementById("tempat").innerText = item.tempat;
  document.getElementById("jenis").innerText = item.jenis;
  document.getElementById("tanggal").innerText = item.tanggal;
  document.getElementById("deskripsi").innerText = item.deskripsi;
  document.getElementById("detailBencana").style.display = "block";
  document
    .getElementById("detailBencana")
    .scrollIntoView({ behavior: "smooth" });
}

function donasiBarang() {
  const barang = prompt("Masukkan barang yang ingin didonasikan:");
  if (barang) {
    alert("Terima kasih! Donasi barang berhasil dikirim.");
  }
}
function donasiUang() {
  const uang = prompt("Masukkan nominal donasi:");
  if (uang) {
    alert("Terima kasih! Donasi uang berhasil dikirim.");
  }
}

function scrollToBencana() {
  document.getElementById("bencanaList").scrollIntoView({ behavior: "smooth" });
}

document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const nama = document.getElementById("nama").value.trim();
  const email = document.getElementById("email").value.trim();
  const pesan = document.getElementById("pesan").value.trim();
  if (!nama || !email || !pesan) {
    alert("Mohon isi semua kolom dengan benar.");
    return;
  }
  alert(`Terima kasih, ${nama}! Pesan Anda sudah terkirim.`);
  this.reset();
});

const sliderImages = document.querySelectorAll("#heroSlider img");
let current = 0;
function sliderNext() {
  sliderImages[current].classList.remove("active");
  current = (current + 1) % sliderImages.length;
  sliderImages[current].classList.add("active");
}
setInterval(sliderNext, 4000);

window.onload = () => {
  tampilkanBencana();
};




function shareWhatsApp() {
    const text = encodeURIComponent('Cek website BantuBencana - Informasi bencana terkini dan platform donasi!');
    const url = encodeURIComponent(window.location.href);
    window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
}

function shareFacebook() {
    const url = encodeURIComponent(window.location.href);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
}

function shareTwitter() {
    const text = encodeURIComponent('BantuBencana - Peduli Sesama');
    const url = encodeURIComponent(window.location.href);
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
}


function tampilkanSemuaBencana() {
    const grid = document.getElementById('bencanaGrid');
    if (!grid) return;
    
    grid.innerHTML = '';
    bencana.forEach(item => {
        const card = document.createElement('div');
        card.classList.add('bencana-card');
        card.onclick = () => bukaModal(item);
        card.innerHTML = `
            <h3>${item.tempat}</h3>
            <p><strong>Jenis:</strong> ${item.jenis}</p>
            <p><strong>Tanggal:</strong> ${item.tanggal}</p>
            <div class="card-footer">
                <span>Klik untuk detail</span>
                <i class="fas fa-arrow-right"></i>
            </div>
        `;
        grid.appendChild(card);
    });
}

function bukaModal(item) {
    const modal = document.getElementById('bencanaModal');
    document.getElementById('modalTempat').innerText = item.tempat;
    document.getElementById('modalJenis').innerText = item.jenis;
    document.getElementById('modalTanggal').innerText = item.tanggal;
    document.getElementById('modalDeskripsi').innerText = item.deskripsi;
    modal.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('bencanaModal');
    const closeBtn = document.querySelector('.close');
    
    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }
    }
    
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    

    tampilkanSemuaBencana();
});

function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
}

window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.menu a');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {// ===== FUNGSI UNTUK MODAL DETAIL BENCANA =====
function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Tutup modal kalau klik di luar
window.onclick = function(event) {
    const detailModal = document.getElementById('detailModal');
    if (event.target == detailModal) {
        detailModal.style.display = 'none';
    }
}

// Fungsi donasi
function donasiBarang() {
    const barang = prompt("Masukkan barang yang ingin didonasikan:");
    if (barang) {
        alert("Terima kasih! Donasi barang berhasil dikirim.");
    }
}

function donasiUang() {
    const uang = prompt("Masukkan nominal donasi:");
    if (uang) {
        alert("Terima kasih! Donasi uang berhasil dikirim.");
    }
}

// ===== FUNGSI UNTUK SMOOTH SCROLL =====
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
}

// Update active menu saat scroll
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.menu a');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

// ===== FUNGSI SOCIAL SHARE =====
function shareWhatsApp() {
    const text = encodeURIComponent('Cek website BantuBencana - Informasi bencana terkini dan platform donasi!');
    const url = encodeURIComponent(window.location.href);
    window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
}

function shareFacebook() {
    const url = encodeURIComponent(window.location.href);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
}

function shareTwitter() {
    const text = encodeURIComponent('BantuBencana - Peduli Sesama');
    const url = encodeURIComponent(window.location.href);
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
}

// ===== DATA BENCANA =====
const bencana = [
    {
        id: 1,
        tempat: "Pekanbaru - Jl. Bwa Bwa",
        jenis: "Banjir",
        tanggal: "12 Mei 2026",
        deskripsi: "Banjir terjadi akibat curah hujan tinggi yang menyebabkan sungai meluap dan merendam rumah warga.",
    },
    {
        id: 2,
        tempat: "Padang - Jl. Contoh",
        jenis: "Gempa",
        tanggal: "10 Mei 2026",
        deskripsi: "Gempa bumi berkekuatan 5.6 SR mengguncang daerah Padang dan menyebabkan beberapa bangunan rusak.",
    },
];

// TAMPILKAN BENCANA
function tampilkanBencana() {
    const container = document.getElementById("bencanaList");
    if (!container) return;
    
    container.innerHTML = "";
    bencana.forEach((item) => {
        const card = document.createElement("div");
        card.classList.add("bencana-card");
        card.onclick = () => lihatDetail(item.id);
        card.innerHTML = `
            <h3>${item.tempat}</h3>
            <p><strong>Jenis:</strong> ${item.jenis}</p>
            <p><strong>Tanggal:</strong> ${item.tanggal}</p>
            <div class="card-footer">
                <span>Klik untuk detail</span>
                <i class="fas fa-arrow-right"></i>
            </div>
        `;
        container.appendChild(card);
    });
}

// LIHAT DETAIL BENCANA
function lihatDetail(id) {
    const item = bencana.find((b) => b.id === id);
    if (!item) return;
    
    document.getElementById("modalTempat").innerText = item.tempat;
    document.getElementById("modalJenis").innerText = item.jenis;
    document.getElementById("modalTanggal").innerText = item.tanggal;
    document.getElementById("modalDeskripsi").innerText = item.deskripsi;
    
    const modal = document.getElementById("detailModal");
    if (modal) {
        modal.style.display = "block";
    }
}

// SLIDER HERO
const sliderImages = document.querySelectorAll("#heroSlider img");
let current = 0;
function sliderNext() {
    if (sliderImages.length > 0) {
        sliderImages[current].classList.remove("active");
        current = (current + 1) % sliderImages.length;
        sliderImages[current].classList.add("active");
    }
}
setInterval(sliderNext, 4000);

// CONTACT FORM
const contactForm = document.getElementById("contactForm");
if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const nama = document.getElementById("nama").value.trim();
        const email = document.getElementById("email").value.trim();
        const pesan = document.getElementById("pesan").value.trim();
        
        if (!nama || !email || !pesan) {
            alert("Mohon isi semua kolom dengan benar.");
            return;
        }
        
        alert(`Terima kasih, ${nama}! Pesan Anda sudah terkirim.`);
        this.reset();
    });
}

// RUN ON LOAD
window.onload = () => {
    tampilkanBencana();
};
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});