// 
$('.dropify').dropify();

$(function () {
    $(document).on("click", "#saveImage", function (event) {
        let myForm = document.getElementById('saveForm');
        let formData = new FormData(myForm);
        uploadImage(formData);
        console.log(formData);

    });
});


function uploadImage(formData) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        url: "{{ route('save_image') }}",
        success: function (data) {
            if (data.status) {
                showCustomSucces(data.message);
            } else {
                showCustomError(data.error)
            }
        },
        error: function (err) {
            showCustomError('Something went Wrong!')
        }
    });
}

//  setting dropify
// $('.dropify').dropify();

// $(function () {
//     $(document).on("click", "#saveImage", function (event) {
//         var myForm = document.getElementById('saveForm');
//         // var formData = new FormData(myForm);
//         var formData = new FormData(document.getElementById("saveForm"));

//         uploadImage(formData);
//         console.log(formData);
//     });
// });


// function uploadImage(formData) {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         type: "POST",
//         data: formData,
//         dataType: 'JSON',
//         contentType: false,
//         processData: false,
//         url: "{{ route('save_foto') }}",
//         success: function (data) {
//             if (data.status) {
//                 showCustomSucces(data.message);
//             } else {
//                 showCustomError(data.error)
//             }
//         },
//         error: function (err) {
//             showCustomError('Terjadi suatu kesalahan!')
//         }
//     });
// }

