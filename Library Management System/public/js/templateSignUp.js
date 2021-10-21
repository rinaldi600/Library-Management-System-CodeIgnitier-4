console.log("WORK");
const pictureProfile = document.querySelector(".picture-profile");
const selectFile = document.querySelector(".select-file");

selectFile.addEventListener("change", () => {
    if (selectFile.files[0]) {
        pictureProfile.src = URL.createObjectURL(selectFile.files[0])
    } else {
        pictureProfile.src = '/profile/photo-1579830341173-519fb8c07ca2.jpg';
    }
});