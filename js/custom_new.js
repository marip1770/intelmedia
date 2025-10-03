const pageTitle = document.title;
const pageUrl = window.location.href;

// Hindari baris kosong di antara judul dan link
const message = `${pageTitle}\n${pageUrl}`;

document.getElementById("whatsapp-share").href = `https://wa.me/?text=${encodeURIComponent(message)}`;

function copyLink() {
  navigator.clipboard.writeText(message).then(function() {
    const notif = document.getElementById("copy-notification");
    notif.style.display = "inline";

    setTimeout(() => {
      notif.style.display = "none";
    }, 2000);
  }, function(err) {
    alert("Gagal menyalin link: " + err);
  });
}
