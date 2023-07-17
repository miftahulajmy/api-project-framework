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
                    <label for="name" class="control-label">Title</label>
                    <input type="text" class="form-control" id="title-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
                </div>
 
                <div class="form-group">
                    <label for="name" class="control-label">Image</label>
                    <input type="file" class="form-control" id="image-edit">
                    <img  id="gambar" width="50" height="50">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image-edit"></div>
                </div>
               
 
                <div class="form-group">
                    <label class="control-label">Content</label>
                    <textarea class="form-control" id="content-edit" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content-edit"></div>
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
            url: '{{url('api/posts')}}/'+post_id,
            type: "GET",
            cache: false,
            success:function(response){
 
                //fill data to form
                $('#post_id').val(response.data.id);
                $('#title-edit').val(response.data.title);
                $('#content-edit').val(response.data.content);
               
                $('#gambar').attr("src","{{ url('storage/posts') }}"+"/"+response.data.image);
 
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
        form.append("title",$('#title-edit').val());
        form.append("content", $('#content-edit').val());
        form.append("image", $('input[id="image-edit"]')[0].files[0]);
        form.append("_method", "PUT");
        
        //ajax
        $.ajax({
 
            url:  '{{url('api/posts')}}/'+post_id,
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
                        <td>${response.data.title}</td>
                        <td>${response.data.content}</td>
                        <td>
                        <img src="{{ url('storage/posts') }}${"/"+response.data.image}" width=50 height=50>
                        </td>
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
