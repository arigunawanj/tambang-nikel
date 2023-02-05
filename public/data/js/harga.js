$.ajax({
    type: "GET",
    url: "/getharga",
    dataType: "JSON",
    success: function (response) {
        response.map((value) => {
            $('#nama_barang').append($('<option>', {
                value: value.id,
                text: value.nama_barang
            }));
        })
    }
});

function harga(id){
    $.ajax({
        type: "get",
        url: `/getbarang/${id}`,
        dataType: "json",
        success: function (response) {
            console.log(response);
            $(`#harga_barang`).children().remove()
            response.map((value) => { 
                $(`#harga_barang`).append($('<option>', {
                    value: value.id,
                    text: value.harga_jual
                }));
            })
        }
    });
}