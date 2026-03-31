function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: "smooth" });
    }
}

function shareWhatsApp() {
    const text = encodeURIComponent("Cek website BantuBencana - Informasi bencana terkini dan platform donasi!");
    const url = encodeURIComponent(window.location.href);
    window.open(`https://wa.me/?text=${text}%20${url}`, "_blank");
}

function shareFacebook() {
    const url = encodeURIComponent(window.location.href);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, "_blank");
}

function shareTwitter() {
    const text = encodeURIComponent("BantuBencana - Peduli Sesama");
    const url = encodeURIComponent(window.location.href);
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, "_blank");
}

function initHeroSlider() {
    const sliderImages = document.querySelectorAll("#heroSlider img");
    let current = 0;

    if (sliderImages.length > 0) {
        setInterval(() => {
            sliderImages[current].classList.remove("active");
            current = (current + 1) % sliderImages.length;
            sliderImages[current].classList.add("active");
        }, 4000);
    }
}

function initNavHighlight() {
    window.addEventListener("scroll", () => {
        const sections = document.querySelectorAll("section");
        const navLinks = document.querySelectorAll(".menu a");
        let current = "";

        sections.forEach((section) => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.clientHeight;
            if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionTop + sectionHeight) {
                current = section.getAttribute("id");
            }
        });

        navLinks.forEach((link) => {
            link.classList.remove("active");
            if (link.getAttribute("href") === `#${current}`) {
                link.classList.add("active");
            }
        });
    });
}

window.addEventListener("DOMContentLoaded", () => {
    initHeroSlider();
    initNavHighlight();

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

    const themeToggle = document.getElementById("themeToggle");
    if (themeToggle) {
        function applyTheme(theme) {
            const isDark = theme === "dark";
            document.body.classList.toggle("dark-mode", isDark);
            themeToggle.textContent = isDark ? "☀︎" : "⏾";
            localStorage.setItem("theme", theme);
        }

        const savedTheme = localStorage.getItem("theme");
        if (savedTheme) {
            applyTheme(savedTheme);
        } else {
            const preferDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
            applyTheme(preferDark ? "dark" : "light");
        }

        themeToggle.addEventListener("click", () => {
            const activeTheme = document.body.classList.contains("dark-mode") ? "dark" : "light";
            applyTheme(activeTheme === "dark" ? "light" : "dark");
        });
    }
});