var oTable;
var oTableRef;

window.onload =  function (){
}
$(document).on('keyup','#name',function(){
    let val  = $(this).val();
    val = val.replace(' ','').toLowerCase();
    if($('#alias')){
        $('#alias').val(val);
    }
})

$(document).on('click','#img_uploader',function(){
    $('#image').trigger('click');
})

$(document).on('change','#image',function(e){
     const [file] = this.files
     if (file) {
         $('#img_uploader').attr('src',URL.createObjectURL(file))
     }
})
$(document).on('click','#select-all',function(e){
    if($(this).is(':checked')){
        $('input[name="ids[]"]').prop('checked',true);
    }else{
        $('input[name="ids[]"]').prop('checked',false);

    }
})


//After Datatable intialised
const dataTableInitHandler = () => {
    oTable = $("#data-table").DataTable();
    oTableRef = $("#data-table");
};


const showToastr = (type, title, text) => {
    const options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    if (type === "success") {
        toastr.success(text, title, options);
    } else if (type === "error") {
        toastr.error(text, title, options);
    }
};

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click','#bulkdltbtn',function(){
    let __this = $(this);
    __this.prop('disabled',true);
    let url = __this.attr('data-url');
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Are you sure you want to delete selected users?",
        showCancelButton: true,
        confirmButtonText: 'Yes',
        confirmButtonColor: '#dc3545',
        cancelButtonText: 'No',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            // toggleLoader();
            let selectedRows = document.querySelectorAll('input[name="ids[]"]:checked');
            let ids = [];

            selectedRows.forEach((selectedRow) => {
                ids = [...ids, selectedRow.value];
            });

            const data = {
                ids: ids
            };
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                if (data.status === "true") {
                    document.querySelector("#select-all").checked = false;
                    // toggleLoader();
                    oTable.draw(true);
                    showToastr('success', 'Success', data.message);
                }else{
                    showToastr('error', 'Error', data.message);
                }
            });
            __this.prop('disabled',false);
        }
    });
})
