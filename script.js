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
