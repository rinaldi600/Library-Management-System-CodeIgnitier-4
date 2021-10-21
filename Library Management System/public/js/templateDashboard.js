const hamburgerMenu = document.querySelector('.hamburger');
const linkMenu = document.querySelector('.link-feature');
const backroundOpacity = document.querySelector('.background');
const fileInputCoverBook = document.querySelector('.cover-book-input');
const previewCoverBook = document.querySelector('.preview-cover-book');
const detailBook = document.querySelectorAll('.detail-book');
const cardBody = document.querySelector('.modal-body');
const rentIDUser = document.querySelectorAll('.rent-id-user');
const getIDUser = document.querySelectorAll('.get-id-user');
const rendIDBook = document.querySelectorAll('.rent-id-book');
const fullPicture = document.querySelectorAll('.detail-user');

fullPicture.forEach((e) => {
   e.addEventListener('click', function () {
        e.children[1].classList.toggle('full-picture');
   })
});

const getDataUser = (hostID, idUser) => {
    $.ajax({
        type: 'POST',
        url: hostID,
        data: {
            idUser : idUser
        },
        datatype: 'json',
        success: function (data) {
            const dataUser = JSON.parse(data);

            let card = `
                     <div class="card">
                        <img src="/profile/${dataUser.picture}" class="img-fluid" alt="Cover">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">${dataUser.nama}</h5>
                            <p class="card-text">Username: ${dataUser.username}</p>
                            <p class="card-text">Email : ${dataUser.email}</p>
                        </div>
                    </div>
                `;
            return cardBody.innerHTML = card;
        }
    });
};

for (const z of getIDUser) {
    z.addEventListener("click", function () {
        const idUser = z.previousElementSibling.value;
        getDataUser('/dashboardAdmin/getIDUserAjax',idUser);
    })
}


for (const x of detailBook) {
    x.addEventListener('click', function () {
        const idBook = x.previousElementSibling.value;
        $.ajax({
            type: 'POST',
            url: '/dashboardAdmin/getIdBookAjax',
            data: {
                idBook : idBook
            },
            datatype: 'json',
            success: function (data) {
                const dataBook = JSON.parse(data);
                let card = `
                     <div class="card">
                        <img src="/cover/${dataBook.picture}" class="img-fluid" alt="Cover">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">${dataBook.title}</h5>
                            <p class="card-text">ISBN : ${dataBook.ISBN}</p>
                            <p class="card-text">Author : ${dataBook.author}</p>
                            <p class="card-text">Publish : ${dataBook.publish}</p>
                            <p class="card-text">Stok : ${dataBook.stok}</p>
                            <p class="card-text">Created_At :  ${dataBook.created_at}</p>
                            <p class="card-text">Updated_At :  ${dataBook.updated_at}</p>
                        </div>
                    </div>
                `;
                cardBody.innerHTML = card;
            }
        });
    })
}

for (const y of rentIDUser) {
    y.addEventListener("click", function() {
        const idUser = y.previousElementSibling.value;
        $.ajax({
            type: 'POST',
            url: '/dashboardUser/getIDUserAjax',
            data: {
                idUser : idUser
            },
            datatype: 'json',
            success: function (data) {
                const dataUser = JSON.parse(data);

                let card = `
                     <div class="card">
                        <img src="/profile/${dataUser.picture}" class="img-fluid" alt="Cover">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">${dataUser.nama}</h5>
                            <p class="card-text">Username: ${dataUser.username}</p>
                            <p class="card-text">Email : ${dataUser.email}</p>
                        </div>
                    </div>
                `;
                cardBody.innerHTML = card;
            }
        });
    })
}

for (const z of rendIDBook) {
    z.addEventListener("click", function () {
        const idBook = z.previousElementSibling.value;

        $.ajax({
            type: 'POST',
            url: '/dashboardUser/getIDBookAjax',
            data: {
                idBook : idBook
            },
            datatype: 'json',
            success: function (data) {
                const dataBook = JSON.parse(data);
                let card = `
                     <div class="card">
                        <img src="/cover/${dataBook.picture}" class="img-fluid" alt="Cover">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">${dataBook.title}</h5>
                            <p class="card-text">ISBN : ${dataBook.ISBN}</p>
                            <p class="card-text">Author : ${dataBook.author}</p>
                            <p class="card-text">Publish : ${dataBook.publish}</p>
                        </div>
                    </div>
                `;
                cardBody.innerHTML = card;
            }
        });

    })
}

hamburgerMenu.addEventListener('click', function() {
    this.classList.toggle('change');
    linkMenu.classList.toggle('active');
    backroundOpacity.classList.toggle('background-active');
});

fileInputCoverBook.addEventListener('change', (e) => {
    let previewImage = e.target.files;
    if (previewImage[0]) {
        previewCoverBook.src = URL.createObjectURL(previewImage[0]);
    } else {
        previewCoverBook.src = '../cover/daria-nepriakhina-xY55bL5mZAM-unsplash.jpg';
    }
});



