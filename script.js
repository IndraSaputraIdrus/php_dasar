const del = document.querySelector("#del");
if (del != null) {
  del.addEventListener("click", function () {
    return confirm("yakin?");
  });
}

// seacrh
const tombolCari = document.querySelector(".tombol-cari");
const keyword = document.querySelector(".keyword");
const container = document.querySelector(".container");

if ((tombolCari != null) & (keyword != null) & (container != null)) {
  tombolCari.style.display = "none";
  keyword.addEventListener("keyup", function () {
    // ajax
    // xmlhttprequest
    // const xhr = new XMLHttpRequest();

    // xhr.onreadystatechange = function(){
    //    if(xhr.readyState == 4 && xhr.status == 200){
    //       container.innerHTML = xhr.responseText;
    //    };
    // }
    // xhr.open('get', 'ajax/ajax_cari.php?keyword=' + keyword.value);
    // xhr.send();

    // fetch()
    fetch("ajax/ajax_cari.php?keyword=" + keyword.value)
      .then((response) => response.text())
      .then((response) => (container.innerHTML = response));
  });
}

// preview image

const img = document.querySelector(".gambar");

if (img != null) {
  img.addEventListener("change", function () {
    const imgPreview = document.querySelector(".img-preview");
    const oFReader = new FileReader();
    oFReader.readAsDataURL(img.files[0]);

    oFReader.onload = function (oFREvent) {
      imgPreview.src = oFREvent.target.result;
    };
  });
}
