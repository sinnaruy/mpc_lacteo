function principal(){

    document.addEventListener("DOMContentLoaded", function () {
        const corralLink = document.getElementById("corralLink");
        const corralContainer = document.getElementById("corralContainer");
        const overlay = document.getElementById("overlay");
      
        corralLink.addEventListener("click", function (e) {
          e.preventDefault();
          corralContainer.classList.remove("d-none");
          overlay.classList.remove("d-none");
        });
      
        window.principal = function () {
          corralContainer.classList.add("d-none");
          overlay.classList.add("d-none");
        };
      
        overlay.addEventListener("click", principal);
      });
      

}