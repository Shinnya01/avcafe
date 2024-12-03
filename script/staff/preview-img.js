document
.getElementById("choose-image")
.addEventListener("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = document.getElementById("displayImage");
      img.src = e.target.result;
      img.style.display = "block";


    
    };
    reader.readAsDataURL(file);
  }
});