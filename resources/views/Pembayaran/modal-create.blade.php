<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH POST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
            <form  id="formData" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label">NISN</label>
                    <input type="text" class="form-control" id="NISN" name="NISN">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
               
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal</label>
                    <input type="text" class="form-control" id="Tanggal" name="Tanggal">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
 
                <div class="form-group">
                    <label for="name" class="control-label">Jenis_pembayaran</label>
                    <input type="text" class="form-control" id="Jenis_pembayaran" name="Jenis_pembayaran">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Jumlah</label>
                    <input type="text" class="form-control" id="Jumlah" name="Jumlah">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
</form>
        </div>
    </div>
</div>
 
<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function () {
 
        //open modal
        $('#modal-create').modal('show');
    });
 
    //action create post
    $('#store').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = new FormData(document.getElementById("formData"));
        data.append("NISN", $('#NISN').val());
        data.append("Tanggal", $('#Tanggal').val());
        data.append("Jenis_pembayaran",$('#Jenis_pembayaran').val());
        data.append("Jumlah",$('#Jumlah').val());
        //ajax
        $.ajax({
            url: '{{url('api/pembayaran')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            success:function(response){
 
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
 
                //data post
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.NISN}</td>
                        <td>${response.data.Tanggal}</td>
                        <td>${response.data.Jenis_pembayaran}</td>
                        <td>${response.data.Jumlah}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
               
                //append to table
                $('#table-posts').prepend(post);
               
                //clear form
                $('#NISN').val('');
                $('#Tanggal').val('');
                $('#Jenis_pembayaran').val('');
                $('#Jumlah').val('');
 
                //close modal
                $('#modal-create').modal('hide');
               
 
            },
            error:function(error){
                console.log(error.responseText)
                 if(error.responseJSON.title[0]) {
 
                    //show alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');
 
                    //add message to alert
                    $('#alert-title').html(error.responseJSON.title[0]);
                }
 
                if(error.responseJSON.content[0]) {
 
                    //show alert
                    $('#alert-content').removeClass('d-none');
                    $('#alert-content').addClass('d-block');
 
                    //add message to alert
                    $('#alert-content').html(error.responseJSON.content[0]);
                }
 
            }

        });
 
    });
 
</script>
 
