document.addEventListener("DOMContentLoaded", function () {
  const pageTitle = document.title;
  const pageUrl = window.location.href;
  const message = `${pageTitle}\n${pageUrl}`;

  const whatsappBtn = document.getElementById("whatsapp-share");
  const notif = document.getElementById("copy-notification");

  if (whatsappBtn) {
    whatsappBtn.href = `https://wa.me/?text=${encodeURIComponent(message)}`;
  }

  window.copyLink = function () {
    navigator.clipboard.writeText(message).then(
      function () {
        notif.style.display = "block";
        setTimeout(() => (notif.style.opacity = "1"), 10);

        setTimeout(() => {
          notif.style.opacity = "0";
          setTimeout(() => {
            notif.style.display = "none";
          }, 500);
        }, 2000);
      },
      function (err) {
        alert("Gagal menyalin link: " + err);
      }
    );
  };
});
