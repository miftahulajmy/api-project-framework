<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT POST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form  id="formData_edit" enctype="multipart/form-data" method="post">
                <input type="hidden" id="post_id">
 
                <div class="form-group">
                @csrf
                    <label for="name" class="control-label">NISN</label>
                    <input type="text" class="form-control" id="NISN-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-NISN-edit"></div>
                </div>
 
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal</label>
                    <input type="text" class="form-control" id="Tanggal-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-Tanggal-edit"></div>
                </div>
               
 
                <div class="form-group">
                    <label for="name" class="control-label">Jenis_pembayaran</label>
                    <input type="text" class="form-control" id="Jenis_pembayaran-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-Jenis_pembayaran-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Jumlah</label>
                    <input type="text" class="form-control" id="Jumlah-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-Jumlah-edit"></div>
                </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary" id="update">UPDATE</button>
            </div>
</form>
        </div>
    </div>
</div>
 
<script>
    //button create post event
    $('body').on('click', '#btn-edit-post', function () {
 
        let post_id = $(this).data('id');
 
        //fetch detail post with ajax
        $.ajax({
            url: '{{url('api/pembayaran')}}/'+post_id,
            type: "GET",
            cache: false,
            success:function(response){
 
                //fill data to form
                $('#post_id').val(response.data.id);
                $('#NISN-edit').val(response.data.NISN);
                $('#Tanggal-edit').val(response.data.Tanggal);
                $('#Jenis_pembayaran-edit').val(response.data.Jenis_pembayaran);
                $('#Jumlah-edit').val(response.data.Jumlah);
               
                // $('#gambar').attr("src","{{ url('storage/spp') }}"+"/"+response.data.image);
 
                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });
 
    //action update post
    $('#update').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        let post_id=$('#post_id').val()
        var form = new FormData();
        form.append("NISN",$('#NISN-edit').val());
        form.append("Tanggal", $('#Tanggal-edit').val());
        form.append("Jenis_pembayaran", $('#Jenis_pembayaran-edit').val());
        form.append("Jumlah", $('#Jumlah-edit').val());
        form.append("_method", "PUT");
        
        //ajax
        $.ajax({
 
            url:  '{{url('api/pembayaran')}}/'+post_id,
            type: "POST",
            data: form,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
               
                //append to post data
                $(`#index_${response.data.id}`).replaceWith(post);
 
                //close modal
                $('#modal-edit').modal('hide');
               
 
            },
            error:function(error){
                console.log(error)
                if(error.responseJSON.title[0]) {
 
                    //show alert
                    $('#alert-title-edit').removeClass('d-none');
                    $('#alert-title-edit').addClass('d-block');
 
                    //add message to alert
                    $('#alert-title-edit').html(error.responseJSON.title[0]);
                }
 
                if(error.responseJSON.content[0]) {
 
                    //show alert
                    $('#alert-content-edit').removeClass('d-none');
                    $('#alert-content-edit').addClass('d-block');
 
                    //add message to alert
                    $('#alert-content-edit').html(error.responseJSON.content[0]);
                }
 
            }
 
        });
 
    });
 
</script>
