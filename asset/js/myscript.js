function previewimage() {
  const gambar = document.querySelector(".gambar-uploud");
  const imgpreview = document.querySelector(".img-preview");
  const ofReader = new FileReader();
  ofReader.readAsDataURL(gambar.files[0]);
  ofReader.onload = function (oFREvent) {
    imgpreview.src = oFREvent.target.result;
  };
}
