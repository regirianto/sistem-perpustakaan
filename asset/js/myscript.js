function previewimage() {
  const gambar = document.querySelector(".gambar-uploud");
  const imgpreview = document.querySelector(".img-preview");
  const ofReader = new FileReader();
  ofReader.readAsDataURL(gambar.files[0]);
  ofReader.onload = function (oFREvent) {
    imgpreview.src = oFREvent.target.result;
  };
}
// const tombolCari = document.querySelector(".tombol-cari");
// const keyword = document.querySelector(".keyword");
// const container = document.querySelector(".container");

// keyword.addEventListener("keyup", function () {
//   const xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       console.log("ok");
//     }
//   };
//   xhr.open("get", "ajax_cari.php");
//   xhr.send();
// });
