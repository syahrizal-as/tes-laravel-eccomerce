@extends('layouts.admin', ['title' => 'Dashboard Permission'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">

            <div class="card-body">
                @can('product.create')
                    {{-- tambah permission --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="javascript:;void(0)" onclick="showModal()" class="btn btn-primary"><i
                                    class="fas fa-plus me-2"></i> Product</a>
                        </div>
                    </div>
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-product" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" style="width: 5%">NO.</th>
                                <th scope="col">NAME</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">STOCK</th>
                                <th scope="col">DESCRIPTION</th>
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

    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="mb-4">

                        <h4 id="label">Tambah Product </h4>
                    </div>
                    <form id="form-product" class="row" onsubmit="return false">
                        @csrf


                        <div class="col-12 mb-3">
                            <label class="col-sm-6 col-form-label" for="plEmail">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukan Name Product"
                                id="product" required>
                            <input type="hidden" name="id" id="product_id">
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="col-sm-6 col-form-label" for="plEmail">Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Masukan Price Product"
                                id="price" required>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-price"></div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="col-sm-6 col-form-label" for="plEmail">Stock</label>
                            <input type="number" class="form-control" name="stock" placeholder="Masukan Stock Product"
                                id="stock" required>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stock"></div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="col-sm-6 col-form-label" for="plEmail">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-description"></div>
                        </div>


                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" id="btn-save" class="btn btn-success me-2">Simpan</button>
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
            $('#table-product').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.product.index') }}",
                columns: [{
                        "data": "id",
                        "name": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ],
                columnDefs: [{
                        "targets": [0, 1, 2, 3, 4], // your case first column
                        "className": "text-center",
                    },



                ]
            });
        });

        function showModal() {
            $('#productModal').modal('show');
            $('#label').text('Tambah Product');
            $('#product').val('');
            $('#product_id').val('');
            $('#price').val('');
            $('#stock').val('');
            $('#description').val('');
        }

        function Edit(id) {
            $('#productModal').modal('show');
            $('#label').text('Edit Product');
            fetch(`/dashboard/master-data/product/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#product_id').val(data.product.id);
                    $('#product').val(data.product.name);
                    $('#price').val(data.product.price);
                    $('#stock').val(data.product.stock);
                    $('#description').val(data.product.description);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        }

        //action create post
        $('#form-product').submit(function(e) {
            e.preventDefault();

            //define variable
            let formdata = $('#form-product').serialize();

            let token = $("meta[name='csrf-token']").attr("content");

            //ajax
            $.ajax({

                url: `/dashboard/master-data/product`,
                type: "POST",
                cache: false,
                data: formdata,
                success: function(response) {
                    $('#productModal').modal('hide');

                    //show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        showCancelButton: false,

                        timer: 3000
                    }).then(function() {
                        // form reset
                        $('#form-product').trigger("reset");
                        //close modal
                        //reload table
                        $('#table-product').DataTable().ajax.reload();
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
                        url: "/dashboard/master-data/product/" + id,
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

                                    $('#table-product').DataTable().ajax.reload();
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
                                    $('#table-product').DataTable().ajax.reload();

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
