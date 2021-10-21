const buttonGenerate = document.querySelector(".button-generate .generate");
const resultID = document.querySelector(".result-id p");
const addID = document.querySelector(".add");

buttonGenerate.addEventListener("click", () => {
   resultID.innerHTML = `ADMIN-${Math.random().toString(36).substr(2, 9)}`;
});

addID.addEventListener("click", () => {
   if (resultID.textContent === "") {
      alert('ID Admin Empty, please generate ID Admin');
      return false
   }

   if (resultID.textContent === "Click Button Generate To Get ID Admin") {
      alert('ID Admin Empty, please generate ID Admin');
      return false
   }

   $.ajax({
      url: 'idAdmin/getData', //This is the current doc
      type: "POST",
      data: ({idAdmin: resultID.textContent}),
      success: function(data){
         console.log(data);
         alert(`ID Admin : ${resultID.textContent} success has been added in database`);
         resultID.innerHTML = '';
      }
   });
});
