
function SubmitFromAlert(form, mes_title) {
    event.preventDefault();
    Swal.fire({
        icon: 'question',
        title: mes_title,
        showDenyButton: true,
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            //console.log('loggg',form);
        }
    })
};

function SumitEdit(mes_title, url) {
    event.preventDefault();
    Swal.fire({
        icon: 'question',
        title: mes_title,
        showDenyButton: true,
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            //window.open(url,"_self");
            // window.location.href = url;

            // Simulate an HTTP redirect:
            window.location.replace(url)
        }
    })
};

function SubmitDelete(form, mes_title) {
    event.preventDefault();
    Swal.fire({
        icon: 'question',
        title: mes_title,
        showDenyButton: true,
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
};


