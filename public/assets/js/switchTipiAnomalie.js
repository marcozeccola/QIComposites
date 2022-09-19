document.getElementById("aggiungiTipo").addEventListener("change", (e) => {
     let aggiungi = document.getElementById("container-aggiungi");
     let selectAggiungi = document.getElementById("container-select");
     if (e.target.checked) {
          aggiungi.style.display = "block";
          selectAggiungi.style.display = "none";
     } else {
          aggiungi.style.display = "none";
          selectAggiungi.style.display = "block";
     }
});