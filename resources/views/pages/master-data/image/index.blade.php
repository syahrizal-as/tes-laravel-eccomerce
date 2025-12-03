@extends('layouts.admin', ['title' => 'Dashboard Permission'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-body">
                @can('image.create')
                    {{-- tambah permission --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="javascript:;void(0)" onclick="showModal()" class="btn btn-primary"><i
                                    class="fas fa-plus me-2"></i> Image</a>
                        </div>
                    </div>
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-image" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" style="width: 5%">NO.</th>
                                <th scope="col">PRODUCT</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="mb-4">

                        <h4 id="label">Tambah Image </h4>
                    </div>
                    <form id="form-image" class="row" onsubmit="return false">
                        @csrf


                        <div class="col-12 mb-3">
                            <label class="col-sm-6 col-form-label" for="plEmail">Product</label>
                            <select name="product_id" id="product_id" class="form-select select-modal" required>
                                <option value="">-- Pilih Product --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-product_id"></div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="col-sm-6 col-form-label" for="plEmail">Image</label>
                            <input type="hidden" name="image_id" id="image_id">
                            <input type="file" class="form-control" id="image" accept="image/*" name="image"
                                required>

                            <img src="" id="image-preview" class="mt-2 rounded" alt=""
                                style="width: 100px; height: 100px;">
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                        </div>


                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="button" id="btn-save-image" class="btn btn-success me-2">Simpan</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $('#table-image').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.image.index') }}",
                columns: [{
                        "data": "id",
                        "name": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'product_id',
                        name: 'product_id'
                    },
                    {
                        data: 'file',
                        name: 'file'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ],
                columnDefs: [{
                        "targets": 0, // your case first column
                        "className": "text-center",
                    },
                    {
                        "targets": 1, // your case first column
                        "className": "text-center",
                    },



                ]
            });
        });

        function showModal() {
            $('#imageModal').modal('show');
            $('#label').text('Tambah Image');
            $('#product_id').val('').change();
            $('#image_id').val('');
            $('#image-preview').attr('src', '');
            $('#image-preview').addClass('d-none');


        }

        function Edit(id) {
            $('#imageModal').modal('show');
            $('#label').text('Edit Image');
            fetch(`/dashboard/master-data/image/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#image_id').val(data.image.id);
                    $('#product_id').val(data.image.product_id).change();
                    $('#image-preview').attr('src', data.image.file);
                    $('#image-preview').removeClass('d-none');
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        }

        $('.select-modal').select2({
            placeholder: '-- Pilih --',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#imageModal')
        });

        //action create post
        $('#btn-save-image').click(function(e) {
            e.preventDefault();

            let product_id = $('#product_id').val();
            let image_id = $('#image_id').val();
            let token = $("meta[name='csrf-token']").attr("content");
            let imageInput = $('#image')[0]; // access DOM element

            let formData = new FormData();
            formData.append('product_id', product_id);
            formData.append('image_id', image_id);
            formData.append('_token', token);
            if (imageInput.files.length > 0) {
                formData.append('image', imageInput.files[0]);
            }

            $.ajax({
                url: `/dashboard/master-data/image`,
                type: "POST",
                data: formData,
                processData: false, // Important for file upload
                contentType: false, // Important for file upload
                cache: false,
                success: function(response) {
                    $('#imageModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 3000
                    }).then(function() {
                        $('#form-image').trigger("reset");
                        $('#table-image').DataTable().ajax.reload();
                    });
                },
                error: function(error) {
                    let message = '';
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(key, item) {
                            message += item[0] + '<br>';
                        })
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: message,
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: error.responseJSON.message,
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    }
                }
            });
        });

        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then(function(isConfirm) {
                if (isConfirm.isConfirmed) {

                    //ajax delete
                    jQuery.ajax({
                        url: "/dashboard/master-data/image/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                Swal.fire({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {

                                    $('#table-image').DataTable().ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    $('#table-image').DataTable().ajax.reload();

                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@endpush
